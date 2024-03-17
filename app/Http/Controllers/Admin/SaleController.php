<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Sale;
use App\Models\Material;
use App\Models\Commodity;
use App\Models\Komoditas;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function index()
    {
        $penjualan = Sale::all();

        return view('admin.sale.index', compact('penjualan'));
    }

    public function getMaterials(Request $request)
    {
        $komoditas = $request->input('komoditas');

        // Ambil data material dari database berdasarkan komoditas
        $materials = Material::where('commodity_id', $komoditas)->get();

        return response()->json($materials);
    }

    public function create()
    {
        $komoditas = Commodity::all();
        $data = Sale::latest('no_nota')->first();
        if (!$data) {
            $noNota = "N0001";
        } else {
            $oldNoNota = intval(substr($data->no_nota, 4, 4));
            $noNota = 'N' . sprintf("%04s", ++$oldNoNota);
        }

        $tanggal = date('d');

        $lastSPB = Sale::orderBy('id', 'desc')->first();

        if ($lastSPB) {
            $lastNo = $lastSPB->no_spb;
            $lastNo = intval(substr($lastNo, -4));
            $nextNo = $lastNo + 1;
        } else {
            $nextNo = 1;
        }

        $noSPB = 'SPB/' . $tanggal . '/' . sprintf("%04d", $nextNo);

        return view('admin.sale.create', compact('komoditas', 'noNota', 'noSPB'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama_pembeli' => 'required',
                'no_nota' => 'nullable',
                'commodity_id' => 'required|integer|exists:commodities,id|not_in:Pilih Komoditas',
                'satuan' => 'required|not_in:Pilih Satuan',
                'jumlah' => 'required',
                'harga' => 'required',
                'total_harga' => 'required',
                'no_spb' => 'nullable',
                'status' => 'required|not_in:Pilih Status',
                'supir' => 'nullable',
                'no_plat' => 'nullable',
                'jam_masuk' => 'nullable',
                'jam_keluar' => 'nullable',
                'no_hp' => 'nullable',
            ],
            [
                'nama_pembeli.required' => 'Nama pembeli harus diisi',
                'commodity_id.required' => 'Komoditas harus dipilih',
                'commodity_id.integer' => 'Komoditas tidak valid',
                'commodity_id.exists' => 'Komoditas tidak ditemukan',
                'commodity_id.not_in' => 'Komoditas harus dipilih',
                'satuan.required' => 'Satuan harus diisi',
                'satuan.not_in' => 'Satuan harus dipilih',
                'jumlah.required' => 'Jumlah harus diisi',
                'harga.required' => 'Harga harus diisi',
                'total_harga.required' => 'Total harga harus diisi',
                'status.required' => 'Status harus dipilih',
                'status.not_in' => 'Status harus dipilih',
            ]
        );

        $penjualan = Sale::create($validated);

        return redirect()->route('admin.sale.index')->with('success', 'Data Penjualan Berhasil Ditambahkan');
    }

    public function show($id)
    {
        $sale = Sale::find($id);

        return view('admin.sale.show', compact('sale'));
    }

    public function edit($id)
    {
        $sale = Sale::find($id);
        $komoditas = Commodity::all();
        $sales = Sale::all();
        $status = ['Lunas', 'Kredit'];
        
        return view('admin.sale.edit', compact('sale', 'komoditas', 'sales', 'status'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'nama_pembeli' => 'required',
                'no_nota' => 'nullable',
                'commodity_id' => 'required|integer|exists:commodities,id|not_in:Pilih Komoditas',
                'satuan' => 'required|not_in:Pilih Satuan',
                'jumlah' => 'required',
                'harga' => 'required',
                'total_harga' => 'required',
                'no_spb' => 'nullable',
                'status' => 'required|not_in:Pilih Status',
                'supir' => 'nullable',
                'no_plat' => 'nullable',
                'jam_masuk' => 'nullable',
                'jam_keluar' => 'nullable',
                'no_hp' => 'nullable',
            ],
            [
                'nama_pembeli.required' => 'Nama pembeli harus diisi',
                'commodity_id.required' => 'Komoditas harus dipilih',
                'commodity_id.integer' => 'Komoditas tidak valid',
                'commodity_id.exists' => 'Komoditas tidak ditemukan',
                'commodity_id.not_in' => 'Komoditas harus dipilih',
                'satuan.required' => 'Satuan harus diisi',
                'satuan.not_in' => 'Satuan harus dipilih',
                'jumlah.required' => 'Jumlah harus diisi',
                'harga.required' => 'Harga harus diisi',
                'total_harga.required' => 'Total harga harus diisi',
                'status.required' => 'Status harus dipilih',
                'status.not_in' => 'Status harus dipilih',
            ]
        );

        $penjualan = Sale::find($id)->update($validated);

        return redirect()->route('admin.sale.index')->with('success', 'Data Penjualan Berhasil Diubah');
    }

    public function cetak_struk($id)
    {
        $sale = Sale::find($id);

        $pdf = PDF::loadview('admin.sale.struk', compact('sale'))->setPaper('f4', 'potrrait');

        return $pdf->stream();
    }
}
