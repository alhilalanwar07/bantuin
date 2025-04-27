<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

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
            'specialization' => 'required',
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
                $vendor->specialization_id = $request->specialization;
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

    // Memperbarui user
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:6',
        ]);

        if(isset($validated['password'])){
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json($user);
    }

    // Menghapus user
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function listSpecializations(Request $request)
    {
        $sprecializations = Specialitation::all();

        return respons()->json([
            'status' => true,
            'data' => $sprecializations,
            'message' => 'List of specializations',
        ], 200);
    
    }
}
