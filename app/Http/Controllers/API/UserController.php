<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\User;
use App\Models\Customer;
use App\Models\ServiceBid;
use App\Models\ServicePhoto;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\Specialization;
use App\Models\ServiceProvider;
use App\Http\Controllers\Controller;
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

        $user = User::where('email', $request->email)->whereIn('role',['customer'])->first();

        
        
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

        $user = User::where('email', $request->email)->whereIn('role',['vendor'])->first();

        
        
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
            'message' => 'Selamat datang kembali '.$vendor.'semoga hari ini rejeki kamu berlimpah yah',
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

    // public function simpanSertifikat(Request $request)
    // {
    //     // $request->validate([
    //     //     'dokumen' => 'required|file|mimes:pdf|max:2048',
    //     // ]);

    //     if($request->file('dokumen')){
    //         $file = $request->file('dokumen');
    //         $path = $file->store('dokumen', 'public');

    //     }


    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Sertifikat berhasil diunggah',
    //         'data' => [
    //         'sertifikat' => $file,
    //         ],
    //     ], 200);
    // }

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

    public function broadcastRequestBantuan(Request $request)
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

            //insert juga ke tabel service_bids untuk dilihat oleh semua vendor
            // $serviceBid = new ServiceBid();
            // $serviceBid->reference_number = $reference_number;
            // $serviceBid->status_id = 1; // 1 = waiting for confirmation
            // $serviceBid->save();

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

   

    // public function listBroadcast(Request $request)
    // {
    //     // get specialization_id from login user
    //     $user = $request->user();
    //     $vendor = ServiceProvider::where('user_id', $user->id)->first();
    //     //ambil specialization_id dari tabel provider_certification sesuai dengan user_id
    //     $specialization_id = ProviderCertification::where('provider_id', $vendor->id)
    //         ->pluck('specialization_id')
    //         ->toArray();
        
    //     //ambil latitude dan longitude dari tabel service_provider
    //     $vendorLat = $vendor->latitude;
    //     $vendorLng = $vendor->longitude;

    //     //tampilkan semua service request yang status_id = 1 dan specialization_id yang sama dengan specialization_id vendor
    //     $serviceRequest = ServiceRequest::join('customers', 'customers.id', '=', 'service_requests.customer_id')
    //         ->join('users', 'users.id', '=', 'customers.user_id')
    //         ->where('status_id', 1)
    //         ->select(
    //             'service_requests.*','customers.name as customer_name','users.profile_photo as customer_profile_photo',
    //             DB::raw("6371 * acos(cos(radians($vendorLat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($vendorLng)) + sin(radians($vendorLat)) * sin(radians(latitude))) AS distance")
    //         )
    //         ->whereIn('specialization_id', $specialization_id)
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'List broadcast',
    //         'data' => $serviceRequest,
    //     ], 200);
    // }

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

    public function listTransactionsVendor(Request $request)
    {
        $user = $request->user();
        $vendor = ServiceProvider::where('user_id', $user->id)->first();

        //ambil semua service_request yang status_id 2 dan provider_id vendor
        $serviceRequest = ServiceRequest::join('customers', 'customers.id', '=', 'service_requests.customer_id')
            ->join('service_bids', 'service_bids.reference_number', '=', 'service_requests.reference_number')
            ->join('specializations', 'specializations.id', '=', 'service_requests.specialization_id')
            ->join('users', 'users.id', '=', 'customers.user_id')
            ->join('service_statuses', 'service_statuses.id', '=', 'service_bids.status_id')
            ->select(
                'service_requests.*',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'customers.address as customer_address',
                'specializations.name as specialization_name',
                'users.profile_photo as customer_profile_photo',
                'users.email as customer_email',
                'service_bids.bid_amount as bid_amount',
                'service_bids.status_id as status_transaction',
                'service_statuses.name as status_name',
                'service_statuses.color as status_color',
                'service_bids.id as service_bid_id',
            )

            ->where('service_bids.provider_id', $vendor->id)
            ->whereIn('service_bids.status_id',[2,3,4,5,6,7])
            ->orderBy('.service_requests.created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'List transaksi vendor',
            'data' => $serviceRequest,
        ], 200);
    }

    public function listTransactionsCustomer(Request $request)
    {
        $user = $request->user();
        $customer = Customer::where('user_id', $user->id)->first();

        //ambil semua service_request yang disudah dibroadcast customer
        // $serviceRequest = ServiceRequest::join('specializations', 'specializations.id', '=', 'service_requests.specialization_id')
        //     ->leftJoin('service_photos', 'service_photos.reference_number', '=', 'service_requests.reference_number')
        //     ->leftJoin(DB::raw('(SELECT reference_number, COUNT(*) as total_applicants FROM service_bids GROUP BY reference_number) as sb'),
        //         'sb.reference_number', '=', 'service_requests.reference_number')
        //     ->select(
        //         'service_requests.*',
        //         'specializations.name as specialization_name',
        //         'service_photos.image_1 as image_1',
        //         DB::raw('COALESCE(sb.total_applicants, 0) as total_applicants')
        //     )
        //     ->where('service_requests.customer_id', $customer->id)
        //     ->orderBy('service_requests.created_at', 'desc')
        //     ->get();
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
            ->orderBy('service_requests.created_at', 'desc')
            ->get();

        $serviceRequests = $serviceRequestsQuery->map(function ($request) {
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
            'message' => 'List transaksi customer',
            'data' => $serviceRequest,
        ], 200);
    }

    public function lihatImage(Request $request, $image)
    {
        $serviceRequest = ServicePhoto::where('reference_number', $image)
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

    public function canceledJob(Request $request)
    {
        $user = $request->user();
        $vendor = ServiceProvider::where('user_id', $user->id)->first();

        //hapus penawaran vendor di service_bid
        $serviceBid = ServiceBid::where('id', $request->idRequest)
            ->where('provider_id', $vendor->id)
            ->first();
        if (!$serviceBid) {
            return response()->json([
                'status' => false,
                'message' => 'Permintaan tidak ditemukan',
            ], 404);
        }else{
            $serviceBid->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Permintaan berhasil dibatalkan',
            ], 200);
        }


    }
}
