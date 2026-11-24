<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function index(Request $request) {
        $query = Product::with('category');
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('code', 'like', "%{$keyword}%");
            });
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('stock_status')) {
            if ($request->stock_status === 'habis') {
                $query->where('stock', 0);
            } elseif ($request->stock_status === 'menipis') {
                $query->where('stock', '>', 0)->where('stock', '<', 10);
            }
        }
        $perPage = in_array($request->per_page, [10, 25, 50]) ? (int) $request->per_page : 10;
        $products = $query->latest()->paginate($perPage)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('master-data.product.index', compact('products', 'categories'));
    }
    public function show(Product $product) {
        $product->load(['transactionDetails.transaction']);
        $totalTerjual = $product->transactionDetails->sum('qty');
        $riwayat = $product->transactionDetails()
            ->with('transaction')
            ->latest()
            ->take(10)
            ->get();
        $topHari = $product->transactionDetails()
            ->selectRaw('DATE(created_at) as tanggal, SUM(qty) as total_qty, SUM(subtotal) as total_pendapatan')
            ->groupBy('tanggal')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();
        return view('master-data.product.show', compact('product', 'totalTerjual', 'riwayat', 'topHari'));
    }
    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
    public function update(UpdateProductRequest $request, Product $product) {
        $product->update($request->validated());
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }
    public function create() {
        $categories = Category::orderBy('name')->get();
        return view('master-data.product.create', compact('categories'));
    }
    public function store(StoreProductRequest $request) {
        Product::create($request->validated());
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }
    public function edit(Product $product) {
        $categories = Category::orderBy('name')->get();
        return view('master-data.product.edit', compact('product', 'categories'));
    }
}
