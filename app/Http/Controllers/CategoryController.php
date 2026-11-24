<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    public function show(Category $category) {
        $category->load('products');
        $totalStok = $category->products->sum('stock');
        return view('master-data.category.show', compact('category', 'totalStok'));
    }
    public function edit(Category $category) {
        return view('master-data.category.edit', compact('category'));
    }
    public function update(Request $request, Category $category) {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:255',
        ]);
        $category->update($validated);
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }
    public function destroy(Category $category) {
        // Validasi Latihan 2: Cek apakah kategori masih memiliki produk
        if ($category->products()->exists()) {
            return redirect()->route('categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk terkait.');
        }
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
    public function index() {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('master-data.category.index', compact('categories'));
    }
    public function create() { return view('master-data.category.create'); }
    public function store(StoreCategoryRequest $request) {
        Category::create($request->validated());
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }
}
