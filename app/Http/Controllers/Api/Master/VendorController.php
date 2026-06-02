<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar data vendor berhasil diambil',
            'data'    => $vendors
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_vendor'      => 'required|unique:mst_vendors,code_vendor',
            'nama_vendor'      => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'email'            => 'required|email|unique:mst_vendors,email',
            'telepon'          => 'required|string',
            'alamat'           => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $vendor = Vendor::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data vendor berhasil ditambahkan',
            'data'    => $vendor
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vendor = Vendor::find($id);

        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Data vendor tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data vendor ditemukan',
            'data'    => $vendor
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $vendor = Vendor::find($id);

        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Data vendor tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'code_vendor'      => 'required|unique:mst_vendors,code_vendor,' . $id,
            'nama_vendor'      => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'email'            => 'required|email|unique:mst_vendors,email,' . $id,
            'telepon'          => 'required|string',
            'alamat'           => 'required|string',
            'status'           => 'required|in:active,inactive'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $vendor->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data vendor berhasil diperbarui',
            'data'    => $vendor
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vendor = Vendor::find($id);

        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Data vendor tidak ditemukan'
            ], 404);
        }

        $vendor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data vendor berhasil dihapus (Soft Delete)'
        ], 200);
    }
}
