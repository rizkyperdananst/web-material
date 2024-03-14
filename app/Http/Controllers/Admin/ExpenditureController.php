<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expenditure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenditures = Expenditure::all();

        return view('admin.expenditure.index', compact('expenditures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Expenditure::latest('no_bon')->first();
        if (!$data) {
            $noBon = "AAP/0001";
        } else {
            $oldNoBon = intval(substr($data->no_bon, 4, 4));
            $noBon = 'AAP/' . sprintf("%04s", ++$oldNoBon);
        }

        return view('admin.expenditure.create', compact('noBon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'no_bon' => 'required',
                'uraian_harga' => 'required',
                'keterangan' => 'required',
            ],
            [
                'no_bon.required' => 'No. Bon harus diisi',
                'uraian_harga.required' => 'Uraian Harga harus diisi',
                'keterangan.required' => 'Keterangan harus diisi',
            ]
        );

        $replace_uraian_harga = str_replace('.', '', $request->uraian_harga);
        $validated['uraian_harga'] = preg_replace("/[^0-9]/", "", $replace_uraian_harga);  
        
        $expenditure = Expenditure::create($validated);

        return redirect()->route('admin.expenditure.index')->with('success', 'Data Pengeluaran Berhasil Ditambah');
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
        $e = Expenditure::find($id);

        return view('admin.expenditure.edit', compact('e'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'no_bon' => 'required',
                'uraian_harga' => 'required',
                'keterangan' => 'required',
            ],
            [
                'no_bon.required' => 'No. Bon harus diisi',
                'uraian_harga.required' => 'Uraian Harga harus diisi',
                'keterangan.required' => 'Keterangan harus diisi',
            ]
        );

        $replace_uraian_harga = str_replace('.', '', $request->uraian_harga);
        $validated['uraian_harga'] = preg_replace("/[^0-9]/", "", $replace_uraian_harga);  
        
        $expenditure = Expenditure::find($id)->update($validated);

        return redirect()->route('admin.expenditure.index')->with('success', 'Data Pengeluaran Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expenditure = Expenditure::find($id)->delete();

        return redirect()->route('admin.expenditure.index')->with('success', 'Data Pengeluaran Berhasil Dihapus');
    }
}
