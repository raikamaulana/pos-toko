<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Detail Purchase Order</h2></x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="flex justify-between mb-4">
                    <div>
                        <p class="text-sm text-gray-500">Nomor PO</p>
                        <p class="font-semibold text-lg">{{ $purchase->invoice_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Supplier</p>
                        <p class="font-semibold">{{ $purchase->supplier->name }}</p>
                        <p class="text-xs text-gray-500">{{ $purchase->purchase_date->format('d M Y') }}</p>
                    </div>
                </div>
                <table class="min-w-full divide-y divide-gray-200 text-sm mb-4">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-2 text-left">Produk</th>
                            <th class="px-3 py-2 text-center">Qty Masuk</th>
                            <th class="px-3 py-2 text-right">Harga Beli</th>
                            <th class="px-3 py-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($purchase->details as $detail)
                            <tr><td class="px-3 py-2">{{ $detail->product->name }}</td>
                                <td class="px-3 py-2 text-center">+{{ $detail->qty }} {{ $detail->product->unit }}</td>
                                <td class="px-3 py-2 text-right">Rp{{ number_format($detail->buy_price, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right">Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-between items-center border-t pt-3">
                    <a href="{{ route('purchases.index') }}" class="text-sm text-gray-600">&larr; Kembali</a>
                    <p class="font-semibold text-base">Total: Rp{{ number_format($purchase->total, 0, ',', '.') }}</p>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>

