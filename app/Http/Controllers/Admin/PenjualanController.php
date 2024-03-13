<?php

namespace App\Http\Controllers\Admin;

use App\Models\Material;
use App\Models\Komoditas;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::all();

        return view('admin.penjualan.index', compact('penjualan'));
    }

    public function getMaterials(Request $request)
    {
        $komoditas = $request->input('komoditas');

        // Ambil data material dari database berdasarkan komoditas
        $materials = Material::where('komoditas_id', $komoditas)->get();

        return response()->json($materials);
    }

    public function create()
    {
        $komoditas = Komoditas::all();

        return view('admin.penjualan.create', compact('komoditas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama_pembeli' => 'required',
                'no_nota' => 'nullable',
                'komoditas_id' => 'required|integer|exists:komoditas,id|not_in:Pilih Komoditas',
                'satuan' => 'required|not_in:Pilih Satuan',
                'jumlah' => 'required',
                'harga' => 'required',
                'total_harga' => 'required',
            ],
            [
                'nama_pembeli.required' => 'Nama pembeli harus diisi',
                'komoditas_id.required' => 'Komoditas harus dipilih',
                'komoditas_id.integer' => 'Komoditas tidak valid',
                'komoditas_id.exists' => 'Komoditas tidak ditemukan',
                'komoditas_id.not_in' => 'Komoditas harus dipilih',
                'satuan.required' => 'Satuan harus diisi',
                'satuan.not_in' => 'Satuan harus dipilih',
                'jumlah.required' => 'Jumlah harus diisi',
                'harga.required' => 'Harga harus diisi',
                'total_harga.required' => 'Total harga harus diisi',
            ]
        );

        $validated['no_nota'] = 'INV/' . date('d-m-Y') . '/' . random_int(1000, 9999);

        $penjualan = Penjualan::create($validated);

        return redirect()->route('admin.penjualan.index')->with('success', 'Data Penjualan Berhasil Ditambahkan');
    }

    public function cetak_struk($id)
    {
     $penjualan = Penjualan::find($id);
 
     $pdf = PDF::loadview('admin.penjualan.struk',compact('penjualan'));

     return $pdf->stream();
    }
}
