<?php

namespace App\Http\Controllers\Admin;

use App\Models\Material;
use App\Models\Komoditas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KomoditasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $komoditas = Komoditas::all();

        return view('admin.komoditas.index', compact('komoditas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.komoditas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'komoditas' => 'required',
        ]);

        $komoditas = Komoditas::create($validated);

        return redirect()->route('admin.komoditas.index')->with('success', 'Data Komoditas Berhasil Ditambahkan');
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
        $k = Komoditas::find($id);

        return view('admin.komoditas.edit', compact('k'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'komoditas' => 'required',
        ]);

        $komoditas = Komoditas::find($id)->update($validated);

        return redirect()->route('admin.komoditas.index')->with('success', 'Data Komoditas Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $komoditas = Komoditas::find($id);
        $material = Material::where('komoditas_id', $komoditas->id)->get();
        foreach($material as $item) {
            $item->delete();
        }
        $komoditas->delete();

        return redirect()->route('admin.komoditas.index')->with('success', 'Data Komoditas Berhasil Dihapus');
    }
}
