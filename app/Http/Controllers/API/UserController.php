<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\{UserRegisterRequest, UserLoginRequest};
use App\Models\User;
use Hash, DB, Str, Log;
use Auth;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        return new UserResource($user);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $update = $user->update([
            'name' => $request->name,
        ]);

        if($update) {
            return response()->json([
                'message' => 'Profil berhasil disimpan',
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Terjadi kesalahan, silakan coba lagi nanti',
                'status_code' => 500
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        //-- Check password
        if(Hash::check($request->old_password, $user->password)) {
            $update = $user->update([
                'password' => bcrypt($request->new_password)
            ]);
    
            if($update) {
                return response()->json([
                    'message' => 'Profil berhasil disimpan',
                    'status_code' => 200
                ]);
            } else {
                return response()->json([
                    'message' => 'Terjadi kesalahan, silakan coba lagi nanti',
                    'status_code' => 500
                ]);
            }
        } else {
            return response()->json([
                'message' => 'password tidak sama',
                'status_code' => 404
            ]);
        }
    }
}
