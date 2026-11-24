<?php
namespace App\Exports;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Collection;

class BestSellingProductsSheet implements FromCollection, WithHeadings, WithMapping, WithTitle {
    public function __construct(protected mixed $start,protected mixed $end,protected mixed $userId = null) {}
    public function collection(): Collection {
        return TransactionDetail::select(
                'products.code', 'products.name',
                DB::raw('SUM(transaction_details.qty) as total_qty'),
                DB::raw('SUM(transaction_details.subtotal) as total_pendapatan')
            )
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->whereBetween('transactions.created_at', [$this->start, $this->end])
            ->when($this->userId, fn($q) => $q->where('transactions.user_id', $this->userId))
            ->groupBy('products.id', 'products.code', 'products.name')
            ->orderByDesc('total_qty')
            ->get();
    }
    public function headings(): array {
        return ['Kode Produk', 'Nama Produk', 'Total Terjual (Qty)', 'Total Pendapatan'];
    }
    public function map($row): array {
        return [$row->code, $row->name, $row->total_qty, $row->total_pendapatan];
    }
    public function title(): string { return 'Produk Terlaris'; }
}

