<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
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
            'message' => 'Selamat datang kembali '.$vendor,
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
    // Memperbarui user
    // public function update(Request $request, User $user)
    // {
    //     $validated = $request->validate([
    //         'name'  => 'sometimes|string|max:255',
    //         'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
    //         'password' => 'sometimes|string|min:6',
    //     ]);

    //     if(isset($validated['password'])){
    //         $validated['password'] = Hash::make($validated['password']);
    //     }

    //     $user->update($validated);

    //     return response()->json($user);
    // }

    public function updateProfileVendor(Request $request)
    {
        if($request->password){
            try {
                DB::beginTransaction();
                //Ambil email lama sebelum ada update
                $oldEmail = $request->user()->email;
                //cek email apabila sudah digunakan oleh user lain kecuali user yang sedang login
                $user = User::where('email', $request->email)->where('id','!=',$request->user()->id)->first();
                if($user){
                    return response()->json([
                        'success' => false,
                        'message' => 'Email sudah digunakan oleh user lain'
                    ], 422);
                }
                
                //update data user
                $user = User::where('id', $request->user()->id)->first();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();

                //update data customer
                $customer = ServiceProvider::where('user_id', $request->user()->id)->first();
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->address = $request->address;
                $customer->gender = $request->gender;
                $customer->save();

                //Jika email diupdate, maka kirimkan email verifikasi ke email baru
                if($oldEmail != $request->email){
                    $request->user()->update([
                        'email_verified_at' => null,
                    ]);
                    $request->user()->sendEmailVerificationNotification();

                   //logout user
                    $request->user()->tokens()->delete();
                    return response()->json([
                        'success' => false,
                        'message' => 'Silakan verifikasi email Anda terlebih dahulu, cek kotak masuk email Anda',
                    ], 422);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Profil  berhasil diupdate',
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'message' => 'Profil  gagal diupdate'
                ], 422);
            }
        }else{
            try {
                DB::beginTransaction();
                //Ambil email lama sebelum ada update
                $oldEmail = $request->user()->email;
                //cek email apabila sudah digunakan oleh user lain kecuali user yang sedang login
                $user = User::where('email', $request->email)->where('id','!=',$request->user()->id)->first();
                if($user){
                    return response()->json([
                        'success' => false,
                        'message' => 'Email sudah digunakan oleh user lain'
                    ], 422);
                }
                //update data user
                $user = User::where('id', $request->user()->id)->first();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();

                //update data customer
                $customer = ServiceProvider::where('user_id', $request->user()->id)->first();
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->address = $request->address;
                $customer->gender = $request->gender;
                $customer->save();

                //Jika email diupdate, maka kirimkan email verifikasi ke email baru
                if($oldEmail != $request->email){
                    $request->user()->update([
                        'email_verified_at' => null,
                    ]);
                    $request->user()->sendEmailVerificationNotification();

                   //logout user
                    $request->user()->tokens()->delete();
                    return response()->json([
                        'success' => false,
                        'message' => 'Silakan verifikasi email Anda terlebih dahulu, cek kotak masuk email Anda',
                    ], 422);
                }
                
                return response()->json([
                    'success' => true,
                    'message' => 'Profil berhasil diupdate',
                ]);
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'message' => 'Profil  gagal diupdate'
                ], 422);
            }
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

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ], 200);
    }
}
