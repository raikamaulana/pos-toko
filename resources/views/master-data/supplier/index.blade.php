<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Data Supplier</h2>
            <a href="{{ route('suppliers.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm">
                + Tambah Supplier
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md text-sm">{{ session('error') }}</div>
                @endif
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">Nama Supplier</th>
                            <th class="px-4 py-2 text-left">No. Telepon</th>
                            <th class="px-4 py-2 text-left">Alamat</th>
                            <th class="px-4 py-2 text-center">Total PO</th>
                            <th class="px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($suppliers as $supplier)
                            <tr>
                                <td class="px-4 py-2 font-medium">{{ $supplier->name }}</td>
                                <td class="px-4 py-2">{{ $supplier->phone ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $supplier->address ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">{{ $supplier->purchases_count }}</td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <a href="{{ route('suppliers.edit', $supplier) }}" class="text-indigo-600">Ubah</a>
                                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
                                        onsubmit="return confirm('Hapus supplier {{ $supplier->name }}?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada data supplier.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $suppliers->links() }}</div>
            </x-card>
        </div>
    </div>
</x-app-layout>

