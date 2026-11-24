<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Struk Transaksi</h2>
    </x-slot>
    <style>
        @media print {
            @page {
                size: 58mm auto;
                margin: 2mm;
            }
            body {
                background: #fff !important;
                font-family: 'Courier New', Courier, monospace !important;
                font-size: 11px !important;
                color: #000 !important;
            }
            nav, header, .no-print {
                display: none !important;
            }
            .struk-wrapper {
                padding: 0 !important;
                margin: 0 !important;
                max-width: 54mm !important;
                width: 54mm !important;
            }
            .struk-card {
                box-shadow: none !important;
                border-radius: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }
        }
    </style>
    <div class="py-8 struk-wrapper">
        <div class="max-w-md mx-auto sm:px-6 struk-wrapper">
            <x-card class="struk-card">
                <div class="text-center mb-2">
                    <p class="font-bold text-base">POS BAROKAH MART</p>
                    <p class="text-xs text-gray-500">Jl. Raya Karawang No. 10</p>
                </div>
                <hr class="border-dashed my-2">
                <div class="text-xs text-gray-600 mb-2">
                    <p>No: {{ $transaction->invoice_number }}</p>
                    <p>Tgl: {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                    <p>Kasir: {{ $transaction->user->name }}</p>
                </div>
                <hr class="border-dashed my-2">
                <div class="space-y-1 text-xs">
                    @foreach ($transaction->details as $detail)
                        <div>
                            <p class="font-medium">{{ $detail->product->name }}</p>
                            <div class="flex justify-between">
                                <span>{{ $detail->qty }} x Rp{{ number_format($detail->price, 0, ',', '.') }}</span>
                                <span>Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr class="border-dashed my-2">
                <div class="space-y-1 text-xs">
                    <div class="flex justify-between font-bold text-sm">
                        <span>TOTAL</span>
                        <span>Rp{{ number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Bayar</span>
                        <span>Rp{{ number_format($transaction->pay, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Kembali</span>
                        <span>Rp{{ number_format($transaction->change, 0, ',', '.') }}</span>
                    </div>
                </div>
                <hr class="border-dashed my-3">
                <p class="text-center text-xs text-gray-500">Terima kasih telah berbelanja!</p>
                <div class="mt-4 space-y-2 no-print">
                    <button type="button" onclick="window.print()"
                            class="w-full bg-emerald-600 text-white py-2 rounded-md font-medium">
                        Cetak Struk (58mm)
                    </button>
                    <a href="{{ route('pos.index') }}"
                        class="block text-center bg-indigo-600 text-white py-2 rounded-md">
                        Transaksi Baru
                    </a>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>