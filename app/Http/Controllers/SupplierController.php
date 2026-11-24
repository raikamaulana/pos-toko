<?php
namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;
class SupplierController extends Controller {
    public function index() {
        $suppliers = Supplier::withCount('purchases')->latest()->paginate(10);
        return view('master-data.supplier.index', compact('suppliers'));
    }
    public function create() { return view('master-data.supplier.create'); }
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);
        Supplier::create($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }
    public function edit(Supplier $supplier) { return view('master-data.supplier.edit', compact('supplier')); }
    public function update(Request $request, Supplier $supplier) {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);
        $supplier->update($validated);
        return redirect()->route('suppliers.index')->with('success', 'Data supplier berhasil diperbarui.');
    }
    public function destroy(Supplier $supplier) {
        if ($supplier->purchases()->exists()) {
            return back()->with('error', 'Supplier tidak dapat dihapus karena memiliki riwayat pembelian.');
        }
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}

