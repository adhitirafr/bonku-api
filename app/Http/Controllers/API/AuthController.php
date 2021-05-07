<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{UserRegisterRequest, UserLoginRequest};
use App\Models\User;
use DB;

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
    
            $authToken = $user->createToken('auth-token')->plainTextToken;

            DB::commit();
    
            return response()->json([
                'code' => 200,
                'message' => 'Akun berhasil dibuat',
                'access_token' => $authToken,
            ]);
        }
        catch(\Exception $e) {
            DB::rollback();

            return response()->json([
                'code' => 500,
                'error_message' => $e,
                'message' => 'Akun tidak dapat dibuat',
            ]);
        }
        
    }

    public function login(UserLoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => [
                        'Invalid credentials'
                    ],
                ]
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        $authToken = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'access_token' => $authToken,
        ]);
    }
}
