<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Detail Kategori</h2>
            <a href="{{ route('categories.index') }}" class="text-sm text-gray-600 hover:underline">&larr; Kembali</a>
        </div>
    </x-slot>
    <div class="py-12 space-y-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $category->description ?? 'Tidak ada deskripsi' }}</p>
                    </div>
                    <div class="bg-indigo-50 rounded-md px-4 py-2 text-right">
                        <p class="text-xs text-indigo-600">Total Stok Kategori Ini</p>
                        <p class="text-lg font-bold text-indigo-700">{{ $totalStok }} unit</p>
                    </div>
                </div>
                <h4 class="font-medium mb-2">Daftar Produk ({{ $category->products->count() }} item)</h4>
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-2 text-left">Kode</th>
                            <th class="px-3 py-2 text-left">Nama Produk</th>
                            <th class="px-3 py-2 text-right">Harga</th>
                            <th class="px-3 py-2 text-right">Stok</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($category->products as $product)
                            <tr>
                                <td class="px-3 py-2">{{ $product->code }}</td>
                                <td class="px-3 py-2">{{ $product->name }}</td>
                                <td class="px-3 py-2 text-right">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right">{{ $product->stock }} {{ $product->unit }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-4 text-center text-gray-500">Belum ada produk pada kategori ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </x-card>
        </div>
    </div>
</x-app-layout>