<?php

namespace App\Http\Controllers\Api;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Rating;
use App\Models\Customer;
use App\Models\ServiceBid;
use App\Models\ServicePhoto;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\ServiceRequest;
use App\Models\Specialization;
use App\Models\ServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\ServiceProgressPhoto;
use Illuminate\Support\Facades\Hash;
use App\Models\ProviderCertification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        return response()->json(User::all());
    }

    // Menampilkan detail user tertentu
    public function show(User $user)
    {
        return response()->json($user);
    }

    // add new user as customer
    public function registerCustomer(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string',
            'gender'   => 'required|in:M,F',
            'password' => 'required|string|min:6',
        ]);


        try {
            $user = null;

            DB::transaction(function () use ($request) { // Pass $request into the closure
                //save to user table
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->role = 'customer';
                $user->save();

                //save to customer table
                $customer = new Customer;
                $customer->user_id = $user->id;
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->address = $request->address;
                $customer->gender = $request->gender;
                $customer->save();

                // send email verification
                $user->sendEmailVerificationNotification();
            });
            

            return response()->json([
                'message' => 'Verifikasi email kamu untuk menyelesaikan pendaftaran',
                'status' => true,
                'user' => $user,
            ], 201);
            DB::commit();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to create user',
                'error' => $th->getMessage()
            ], 500);
            DB::rollBack();
        }
    
    }

    // add new user as customer
    public function registerServiceProvider(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string',
            'gender'   => 'required|in:M,F',
            // 'specialization' => 'required',
            'password' => 'required|string|min:6',
        ]);


        try {
            $user = null;

            DB::transaction(function () use ($request) { // Pass $request into the closure
                //save to user table
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->role = 'vendor';
                $user->save();

                //save to vendor table
                $vendor = new ServiceProvider;
                $vendor->user_id = $user->id;
                $vendor->name = $request->name;
                $vendor->phone = $request->phone;
                $vendor->address = $request->address;
                $vendor->gender = $request->gender;
                // $vendor->specialization_id = $request->specialization;
                $vendor->save();

                // send email verification
                $user->sendEmailVerificationNotification();
            });
            

            return response()->json([
                'message' => 'Verifikasi email kamu untuk menyelesaikan pendaftaran',
                'status' => true,
                'user' => $user,
            ], 201);
            DB::commit();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to create user',
                'error' => $th->getMessage()
            ], 500);
            DB::rollBack();
        }
    
    }

    //login user customer 
    public function loginCustomer(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->whereIn('role',['customer'])->where('is_active', 1)->first();

        if ($user && !$user->hasVerifiedEmail()) {

            $user->sendEmailVerificationNotification();

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Silakan verifikasi email Anda terlebih dahulu, cek kotak masuk email Anda',
            ], 422);
        }

        if (!$user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Kombinasi email dan password tidak sesuai',
            ], 422);
        }

        $token = $user->createToken('API Token')->plainTextToken;
        $customer = Customer::where('user_id', $user->id)->first()->name;

        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'message' => 'Selamat datang kembali '.$customer,
        ]);
    }

    //login user vendor 
    public function loginVendor(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->whereIn('role',['vendor'])->where('is_active', 1)->first();

        if ($user && !$user->hasVerifiedEmail()) {

            $user->sendEmailVerificationNotification();

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Silakan verifikasi email Anda terlebih dahulu, cek kotak masuk email Anda',
            ], 422);
        }

        if (!$user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Kombinasi email dan password tidak sesuai',
            ], 422);
        }

        $token = $user->createToken('API Token')->plainTextToken;
        $vendor = ServiceProvider::where('user_id', $user->id)->first()->name;

        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'message' => 'Selamat datang kembali '.$vendor.' semoga hari ini rejeki kamu berlimpah yah',
        ]);
    }

    //vendor profile
    public function profilVendor(Request $request)
    {
        $user = User::where('id', $request->user()->id)->whereIn('role',['vendor'])->where('is_active',1)->first();
        
        $vendor = Serviceprovider::join('users', 'users.id', '=', 'service_providers.user_id')
            // ->join('specializations', 'specializations.id', '=', 'service_providers.specialization_id')
            // ->select('service_providers.*', 'specializations.name as specialization_name','users.profile_photo')
            ->select('service_providers.*', 'users.profile_photo','users.email')
            ->where('service_providers.user_id', $request->user()->id)
            ->first();
        
        return response()->json([
            'success' => true,
            'data' => $vendor,
            'message' => 'Profil Vendor',
        ]);
    }

    //vendor profile
    public function profilCustomer(Request $request)
    {
        $user = User::where('id', $request->user()->id)->whereIn('role',['customer'])->where('is_active',1)->first();
        
        $vendor = Customer::join('users', 'users.id', '=', 'customers.user_id')
            // ->join('specializations', 'specializations.id', '=', 'customers.specialization_id')
            // ->select('customers.*', 'specializations.name as specialization_name','users.profile_photo')
            ->select('customers.*', 'users.profile_photo','users.email')
            ->where('customers.user_id', $request->user()->id)
            ->first();
        
        return response()->json([
            'success' => true,
            'data' => $vendor,
            'message' => 'Profil Costumer',
        ]);
    }

    public function updateProfileVendor(Request $request)
    {
        try {
            $user = $request->user();
            $oldEmail = $user->email;

            DB::transaction(function () use ($request, $user) {
                // Cek email jika sudah digunakan oleh user lain
                $cekEmail = User::where('email', $request->email)
                                ->where('id', '!=', $user->id)
                                ->exists();

                if ($cekEmail) {
                    throw new \Exception('Email sudah digunakan oleh user lain');
                }

                // Update user
                $user->name = $request->name;
                $user->email = $request->email;
                if ($request->password) {
                    $user->password = Hash::make($request->password);
                }
                $user->save();

                // Update service provider
                $provider = ServiceProvider::where('user_id', $user->id)->first();
                $provider->name = $request->name;
                $provider->phone = $request->phone;
                $provider->address = $request->address;
                $provider->gender = $request->gender;
                $provider->save();
            });

            // Jika email berubah, reset verifikasi dan logout
            if ($oldEmail !== $request->email) {
                $user->update(['email_verified_at' => null]);
                $user->sendEmailVerificationNotification();
                // $user->tokens()->delete();

                return response()->json([
                    'success' => false,
                    'message' => 'Silakan verifikasi email Anda terlebih dahulu, cek kotak masuk email Anda',
                    'email_is_update' => true,
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diupdate',
                'email_is_update' => false,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Profil gagal diupdate: ' . $e->getMessage(),
            ], 422);
        }

        // if($request->password){
        //     try {
        //         DB::transaction(function () use ($request) {
        //             //Ambil email lama sebelum ada update
        //             $oldEmail = $request->user()->email;
        //             //cek email apabila sudah digunakan oleh user lain kecuali user yang sedang login
        //             $user = User::where('email', $request->email)->where('id','!=',$request->user()->id)->first();
        //             if($user){
        //                 return response()->json([
        //                     'success' => false,
        //                     'message' => 'Email sudah digunakan oleh user lain'
        //                 ], 422);
        //             }
                    
        //             //update data user
        //             $user = User::where('id', $request->user()->id)->first();
        //             $user->name = $request->name;
        //             $user->email = $request->email;
        //             $user->password = Hash::make($request->password);
        //             $user->save();

        //             //update data customer
        //             $customer = ServiceProvider::where('user_id', $request->user()->id)->first();
        //             $customer->name = $request->name;
        //             $customer->phone = $request->phone;
        //             $customer->address = $request->address;
        //             $customer->gender = $request->gender;
        //             $customer->save();

        //         });
                
        //         //Jika email diupdate, maka kirimkan email verifikasi ke email baru
        //         if($oldEmail != $request->email){
        //             $request->user()->update([
        //                 'email_verified_at' => null,
        //             ]);
        //             $request->user()->sendEmailVerificationNotification();

        //         //logout user
        //             $request->user()->tokens()->delete();
        //             return response()->json([
        //                 'success' => false,
        //                 'message' => 'Silakan verifikasi email Anda terlebih dahulu, cek kotak masuk email Anda',
        //                 'email_is_update' => true,
        //             ], 200);
        //         }else{
        //             return response()->json([
        //                 'success' => true,
        //                 'message' => 'Profil  berhasil diupdate',
        //                 'email_is_update' => false,
        //             ]);
        //         }

        //         DB::commit();
        //     } catch (\Throwable $th) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Profil  gagal diupdate '. $th->errors()
        //         ], 422);
        //         DB::rollback();
        //     }
        // }else{
        //     try {
        //         DB::transaction(function () use ($request) {
        //             //Ambil email lama sebelum ada update
        //             $oldEmail = $request->user()->email;
        //             //cek email apabila sudah digunakan oleh user lain kecuali user yang sedang login
        //             $user = User::where('email', $request->email)->where('id','!=',$request->user()->id)->first();
        //             if($user){
        //                 return response()->json([
        //                     'success' => false,
        //                     'message' => 'Email sudah digunakan oleh user lain'
        //                 ], 422);
        //             }
        //             //update data user
        //             $user = User::where('id', $request->user()->id)->first();
        //             $user->name = $request->name;
        //             $user->email = $request->email;
        //             $user->save();

        //             //update data customer
        //             $customer = ServiceProvider::where('user_id', $request->user()->id)->first();
        //             $customer->name = $request->name;
        //             $customer->phone = $request->phone;
        //             $customer->address = $request->address;
        //             $customer->gender = $request->gender;
        //             $customer->save();

        //         });    
        //         //Jika email diupdate, maka kirimkan email verifikasi ke email baru
        //         if($oldEmail != $request->email){
        //             $request->user()->update([
        //                 'email_verified_at' => null,
        //             ]);
        //             $request->user()->sendEmailVerificationNotification();

        //         //logout user
        //             $request->user()->tokens()->delete();
        //             return response()->json([
        //                 'success' => false,
        //                 'message' => 'Silakan verifikasi email Anda terlebih dahulu, cek kotak masuk email Anda',
        //                 'email_is_update' => true,
        //             ], 200);
        //         }else{
        //             return response()->json([
        //                 'success' => true,
        //                 'message' => 'Profil berhasil diupdate',
        //                 'email_is_update' => false,
        //             ]);
        //         }
                
        //         DB::commit();
        //     } catch (\Throwable $th) {
                
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Profil  gagal diupdate '. $th->errors()
        //         ], 422);
        //         DB::rollback();
        //     }
        // }
        
    }

    public function updateProfileCustomer(Request $request)
    {
        try {
            $user = $request->user();
            $oldEmail = $user->email;

            DB::transaction(function () use ($request, $user) {
                // Cek email jika sudah digunakan oleh user lain
                $cekEmail = User::where('email', $request->email)
                                ->where('id', '!=', $user->id)
                                ->exists();

                if ($cekEmail) {
                    throw new \Exception('Email sudah digunakan oleh user lain');
                }

                // Update user
                $user->name = $request->name;
                $user->email = $request->email;
                if ($request->password) {
                    $user->password = Hash::make($request->password);
                }
                $user->save();

                //update data customer
                $customer = Customer::where('user_id', $user->id)->first();
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->address = $request->address;
                $customer->gender = $request->gender;
                $customer->save();

            });

            // Jika email berubah, reset verifikasi dan logout
            if ($oldEmail !== $request->email) {
                $user->update(['email_verified_at' => null]);
                $user->sendEmailVerificationNotification();
                // $user->tokens()->delete();

                return response()->json([
                    'success' => false,
                    'message' => 'Silakan verifikasi email Anda terlebih dahulu, cek kotak masuk email Anda',
                    'email_is_update' => true,
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diupdate',
                'email_is_update' => false,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Profil gagal diupdate: ' . $e->getMessage(),
            ], 422);
        }

        
        
    }

    // Menghapus user
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function advertise(Request $request){
        $advertisements = Advertisement::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $advertisements,
            'message' => 'List of advertisements',
        ], 200);
    }
    public function listSpecializations(Request $request)
    {
        $data = Specialization::orderBy('name')->get();

        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'List of specializations',
        ], 200);
    
    }

    public function tambahKeahlian(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'keahlian' => 'required|exists:specializations,id',
            ]);

            // Proses file sertifikat jika ada
            $path = null;
            if ($request->hasFile('certificate')) {
                $file = $request->file('certificate');
                $path = $file->store('dokumen', 'public');
            }else{
                $path = null;
            }

            // Ambil data keahlian
            $skill = Specialization::findOrFail($request->keahlian);

            // Ambil data user dan provider
            $user = $request->user();
            $provider = ServiceProvider::where('user_id', $user->id)->firstOrFail();

            

            // Simpan data keahlian tapi jika keahlian untuk provider sudah ada berikan peringatan
            $keahlian = ProviderCertification::where('provider_id', $provider->id)
                ->where('specialization_id', $request->keahlian)
                ->first();

            if ($keahlian) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak dapat menyimpan, keahlian ini sudah ada sebelumnya, silahkan pilih keahlian lain, atau edit keahlian yang sudah ada',
                    'data' => $keahlian,
                ], 422);
            }
            $keahlian = new ProviderCertification();
            $keahlian->provider_id = $provider->id;
            $keahlian->specialization_id = $request->keahlian;
            $keahlian->skill_name = $skill->name;
            $keahlian->certificate_file = $path ?: NULL;
            $keahlian->issue_year = $request->tahun_terbit ?: NULL;
            $keahlian->issuer = $request->penerbit ?: NULL;
            $keahlian->is_verified = 0; // Default belum diverifikasi
            $keahlian->save();

            return response()->json([
                'status' => true,
                'message' => 'Keahlian berhasil ditambahkan',
                'data' => $keahlian,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menambahkan keahlian',
                'error' => $e->getMessage(),
            ], 500);
        }

       
    }

    public function listKeahlianVendor(Request $request)
    {
        $user = $request->user();
        $vendor = ServiceProvider::where('user_id', $user->id)->firstOrFail();

        $keahlian = ProviderCertification::join('specializations', 'specializations.id', '=', 'provider_certifications.specialization_id')
            ->select('provider_certifications.*', 'specializations.icon as icon')
            ->where('provider_id', $vendor->id)
            ->get();

        return response()->json([
            'status' => true,
            'data' => $keahlian,
            'message' => 'List keahlian vendor',
        ], 200);
    }

    public function uploadFoto(Request $request)
    {

        try {
            DB::beginTransaction();
            
            //decode base64 jadi binary
            $image = base64_decode($request->foto);
            $fileName = uniqid() . '.jpeg';
            $filePath = 'user/' . $fileName;

            // Ambil path lama sebelum diupdate
            $oldPath = $request->user()->profile_photo;

            //simpan ke storage ke path public
            Storage::disk('public')->put($filePath, $image);

            $request->user()->update([
                'profile_photo' => $filePath,
            ]);

            //cek apakah user sudah punya profile_photo
            if ($oldPath) {
                //hapus foto lama
                Storage::disk('public')->delete($oldPath);
            }
            
            DB::commit();
            return response()->json([
                'success' => true,
                'data' => $filePath,
                'message' => 'Profile photo berhasil diupload'
            ]);
        
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Foto gagal diupload'
            ]);

        }


        
    }

    public function uploadFotoCustomer(Request $request)
    {

        try {
            DB::beginTransaction();
            
            //decode base64 jadi binary
            $image = base64_decode($request->foto);
            $fileName = uniqid() . '.jpeg';
            $filePath = 'user/' . $fileName;

            // Ambil path lama sebelum diupdate
            $oldPath = $request->user()->profile_photo;

            //simpan ke storage ke path public
            Storage::disk('public')->put($filePath, $image);

            $request->user()->update([
                'profile_photo' => $filePath,
            ]);

            //cek apakah user sudah punya profile_photo
            if ($oldPath) {
                //hapus foto lama
                Storage::disk('public')->delete($oldPath);
            }
            
            DB::commit();
            return response()->json([
                'success' => true,
                'data' => $filePath,
                'message' => 'Profile photo berhasil diupload'
            ]);
        
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Foto gagal diupload'
            ]);

        }


        
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ], 200);
    }

    public function broadcastJobRequest(Request $request)
    {
        // Broadcast the request for help
        try { 
            //cek model ServiceRequest, ambil 4 angka terakhir dari reference_number
            $lastRequest = ServiceRequest::orderBy('created_at', 'desc')->first();
            if ($lastRequest) {
                $lastReference = $lastRequest->reference_number;
                $lastNumber = (int) substr($lastReference, -4);
            } else {
                $lastNumber = 0;
            }
            $lastNumber++;
            $lastNumber = str_pad($lastNumber, 4, '0', STR_PAD_LEFT);
            //ambil id customer dari user yang sedang login
            $customer = Customer::where('user_id', $request->user()->id)->first();
            //make random reference number with prefix REQ- and customer_id, date_request dan $lastNumber
            $reference_number = 'REQ-' . $customer->id . '-' . date('Ymd') . '-' . $lastNumber;
            //save to service_request table
            $serviceRequest = new ServiceRequest();
            $serviceRequest->reference_number = $reference_number;
            $serviceRequest->customer_id = $customer->id;
            $serviceRequest->specialization_id = $request->keahlian;
            $serviceRequest->service_address = $request->alamat;
            $serviceRequest->longitude = $request->lng;
            $serviceRequest->latitude = $request->lat;
            $serviceRequest->scheduled_at = $request->tanggal . ' ' . $request->jam;
            $serviceRequest->budget_amount = $request->biaya;     
            $serviceRequest->description = $request->deskripsi;
            $serviceRequest->status_id = 1; // 1 = waiting for confirmation
            $serviceRequest->payment_status = 'pending';
            $serviceRequest->save();

            //decode base64 jadi binary
            $image1 = base64_decode($request->image1);
            $fileName1 = uniqid() . '.jpeg';
            $filePath1 = 'foto_request/' . $fileName1;

            if($request->image2){
                $image2 = base64_decode($request->image2);
                $fileName2 = uniqid() . '.jpeg';
                $filePath2 = 'foto_request/' . $fileName2;
            }else{
                $filePath2 = null;
            }
            if($request->image3){
                $image3 = base64_decode($request->image3);
                $fileName3 = uniqid() . '.jpeg';
                $filePath3 = 'foto_request/' . $fileName3;
            }else{
                $filePath3 = null;
            }
            if($request->image4){
                $image4 = base64_decode($request->image4);
                $fileName4 = uniqid() . '.jpeg';
                $filePath4 = 'foto_request/' . $fileName4;
            }else{
                $filePath4 = null;
            }

            //simpan ke tabel service_photos
            $servicePhoto = new ServicePhoto();
            $servicePhoto->reference_number = $serviceRequest->reference_number;
            $servicePhoto->image_1 = $filePath1;
            $servicePhoto->image_2 = $filePath2;
            $servicePhoto->image_3 = $filePath3;
            $servicePhoto->image_4 = $filePath4;
            $servicePhoto->save();

            //simpan ke storage ke empat image
            Storage::disk('public')->put($filePath1, $image1);
            if($request->image2){
                Storage::disk('public')->put($filePath2, $image2);
            }
            if($request->image3){
                Storage::disk('public')->put($filePath3, $image3);
            }
            if($request->image4){
                Storage::disk('public')->put($filePath4, $image4);
            }

            return response()->json([
                'status' => true,
                'message' => 'Permintaan bantuan berhasil disiarkan',
                'data' => $serviceRequest,
            ], 200);
    
                   
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Permintaan bantuan gagal disiarkan',
                'error' => $th->getMessage(),
            ], 500);
        }
        
    }

    public function listBroadcast(Request $request)
    {
        // get specialization_id from login user
        $user = $request->user();
        $vendor = ServiceProvider::where('user_id', $user->id)->first();

        //ambil specialization_id dari tabel provider_certification sesuai dengan user_id
        $specialization_id = ProviderCertification::where('provider_id', $vendor->id)
            ->pluck('specialization_id')
            ->toArray();

        $providerId = $vendor->id;
        //ambil latitude dan longitude dari tabel service_provider
        $vendorLat = $vendor->latitude;
        $vendorLng = $vendor->longitude;

        
        //tampilkan semua service request yang status_id = 1 dan specialization_id yang sama dengan specialization_id vendor
        $serviceRequest = ServiceRequest::join('customers', 'customers.id', '=', 'service_requests.customer_id')
            ->join('users', 'users.id', '=', 'customers.user_id')
            ->where('service_requests.status_id', 1)
            ->select(
                'service_requests.*','customers.name as customer_name','users.profile_photo as customer_profile_photo',
                DB::raw("6371 * acos(cos(radians($vendorLat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($vendorLng)) + sin(radians($vendorLat)) * sin(radians(latitude))) AS distance")
            )
            ->whereIn('specialization_id', $specialization_id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($request) use ($providerId) {
                $hasBid = ServiceBid::where('reference_number', $request->reference_number)
                                    ->where('provider_id', $providerId)
                                    ->exists();

                $request->is_applied_by_me = $hasBid;
                return $request;
            });
    
            return response()->json([
                'status' => true,
                'message' => 'List broadcast',
                'data' => $serviceRequest,
            ], 200);        
    }

    public function detailRequest($id)
    {
        //ambil reference_number dari service_bids
        // $reference_number = ServiceBid::where('id', $id)->first();

        $serviceRequest = ServiceRequest::join('customers', 'customers.id', '=', 'service_requests.customer_id')
            ->join('specializations', 'specializations.id', '=', 'service_requests.specialization_id')
            ->join('users', 'users.id', '=', 'customers.user_id')
            ->leftJoin('service_photos', 'service_photos.reference_number', '=', 'service_requests.reference_number')
            ->select(
                'service_requests.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'customers.address as customer_address',
                'specializations.name as specialization_name',
                'users.profile_photo as customer_profile_photo',
                'users.email as customer_email',
                'service_photos.image_1 as image_1',
                'service_photos.image_2 as image_2',
                'service_photos.image_3 as image_3',
                'service_photos.image_4 as image_4',
            )
            ->where('service_requests.id', $id)
            ->first();

        if (!$serviceRequest) {
            return response()->json([
                'status' => false,
                'message' => 'Permintaan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail permintaan',
            'data' => $serviceRequest,
        ], 200);
    }

    public function checkInDaily(Request $request)
    {
        
        $user = $request->user();
        $vendor = ServiceProvider::where('user_id', $user->id)->first();

        $vendor->latitude = $request->latitude;
        $vendor->longitude = $request->longitude;
        $vendor->save();

        return response()->json([
            'status' => true,
            'message' => 'Selamat lokasi kamu berhasil diperbarui, semoga harimu menyenangkan',
            'data' => $vendor,
        ], 200);
    }

    public function acceptJob(Request $request)
    {
        $user = $request->user();
        $vendor = ServiceProvider::where('user_id', $user->id)->first();
        $reference_number = ServiceRequest::where('id', $request->idRequest)->first();

        //cek apakah vendor sudah mengisi lokasi
        if (!$vendor->latitude || !$vendor->longitude) {
            return response()->json([
                'status' => false,
                'message' => 'Kamu harus checkin dulu yah, biar customer tahu kamu ada di mana',
            ], 422);
        }

        //cek jika vendor sudah mengajukan penawaran
        $serviceBid = ServiceBid::where('reference_number', $reference_number->reference_number)
            ->where('provider_id', $vendor->id)
            ->first();
        if ($serviceBid) {
            return response()->json([
                'status' => false,
                'message' => 'Kamu sudah mengajukan penawaran untuk pekerjaan ini, silahkan tunggu konfirmasi dari customer yah',
            ], 422);
        }else{

            //cek status _id dari service_request
            $budgetAmount = ServiceRequest::where('id', $request->idRequest)->first()->budget_amount;

            $statusBids = ($budgetAmount != $request->nilaipenawaran) ? 3 : 2; // 3 = negotiation, 2 = pickup
            
            
            //save to service_bid table
            $serviceBid = new ServiceBid();
            $serviceBid->reference_number = $reference_number->reference_number;
            $serviceBid->provider_id = $vendor->id;
            $serviceBid->bid_amount = $request->nilaipenawaran;
            $serviceBid->status_id = $statusBids; // 1 = waiting for confirmation, 2 = pickup, 3 = negotiation
            $serviceBid->save();

            return response()->json([
                'status' => true,
                'message' => 'Selemat pekerjaan berhasil diambil, mengajukan penawaran ke customer yah',
                'data' => $serviceBid,
            ], 200);
        }

        

        if (!$serviceBid) {
            return response()->json([
                'status' => false,
                'message' => 'Permintaan tidak ditemukan',
            ], 404);
        }
        //update status_id menjadi 2


        
    }

    public function listBidsProvider(Request $request)
    {
        $user = $request->user();
        $vendor = ServiceProvider::where('user_id', $user->id)->first();

        //ambil semua service_request yang status_id 2 dan provider_id vendor
        $serviceBid = ServiceBid::join('service_requests', 'service_requests.reference_number', '=', 'service_bids.reference_number')
            ->join('customers', 'customers.id', '=', 'service_requests.customer_id')
            ->join('specializations', 'specializations.id', '=', 'service_requests.specialization_id')
            ->join('users', 'users.id', '=', 'customers.user_id')
            ->join('service_statuses', 'service_statuses.id', '=', 'service_bids.status_id')
            ->leftJoin('service_progress_photos', 'service_progress_photos.reference_number', '=', 'service_bids.reference_number')
            ->select(
                'service_bids.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'customers.address as customer_address',
                'specializations.name as specialization_name',
                'users.profile_photo as customer_profile_photo',
                'users.email as customer_email',
                'service_requests.description',
                'service_statuses.name as status_name',
                'service_statuses.color as status_color',
                'service_progress_photos.after_photo1 as progress_image_1',
                'service_progress_photos.after_photo2 as progress_image_2',
                'service_progress_photos.after_photo3 as progress_image_3',
                'service_progress_photos.after_photo4 as progress_image_4',
            )
            ->where('service_bids.provider_id', $vendor->id)
            ->whereIn('service_bids.status_id', [2,3])
            ->orderBy('service_requests.scheduled_at', 'asc')
            // ->distinct('service_bids.reference_number')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'List bid provider',
            'data' => $serviceBid,
        ], 200);
    }
    public function listOrdersProvider(Request $request)
    {
        $user = $request->user();
        $vendor = ServiceProvider::where('user_id', $user->id)->first();

        //ambil semua service_request yang status_id 2 dan provider_id vendor
        $serviceRequest = ServiceRequest::join('customers', 'customers.id', '=', 'service_requests.customer_id')
            // ->join('service_bids', 'service_bids.reference_number', '=', 'service_requests.reference_number')
            ->join('specializations', 'specializations.id', '=', 'service_requests.specialization_id')
            ->join('users', 'users.id', '=', 'customers.user_id')
            ->join('service_statuses', 'service_statuses.id', '=', 'service_requests.status_id')
            ->leftJoin('service_progress_photos', 'service_progress_photos.reference_number', '=', 'service_requests.reference_number')
            ->select(
                'service_requests.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'customers.address as customer_address',
                'specializations.name as specialization_name',
                'users.profile_photo as customer_profile_photo',
                'users.email as customer_email',
                'service_statuses.name as status_name',
                'service_statuses.color as status_color',
                'service_progress_photos.after_photo1 as progress_image_1',
                'service_progress_photos.after_photo2 as progress_image_2',
                'service_progress_photos.after_photo3 as progress_image_3',
                'service_progress_photos.after_photo4 as progress_image_4',
            )
            ->where('service_requests.provider_id', $vendor->id)
            ->orderBy('service_requests.scheduled_at', 'asc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'List order provider',
            'data' => $serviceRequest,
        ], 200);
    }

    public function listJobOpen(Request $request)
    {
        $user = $request->user();
        $customer = Customer::where('user_id', $user->id)->first();
 
        $serviceRequestsQuery = ServiceRequest::with(['topBids.provider.user'])
            ->join('specializations', 'specializations.id', '=', 'service_requests.specialization_id')
            ->leftJoin('service_photos', 'service_photos.reference_number', '=', 'service_requests.reference_number')
            ->leftJoin(DB::raw('(SELECT reference_number, COUNT(*) as total_applicants FROM service_bids GROUP BY reference_number) as sb'),
                'sb.reference_number', '=', 'service_requests.reference_number')
            ->select(
                'service_requests.*',
                'specializations.name as specialization_name',
                'service_photos.image_1 as image_1',
                DB::raw('COALESCE(sb.total_applicants, 0) as total_applicants')
            )
            ->where('service_requests.customer_id', $customer->id)
            ->where('service_requests.status_id', 1) // Exclude status_id 1 (waiting for confirmation)
            ->orderBy('service_requests.created_at', 'desc')
            ->get();

        $serviceRequest = $serviceRequestsQuery->map(function ($request) {
            return [
                'id' => $request->id,
                'reference_number' => $request->reference_number,
                'description' => $request->description,
                'created_at' => $request->created_at,
                'specialization' => [
                    'id' => $request->specialization_id,
                    'name' => $request->specialization_name,
                ],
                'image' => $request->image_1,
                'status' => $request->status_id,
                'total_applicants' => $request->total_applicants,

                'top_providers' => $request->topBids->map(function ($bid) {
                    return [
                        'bid_id' => $bid->id,
                        'bid_amount' => $bid->bid_amount,
                        'provider_id' => $bid->provider->id ?? null,
                        'provider_name' => $bid->provider->name ?? null,
                        'provider_phone' => $bid->provider->phone ?? null,
                        'provider_address' => $bid->provider->address ?? null,
                        'provider_email' => $bid->provider->user->email ?? null,
                        'provider_profile_photo' => $bid->provider->user->profile_photo ?? null,
                    ];
                }),
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'List job customer yang open',
            'data' => $serviceRequest,
        ], 200);
    }

    public function listJob(Request $request){
        $user = $request->user();
        $customer = Customer::where('user_id', $user->id)->first();
 
        $JobsQuery = ServiceRequest::join('specializations', 'specializations.id', '=', 'service_requests.specialization_id')
            ->leftJoin('service_photos', 'service_photos.reference_number', '=', 'service_requests.reference_number')
            ->join('service_providers', 'service_providers.id', '=', 'service_requests.provider_id')
            ->join('users', 'users.id', '=', 'service_providers.user_id')
            ->select(
                'service_requests.*',
                'specializations.name as specialization_name',
                'service_photos.image_1 as image_1',
                'users.profile_photo as provider_profile_photo',
                'service_providers.name as provider_name',
            )
            ->where('service_requests.customer_id', $customer->id)
            ->whereIn('service_requests.status_id', [4,5,6,7])
            ->orderBy('service_requests.created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'List job on progress',
            'data'  => $JobsQuery,
        ],200);
    }

    public function lihatImage(Request $request, $referencenumber)
    {
        $serviceRequest = ServicePhoto::where('reference_number', $referencenumber)
            ->first();

        if (!$serviceRequest) {
            return response()->json([
                'status' => false,
                'message' => 'Photo tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Photo Awal Pekerjaan',
            'data' => $serviceRequest,
        ], 200);
    }

    public function lihatImageResult(Request $request, $referencenumber)
    {
        $photo = ServiceProgressPhoto::where('reference_number', $referencenumber)
            ->first();

        if (!$photo) {
            return response()->json([
                'status' => false,
                'message' => 'Photo tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Photo Awal Pekerjaan',
            'data' => $photo,
        ], 200);
    }

    public function cancelBid(Request $request)
    {
        $user = $request->user();
        $vendor = ServiceProvider::where('user_id', $user->id)->first();

        try {
            DB::beginTransaction();
            //cancel job jika status_id = 2 (pickup) atau 3 (negotiation)
            $serviceBid = ServiceBid::where('id', $request->idRequest)
                ->where('provider_id', $vendor->id)
                ->first();
            if (!$serviceBid) {
                DB::rollback();
                return response()->json([
                    'status' => false,
                    'message' => 'Permintaan tidak ditemukan',
                ], 404);
            }else{
                $serviceBid->delete();
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Permintaan berhasil dibatalkan',
                ], 200);
            }   
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
            ], 500);
        }

    }

    public function cancelJob(Request $request)
    {
        $user = $request->user();
        $vendor = ServiceProvider::where('user_id', $user->id)->first();

        try {
            DB::beginTransaction();
            //cancel job jika status_id = 2 (pickup) atau 3 (negotiation)
            $job = ServiceRequest::where('id', $request->idRequest)
                ->where('provider_id', $vendor->id)
                ->first();
            if (!$job) {
                DB::rollback();
                return response()->json([
                    'status' => false,
                    'message' => 'Permintaan tidak ditemukan',
                ], 404);
            }else{
                $job->status_id = 7; // 7 = canceled
                $job->save();

                $bid = ServiceBid::where('reference_number', $job->reference_number)
                    ->where('provider_id', $vendor->id)
                    ->first();
                if ($bid) {
                    $bid->status_id = 7; // 7 = canceled
                    $bid->save();
                }

    
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Permintaan berhasil dibatalkan',
                ], 200);
            }   
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
            ], 500);
        }

    }

    public function detailPenawaran(Request $request, $referencenumber)
    {
        // DB::raw("6371 * acos(cos(radians($vendorLat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($vendorLng)) + sin(radians($vendorLat)) * sin(radians(latitude))) AS distance"

        //ambil reference_number dari service_bids
        $serviceBid = ServiceBid::join('service_requests', 'service_requests.reference_number', '=', 'service_bids.reference_number')
            ->join('service_providers', 'service_providers.id', '=', 'service_bids.provider_id')
            ->join('provider_certifications', function ($join) {
                $join->on('provider_certifications.provider_id', '=', 'service_providers.id')
                    ->on('provider_certifications.specialization_id', '=', 'service_requests.specialization_id');
            })
            ->join('users', 'users.id', '=', 'service_providers.user_id')
            ->join('specializations', 'specializations.id', '=', 'service_requests.specialization_id')
            ->select(
                'service_bids.*', 
                'service_requests.description as request_description', 
                'service_requests.service_address as request_address', 
                'service_requests.scheduled_at as request_scheduled_at', 
                'service_requests.budget_amount as request_budget_amount', 
                'service_providers.name as provider_name', 
                'service_providers.phone as provider_phone', 
                'service_providers.address as provider_address', 
                'users.profile_photo as provider_profile_photo', 
                'specializations.name as specialization_name', 
                'provider_certifications.is_verified as is_verified',
                DB::raw("6371 * acos(cos(radians(service_providers.latitude)) * cos(radians(service_requests.latitude)) * cos(radians(service_requests.longitude) - radians(service_providers.longitude)) + sin(radians(service_providers.latitude)) * sin(radians(service_requests.latitude))) as jarak_vendor_ke_lokasi"))
            ->where('service_bids.reference_number', $referencenumber)
            ->orderBy('service_bids.bid_amount', 'asc') // Urutkan berdasarkan bid_amount
            ->get();

        $detailRequest = ServiceRequest::join('specializations', 'specializations.id', '=', 'service_requests.specialization_id')
            ->leftJoin('service_photos', 'service_photos.reference_number', '=', 'service_requests.reference_number')
            ->select('service_requests.*', 'specializations.name as specialization_name','service_photos.image_1 as image_1')
            ->where('service_requests.reference_number', $referencenumber)->first();
        
        return response()->json([
            'status' => true,
            'message' => 'Detail penawaran',
            'data' => $serviceBid,
            'detail_request' => $detailRequest,
        ], 200);

        if (!$serviceBid) {
            return response()->json([
                'status' => false,
                'message' => 'Permintaan tidak ditemukan',
            ], 404);
        }

    }

    public function jobProgress(Request $request, $referencenumber){
        $job = ServiceRequest::join('service_providers', 'service_providers.id', '=', 'service_requests.provider_id')
            ->join('users', 'users.id', '=', 'service_providers.user_id')
            ->join('specializations', 'specializations.id', '=', 'service_requests.specialization_id')
            ->leftJoin('service_photos', 'service_photos.reference_number', '=', 'service_requests.reference_number')
            ->leftJoin('service_progress_photos', 'service_progress_photos.reference_number', '=', 'service_requests.reference_number')
            ->join('provider_certifications', function ($join) {
                $join->on('provider_certifications.provider_id', '=', 'service_providers.id')
                    ->on('provider_certifications.specialization_id', '=', 'service_requests.specialization_id');
            })
            ->select(
                'service_requests.*',
                'service_providers.name as provider_name',
                'service_providers.phone as provider_phone',
                'service_providers.address as provider_address',
                'service_providers.latitude as provider_latitude',
                'service_providers.longitude as provider_longitude',
                'users.profile_photo as provider_profile_photo',
                'specializations.name as specialization_name',
                'service_photos.image_1 as image_1',
                'service_progress_photos.after_photo1 as progress_image_1',
                'service_progress_photos.after_photo2 as progress_image_2',
                'service_progress_photos.after_photo3 as progress_image_3',
                'service_progress_photos.after_photo4 as progress_image_4',
                'provider_certifications.is_verified as is_verified',
                DB::raw("6371 * acos(cos(radians(service_providers.latitude)) * cos(radians(service_requests.latitude)) * cos(radians(service_requests.longitude) - radians(service_providers.longitude)) + sin(radians(service_providers.latitude)) * sin(radians(service_requests.latitude))) as jarak_provider_ke_lokasi"))
            ->where('service_requests.reference_number', $referencenumber)
            ->first();

        return response()->json([
            'status' => true,
            'message' => 'Detail job progress',
            'data' => $job,
        ], 200);
    }

    public function detailProvider(Request $request, $id)
    {
        $provider = ServiceProvider::join('users', 'users.id', '=', 'service_providers.user_id')
            ->select(
                'service_providers.*',
                'users.profile_photo as provider_profile_photo',
                'users.email as provider_email',
            )
            ->where('service_providers.id', $id)
            ->first();

        if ($provider) {
            $specializations = ProviderCertification::join('service_providers','service_providers.id','provider_certifications.provider_id')
                ->join('specializations', 'specializations.id', '=', 'provider_certifications.specialization_id')
                ->where('provider_certifications.provider_id', $provider->id)
                ->get([
                    'specializations.name',
                    'specializations.icon',
                    'provider_certifications.is_verified',
                    'provider_certifications.certificate_file',
                    'provider_certifications.issue_year',
                    'provider_certifications.issuer',
                ]);

            $provider = collect($provider)->merge([
                'specializations' => $specializations,
            ]);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Detail provider',
            'data' => $provider,
        ], 200);


    }

    public function approveBid(Request $request)
    {
        $referenceNumber = $request->reference_number;
        $providerId = $request->provider_id;
        $bidAmount = $request->bid_amount;

        DB::beginTransaction();
        try {
            $serviceRequest = ServiceRequest::where('reference_number', $referenceNumber)->first();
            if (!$serviceRequest) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Penawaran tidak ditemukan',
                ], 404);
            }

            $serviceBid = ServiceBid::where('reference_number', $referenceNumber)
                ->where('provider_id', $providerId)
                ->first();

            if (!$serviceBid) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Penawaran tidak ditemukan',
                ], 404);
            }

            // Update ServiceRequest
            $serviceRequest->provider_id = $providerId; // set provider_id to the selected provider
            $serviceRequest->agreed_amount = $bidAmount; // set agreed amount to the bid amount
            $serviceRequest->status_id = 4; // 4 = processing
            $serviceRequest->save();

            // Update status bid yang dipilih
            $serviceBid->status_id = 4; // 4 = approved
            $serviceBid->save();

            // Update status bid lainnya jadi rejected
            ServiceBid::where('reference_number', $referenceNumber)
                ->where('provider_id', '!=', $providerId)
                ->update(['status_id' => 7]); // rejected

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Penawaran berhasil disetujui',
                'data' => $serviceBid,
            ], 200);

            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyetujui penawaran.',
                'error' => $e->getMessage()
            ], 500);
        }
       
    }

    public function startWork(Request $request)
    {
        $user = $request->user();
        $provider = ServiceProvider::where('user_id', $user->id)->first();

        try {
            DB::beginTransaction();
            //cancel job jika status_id = 2 (pickup) atau 3 (negotiation)
            $job = ServiceRequest::where('id', $request->idRequest)
                ->where('provider_id', $provider->id)
                ->first();
            if (!$job) {
                DB::rollback();
                return response()->json([
                    'status' => false,
                    'message' => 'Permintaan tidak ditemukan',
                ], 404);
            }else{
                $job->status_id = 5; // 5 = in_progress
                $job->save();

                $bid = ServiceBid::where('reference_number', $job->reference_number)
                    ->where('provider_id', $provider->id)
                    ->first();
                if ($bid) {
                    $bid->status_id = 5; // 5 = in_progress
                    $bid->save();
                }

                //kurangi saldo yang dimiliki provider
                // $provider = ServiceProvider::find($providerId);
                $provider->account_balance -=  2000;
                $provider->save();


    
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Mulai pekerjaan',
                ], 200);
            }   
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
            ], 500);
        }

    }

    public function uploadPhotoResult(Request $request)
    {
        try {
            DB::beginTransaction();
            $image1 = base64_decode($request->image1);
            $fileName1 = uniqid() . '.jpeg';
            $filePath1 = 'foto_result/' . $fileName1;

            if($request->image2){
                $image2 = base64_decode($request->image2);
                $fileName2 = uniqid() . '.jpeg';
                $filePath2 = 'foto_result/' . $fileName2;
            }else{
                $filePath2 = null;
            }
            if($request->image3){
                $image3 = base64_decode($request->image3);
                $fileName3 = uniqid() . '.jpeg';
                $filePath3 = 'foto_result/' . $fileName3;
            }else{
                $filePath3 = null;
            }
            if($request->image4){
                $image4 = base64_decode($request->image4);
                $fileName4 = uniqid() . '.jpeg';
                $filePath4 = 'foto_result/' . $fileName4;
            }else{
                $filePath4 = null;
            }

            $photoResult = new ServiceProgressPhoto();
            $photoResult->reference_number = $request->reference_number;
            $photoResult->after_photo1 = $filePath1;
            $photoResult->after_photo2 = $filePath2;
            $photoResult->after_photo3 = $filePath3;
            $photoResult->after_photo4 = $filePath4;
            $photoResult->save();

            //simpan ke storage ke empat image
            Storage::disk('public')->put($filePath1, $image1);
            if($request->image2){
                Storage::disk('public')->put($filePath2, $image2);
            }
            if($request->image3){
                Storage::disk('public')->put($filePath3, $image3);
            }
            if($request->image4){
                Storage::disk('public')->put($filePath4, $image4);
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Foto hasil pekerjaan berhasil diunggah',
            ], 200);
            
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat mengunggah foto hasil pekerjaan',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function approveJobResult(Request $request)
    {
        $referenceNumber = $request->reference_number;
        $providerId = $request->provider_id;

        DB::beginTransaction();
        try {
            $serviceRequest = ServiceRequest::where('reference_number', $referenceNumber)->where('provider_id', $providerId)->first();
            if (!$serviceRequest) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Permintaan tidak ditemukan',
                ], 404);
            }

            // Update ServiceRequest
            $serviceRequest->status_id = 6; // 6 = completed
            $serviceRequest->save();

            // Update status bid yang dipilih
            $serviceBid = ServiceBid::where('reference_number', $referenceNumber)->where('provider_id', $providerId)->first();
            if ($serviceBid) {
                $serviceBid->status_id = 6; // 6 = completed
                $serviceBid->save();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Hasil pekerjaan berhasil disetujui',
            ], 200);

            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyetujui hasil pekerjaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function jobCompletedThisMonth(Request $request)
    {
        $user = $request->user();
        $provider = ServiceProvider::where('user_id', $user->id)->first();

        $now = now();
        $currentMonth = ServiceRequest::where('provider_id', $provider->id)
            ->where('status_id', 6)
            ->whereMonth('updated_at', $now->month)
            ->whereYear('updated_at', $now->year)
            ->count();

        $previousMonthDate = $now->copy()->subMonth();
        $previousMonth = ServiceRequest::where('provider_id', $provider->id)
            ->where('status_id', 6)
            ->whereMonth('updated_at', $previousMonthDate->month)
            ->whereYear('updated_at', $previousMonthDate->year)
            ->count();
        
        $percentageChange = $previousMonth == 0
        ? ($currentMonth > 0 ? 100 : 0)
        : (($currentMonth - $previousMonth) / $previousMonth) * 100;

        return response()->json([
            'status' => true,
            'data' => [
                'total' => $currentMonth,
                'percentage_change' => round($percentageChange, 2),
            ],
            'message' => 'Jumlah pekerjaan yang selesai bulan ini',
        ]);
    }

    public function incomeThisMonth(Request $request)
    {
        $provider = ServiceProvider::where('user_id', $request->user()->id)->first();

        if (!$provider) {
            return response()->json([
                'status' => false,
                'message' => 'Provider tidak ditemukan.',
            ], 404);
        }

        $now = now();
        $currentIncome = ServiceRequest::where('provider_id', $provider->id)
            ->where('status_id', 6)
            ->whereMonth('updated_at', $now->month)
            ->whereYear('updated_at', $now->year)
            ->sum('agreed_amount');

        $previousMonthDate = $now->copy()->subMonth();
        $previousIncome = ServiceRequest::where('provider_id', $provider->id)
            ->where('status_id', 6)
            ->whereMonth('updated_at', $previousMonthDate->month)
            ->whereYear('updated_at', $previousMonthDate->year)
            ->sum('agreed_amount');

        $percentageChange = $previousIncome == 0
            ? ($currentIncome > 0 ? 100 : 0)
            : (($currentIncome - $previousIncome) / $previousIncome) * 100;

        return response()->json([
            'status' => true,
            'data' => [
                'total' => $currentIncome,
                'percentage_change' => round($percentageChange, 2),
            ],
            'message' => 'Total pendapatan bulan ini',
        ]);
    }

    public function historyJob(Request $request)
    {
        $provider = ServiceProvider::where('user_id', $request->user()->id)->first();

        if (!$provider) {
            return response()->json([
                'status' => false,
                'message' => 'Provider tidak ditemukan.',
            ], 404);
        }

        $history = ServiceRequest::where('provider_id', $provider->id)
            ->whereIn('status_id', [6,7])
            ->whereYear('updated_at', now()->year)
            ->limit(10)
            ->orderBy('updated_at', 'desc')
            ->get([
                'reference_number',
                'description',
                'updated_at',
                'agreed_amount',
                'status_id',
            ]);

        return response()->json([
            'status' => true,
            'data' => $history,
            'message' => 'history job bulan ini',
        ]);
    }

    public function submitReview(Request $request)
    {
        $user = $request->user();
        $customer = Customer::where('user_id', $user->id)->first();

        if (!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'Customer tidak ditemukan.',
            ], 404);
        }

        //cek jika sudah ada review sebelumnya
        $ulasan = Rating::where('reference_number', $request->reference_number)
            ->where('reviewer_id', $customer->id)
            ->first();
        if ($ulasan) {
            return response()->json([
                'status' => false,
                'message' => 'Kamu sudah memberikan ulasan untuk pekerjaan ini.',
            ], 400);
        }

        $ulasan = new Rating();
        $ulasan->reference_number = $request->reference_number;
        $ulasan->score = $request->rating;
        $ulasan->review = $request->review;
        $ulasan->reviewer_id = $customer->id;
        $ulasan->save();

        return response()->json([
            'status' => true,
            'message' => 'Ulasanmu berhasil dikirim.',
            'data' => $ulasan,
        ]);
    }

    public function getProviderRating(Request $request, $id)
    {
        $referenceNumber = ServiceRequest::where('provider_id', $id)->where('status_id', 6)->pluck('reference_number');

        $ratings = Rating::whereIn('reference_number', $referenceNumber)->get();

        $summary = [
            'average' => round($ratings->avg('score'), 1),
            'total' => $ratings->count(),
            'distribution' => [
                5 => $ratings->where('score', 5)->count(),
                4 => $ratings->where('score', 4)->count(),
                3 => $ratings->where('score', 3)->count(),
                2 => $ratings->where('score', 2)->count(),
                1 => $ratings->where('score', 1)->count(),
            ],
            'reviews' => $ratings->sortByDesc('created_at')->values()->map(function ($rating) {
                return [
                    'score' => $rating->score,
                    'comment' => $rating->review,
                    'reviewer' => $rating->reviewer->name,
                    'customer_photo' => $rating->reviewer->user->profile_photo,
                    'date' => $rating->created_at->toDateString(),
                ];
            }),
        ];

        return response()->json([
            'status' => true,
            'data' => $summary,
            'message' => 'Rating untuk provider ini',
        ]);
    }

    public function topTenProvider(Request $request)
    {
        $topProviders = ServiceProvider::with([
            'user' => function ($query) {
                $query->select('id','profile_photo');
            },
            ])
            ->with([
                'certifications' =>function ($query) {
                    $query->select('specialization_id','skill_name');
                },
            ])
            ->withCount(['serviceRequests as completed_requests_count' => function ($query) {
                $query->where('status_id', 6);
            }])
            ->orderByDesc('completed_requests_count')
            ->where('status_id',  6)
            ->take(10)
            ->get();

        return response()->json([
            'status' => true,
            'data' => $topProviders,
            'message' => '10 Provider Teratas',
        ]);
    }
}
