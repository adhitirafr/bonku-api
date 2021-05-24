<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{UserRegisterRequest, UserLoginRequest};
use App\Models\User;
use DB, Log;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            if($user) {
                $authToken = $user->createToken('auth-token')->plainTextToken;
                DB::commit();
    
                return response()->json([
                    'message' => 'Akun berhasil dibuat',
                    'access_token' => $authToken,
                ], 200);
            }
            else {
                return response()->json([
                    'message' => 'Akun sudah ada',
                ], 500);
            }
        }
        catch(\Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => 'Akun tidak dapat dibuat',
            ], 500);
        }
        
    }

    public function login(UserLoginRequest $request)
    {
        try {
            $credentials = request(['email', 'password']);
            if (!auth()->attempt($credentials)) {
                return response()->json([
                    'message' => 'Email atau password salah',
                ], 404);
            }

            $user = User::where('email', $request->email)->first();
            $authToken = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'access_token' => $authToken,
            ], 200);
        }
        catch(ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User tidak ditemukan',
            ], 404);
        }
        catch (Exception $e) { // Anything that went wrong
            return response()->json([
                'message' => 'Email atau password salah',
            ], 404);
        }
    }
}
