<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller {
    public function sales(Request $request) {
        $start = $request->filled('start') ? Carbon::parse($request->start) : now()->subDays(6)->startOfDay();
        $end = $request->filled('end') ? Carbon::parse($request->end)->endOfDay() : now()->endOfDay();
        $query = Transaction::with('user')->whereBetween('created_at', [$start, $end]);
        if ($request->filled('user_id')) { $query->where('user_id', $request->user_id); }
        $transactions = $query->latest()->get();
        $totalPenjualan = $transactions->sum('total');
        $jumlahTransaksi = $transactions->count();
        $cashiers = User::orderBy('name')->get();
        return view('reports.sales', compact('transactions', 'totalPenjualan', 'jumlahTransaksi', 'start', 'end', 'cashiers'));
    }
    public function export(Request $request) {
        $start = $request->filled('start') ? Carbon::parse($request->start) : now()->subDays(6)->startOfDay();
        $end = $request->filled('end') ? Carbon::parse($request->end)->endOfDay() : now()->endOfDay();
        $userId = $request->user_id;
        $filename = 'laporan-penjualan-' . $start->format('Ymd') . '-' . $end->format('Ymd') . '.xlsx';
        return (new SalesExport($start, $end, $userId))->download($filename);
    }
}



