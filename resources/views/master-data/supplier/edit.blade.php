<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Ubah Data Supplier</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <form action="{{ route('suppliers.update', $supplier) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Supplier</label>
                        <input type="text" name="name" value="{{ old('name', $supplier->name) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}" class="mt-1 block w-full rounded-md border-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300">{{ old('address', $supplier->address) }}</textarea>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Simpan Perubahan</button>
                        <a href="{{ route('suppliers.index') }}" class="px-4 py-2 text-gray-600">Batal</a>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>

