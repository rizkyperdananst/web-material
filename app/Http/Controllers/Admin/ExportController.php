<?php

namespace App\Http\Controllers\Admin;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

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

        if ($request->is_export === "Penjualan") {
            if ($request->export_to === "PDF") {
                $penjualan = Penjualan::whereBetween('created_at', [$start_date, $end_date])->get();
                $total = Penjualan::whereBetween('created_at', [$start_date, $end_date])->sum('total_harga');

                $pdf = PDF::loadview('admin.export.export-data', compact('penjualan', 'total'))->setPaper('a4', 'landscape');
                return $pdf->stream();
            } elseif ($request->export_to === "EXCEL") {
                $exportFileName = 'report-customer_' . now()->format('Y-m-d_H-i-s') . '.xlsx';
                return Excel::download(new CustomerExport($start_date, $end_date, $is_export), $exportFileName);
            }
        } elseif ($request->is_export == "Pengeluaran") {
            if ($request->export_to == "PDF") {
                $transactions = Transaction::where('status_bayar', 'LUNAS')->whereBetween('tgl_order', [$start_date, $end_date])->get();

                $total = Transaction::where('status_bayar', 'LUNAS')->whereBetween('tgl_order', [$start_date, $end_date])->sum('total_bayar');

                $pdf = PDF::loadview('admin.transaction-history.export-excel', compact('transactions', 'total'))->setPaper('a4', 'landscape');
                return $pdf->stream();
            } elseif ($request->export_to == "EXCEL") {
                $exportFileName = 'report-customer_' . now()->format('Y-m-d_H-i-s') . '.xlsx';
                return Excel::download(new CustomerExport($start_date, $end_date, $is_export), $exportFileName);
            }
        } 
    }
}
