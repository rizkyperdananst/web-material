<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Expenditure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endtOfMonth = Carbon::now()->endOfMonth();

        $sale_total = Sale::whereBetween('created_at', [$startOfMonth, $endtOfMonth])->sum('total_harga');
        $expenditure_total = Expenditure::whereBetween('created_at', [$startOfMonth, $endtOfMonth])->sum('uraian_harga');

        $result = $sale_total - $expenditure_total;

        return view('admin.dashboard', compact('sale_total', 'expenditure_total', 'startOfMonth', 'endtOfMonth', 'result'));
    }
}
