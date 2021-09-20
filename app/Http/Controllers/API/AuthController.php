<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{UserRegisterRequest, UserLoginRequest};
use App\Mail\API\UserConfirmationRegistration;
use App\Models\User;
use Carbon\Carbon;
use DB, Log, Mail;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    //-- Registrasi untuk pengguna baru
    
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
                Mail::to($user->email)->send(new UserConfirmationRegistration($user));
                DB::commit();


                return response()->json([
                    'message' => 'Email verifikasi sudah dikirim'
                ], 200);
            }
            else {
                return response()->json([
                    'message' => 'Akun sudah ada',
                ], 500);
            }
        }
        catch(\Throwable $e) {
            DB::rollback();

            return response()->json([
                'message' => 'Akun tidak dapat dibuat',
                'error' => $e,
            ], 500);
        }
        
    }

    //-- Periksa data input dengan data yang ada pada database
    // Bila semua syarat terpenuhi, berikan token login

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

            if(!$user->email_verified_at) {
                return response()->json([
                    'message' => 'User belum terverifikasi',
                ], 401); 
            }

            if($user->status == 0) {
                return response()->json([
                    'message' => 'User tidak aktif',
                ], 401); 
            }

            return response()->json([
                'access_token' => $authToken,
                'message' => 'User berhasil masuk'
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

    //-- Verifikasi email untuk akun yang baru mendaftar
    // Bila ditekan, akan redirect ke halaman utama bonku

    public function verifyUser($id)
    {
        $user = User::find($id);

        $user->update([
            'status' => 1,
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ]);

       return Redirect::away(env('WEB_BONKU_MAIN'));
    }
}
