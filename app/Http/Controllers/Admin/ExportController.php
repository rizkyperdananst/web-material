<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Sale;
use App\Models\Penjualan;
use App\Models\Expenditure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    public function index()
    {
        return view('admin.export.index');
    }

    public function export(Request $request)
    {
        $validated = $request->validate([
            'is_export' => 'required|not_in:Pilih Filter Data',
            'export_to' => 'required|not_in:Export To',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $is_export = $validated['is_export'];
        $start_date = $validated['start_date'];
        $end_date = $validated['end_date'];

        if ($request->is_export === "Penjualan & Pengeluaran") {
            if ($request->export_to === "PDF") {
                $penjualan = Sale::whereBetween('created_at', [$start_date, $end_date])->get();
                $sale_total = Sale::whereBetween('created_at', [$start_date, $end_date])->sum('total_harga');

                $expenditure = Expenditure::whereBetween('created_at', [$start_date, $end_date])->get();
                $expenditure_total = Expenditure::whereBetween('created_at', [$start_date, $end_date])->sum('uraian_harga');

                $result = $sale_total - $expenditure_total;

                $pdf = PDF::loadview('admin.export.export-data', compact('start_date', 'end_date', 'penjualan', 'sale_total', 'expenditure', 'expenditure_total', 'result'))->setPaper('a4', 'landscape');
                return $pdf->stream();
            }
        }
    }
}
