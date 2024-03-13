<?php

namespace App\Http\Controllers\Admin;

use App\Models\Material;
use App\Models\Komoditas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $material = Material::with('komoditas')->get();
        $komoditas = Komoditas::with('material')->get();

        return view('admin.material.index', compact('komoditas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $komoditas = Komoditas::all();
        $satuan = ['DT Engkel', 'DT Colt'];

        return view('admin.material.create', compact('komoditas', 'satuan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'komoditas_id' => 'required|integer|exists:komoditas,id',
                'satuan' => 'required|not_in:Pilih Satuan',
                'stok' => 'required',
                'harga' => 'required',
            ],
            [
                'komoditas_id.required' => 'Komoditas harus diisi',
                'komoditas_id.integer' => 'Komoditas tidak valid',
                'komoditas_id.exists' => 'Komoditas tidak ada',
                'satuan.required' => 'Satuan harus diisi',
                'satuan.not_in' => 'Satuan tidak valid',
                'stok.required' => 'Stok harus diisi',
                'harga.required' => 'Harga harus diisi',
            ]
        );

        $replace_harga = str_replace('.', '', $request->harga);
        $validated['harga'] = preg_replace("/[^0-9]/", "", $replace_harga);

        $material = Material::create($validated);

        return redirect()->route('admin.material.index')->with('success', 'Data Material Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $m = Material::find($id);
        $komoditas = Komoditas::all();
        $satuan = ['DT Engkel', 'DT Colt'];

        return view('admin.material.edit', compact('komoditas', 'm', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'komoditas_id' => 'required|integer|exists:komoditas,id',
                'satuan' => 'required|not_in:Pilih Satuan',
                'stok' => 'required',
                'harga' => 'required',
            ],
            [
                'komoditas_id.required' => 'Komoditas harus diisi',
                'komoditas_id.integer' => 'Komoditas tidak valid',
                'komoditas_id.exists' => 'Komoditas tidak ada',
                'satuan.required' => 'Satuan harus diisi',
                'satuan.not_in' => 'Satuan tidak valid',
                'stok.required' => 'Stok harus diisi',
                'harga.required' => 'Harga harus diisi',
            ]
        );

        $replace_harga = str_replace('.', '', $request->harga);
        $validated['harga'] = preg_replace("/[^0-9]/", "", $replace_harga);

        $material = Material::find($id)->update($validated);

        return redirect()->route('admin.material.index')->with('success', 'Data Material Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::find($id)->delete();

        return redirect()->route('admin.material.index')->with('success', 'Data Material Berhasil Dihapus');
    }
}
