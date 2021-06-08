<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DeptorResource;
use App\Models\Deptor;
use Auth, Log;

class DeptorController extends Controller
{
    //-- List daftar penghutang

    public function index(Request $request)
    {
        $deptors = Auth::user()->deptor;

        return DeptorResource::collection($deptors);
    }

    //-- Simpan data penghutang baru

    public function store(Request $request) 
    {
        $user = Auth::user();

        $create = $user->deptor()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'identity' => $request->identity,
            'address' => $request->address,
            'note' => $request->note
        ]);

        if($create) {
            return response()->json([
                'message' => 'Penghutang berhasil disimpan',
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Terjadi kesalahan, silakan coba lagi nanti',
                'status_code' => 500
            ]);
        }
    }

    //-- Edit Deptor

    public function update(Request $request)
    {
        $deptor = Deptor::find($request->deptor);

        $edit = $deptor->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'identity' => $request->identity,
            'address' => $request->address,
            'note' => $request->note
        ]);

        if($edit) {
            return response()->json([
                'message' => 'Penghutang berhasil disimpan',
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Terjadi kesalahan, silakan coba lagi nanti',
                'status_code' => 500
            ]);
        }
    }

    //-- Show penghutang

    public function show(Request $request)
    {
        $user = Deptor::find($request->deptor);

        return new DeptorResource($user);
    }

    //-- Delete deptor

    public function destroy(Request $request) 
    {
        $deptor = Deptor::find($request->deptor);

        //-- Delete the dept history

        $delete = $deptor->delete();

        if($delete) {
            return response()->json([
                'message' => 'Penghutang berhasil dihapus',
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Terjadi kesalahan, silakan coba lagi nanti',
                'status_code' => 500
            ]);
        }
    }
}
