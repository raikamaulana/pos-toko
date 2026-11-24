<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Riwayat Pembelian Stok (Purchase Order)</h2>
            <a href="{{ route('purchases.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm">
                + Catat Pembelian Stok
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm">{{ session('success') }}</div>
                @endif
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">No. PO</th>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Supplier</th>
                            <th class="px-4 py-2 text-left">Dicatat Oleh</th>
                            <th class="px-4 py-2 text-right">Total Pembelian</th>
                            <th class="px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($purchases as $po)
                            <tr>
                                <td class="px-4 py-2 font-medium">{{ $po->invoice_number }}</td>
                                <td class="px-4 py-2">{{ $po->purchase_date->format('d M Y') }}</td>
                                <td class="px-4 py-2">{{ $po->supplier->name }}</td>
                                <td class="px-4 py-2">{{ $po->user->name }}</td>
                                <td class="px-4 py-2 text-right font-semibold">Rp{{ number_format($po->total, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('purchases.show', $po) }}" class="text-indigo-600">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada riwayat pembelian stok.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $purchases->links() }}</div>
            </x-card>
        </div>
    </div>
</x-app-layout>

