<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
class SalesExport implements Export, WithMultipleSheets {
    use Exportable;
    public function __construct(
        protected mixed $start,
        protected mixed $end,
        protected mixed $userId = null
    ) {}
    public function sheets(): array {
        return [
            new SalesTransactionSheet($this->start, $this->end, $this->userId),
            new BestSellingProductsSheet($this->start, $this->end, $this->userId),
        ];
    }
}

