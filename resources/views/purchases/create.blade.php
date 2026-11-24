<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Catat Pembelian Stok (Purchase Order)</h2>
    </x-slot>
    <div class="py-12" x-data="purchaseForm()" data-products='@json($products)'>
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <form action="{{ route('purchases.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Supplier</label>
                            <select name="supplier_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                                <option value="" disabled selected>Pilih Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Pembelian</label>
                            <input type="date" name="purchase_date" value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-800">Daftar Barang Dibeli</h3>
                            <button type="button" @click="addRow()" class="bg-gray-800 text-white px-3 py-1 rounded-md text-xs">
                                + Tambah Baris
                            </button>
                        </div>

                        <div class="space-y-3">
                            <template x-for="(row, index) in rows" :key="index">
                                <div class="grid grid-cols-12 gap-2 items-center bg-gray-50 p-3 rounded-md">
                                    <div class="col-span-5">
                                        <select :name="'items[' + index + '][product_id]'" x-model="row.product_id" class="w-full rounded-md border-gray-300 text-sm" required>
                                            <option value="">-- Pilih Produk --</option>
                                            <template x-for="p in products" :key="p.id">
                                                <option :value="p.id" x-text="p.code + ' - ' + p.name + ' (Stok: ' + p.stock + ')'"></option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <input type="number" :name="'items[' + index + '][qty]'" x-model.number="row.qty" min="1" placeholder="Qty" class="w-full rounded-md border-gray-300 text-sm text-center" required>
                                    </div>
                                    <div class="col-span-4">
                                        <input type="number" :name="'items[' + index + '][buy_price]'" x-model.number="row.buy_price" min="0" placeholder="Harga Beli Satuan" class="w-full rounded-md border-gray-300 text-sm" required>
                                    </div>
                                    <div class="col-span-1 text-center">
                                        <button type="button" @click="removeRow(index)" x-show="rows.length > 1" class="text-red-600 font-bold">&times;</button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="flex justify-between items-center border-t pt-4">
                        <div class="text-lg font-semibold">
                            Total PO: <span x-text="'Rp' + grandTotal().toLocaleString('id-ID')"></span>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('purchases.index') }}" class="px-4 py-2 text-gray-600">Batal</a>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Simpan & Tambah Stok</button>
                        </div>
                    </div>
                </form>
            </x-card>
        </div>
    </div>

    @push('scripts')
    <script>
        function purchaseForm() {
            return {
                products: [],
                rows: [{ product_id: '', qty: 1, buy_price: 0 }],
                init() {
                    this.products = JSON.parse(this.$el.dataset.products);
                },
                addRow() {
                    this.rows.push({ product_id: '', qty: 1, buy_price: 0 });
                },
                removeRow(index) {
                    this.rows.splice(index, 1);
                },
                grandTotal() {
                    return this.rows.reduce((sum, r) => sum + ((r.qty || 0) * (r.buy_price || 0)), 0);
                }
            }
        }
    </script>
    @endpush
</x-app-layout>