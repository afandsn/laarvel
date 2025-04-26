<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products; // pastikan relasi products sudah ada di model Category
        return view('category_show', compact('category', 'products'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        // Hapus semua produk dalam kategori ini
        $category->products()->delete();
        // Hapus kategori
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori dan semua produk di dalamnya berhasil dihapus.');
    }

  
        public function create()
        {
            return view('category_create');
        }
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    \App\Models\Category::create($validated);

    return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
}
    // Tambahkan method lain (create, store, edit, update) sesuai kebutuhan resource
}