<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DeptRequest;
use App\Http\Resources\{DeptResource, DeptCollectionResource};
use App\Models\{Dept, Deptor};
use Auth;

class DeptController extends Controller
{
    public function index(Request $request)
    {
        $lists = Auth::user()->deptor;

        $items = array();

        foreach ($lists as $list) {
            $items[] = $list->dept;
        }

        return DeptCollectionResource::collection($items);
    }

    public function show(Request $request)
    {
        $show = Dept::find($request->dept);

        return new DeptResource($show);
    }

    public function store(DeptRequest $request)
    {
        $deptor = Deptor::find($request->deptor_id);

        $create = $deptor->dept()->create([
            'deptor_id' => $request->deptor_id,
            'original_dept' => $request->original_dept,
            'interest' => $request->interest,
            'dept_until' => $request->dept_until,
            'note' => $request->note,
            'status' => 0,
            'total_dept' => $request->original_dept,
        ]);

        if($create) {
            return response()->json([
                'message' => 'Hutang berhasil disimpan',
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Terjadi kesalahan, silakan coba lagi nanti',
                'status_code' => 500
            ]);
        }

    }

    public function update(DeptRequest $request)
    {
        $deptor = Deptor::find($request->deptor_id);

        $create = $deptor->dept()->update([
            'deptor_id' => $request->deptor_id,
            'original_dept' => $request->original_dept,
            'interest' => $request->interest,
            'dept_until' => $request->dept_until,
            'note' => $request->note,
            'status' => 0,
            'total_dept' => $request->original_dept,
        ]);

        if($create) {
            return response()->json([
                'message' => 'Hutang berhasil disimpan',
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Terjadi kesalahan, silakan coba lagi nanti',
                'status_code' => 500
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $dept = Dept::find($request->dept);

        $delete = $dept->delete();

        if($delete) {
            return response()->json([
                'message' => 'Hutang berhasil dihapus',
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
