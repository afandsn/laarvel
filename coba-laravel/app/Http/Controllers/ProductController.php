<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductUserClick;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        return view('product', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('product_create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required',
            'new_category' => 'nullable|string|max:255',
        ]);

        if ($request->category_id === 'other') {
            if ($request->filled('new_category')) {
                $category = Category::create(['name' => $request->new_category]);
                $validated['category_id'] = $category->id;
            } else {
                return back()->withErrors(['new_category' => 'Kategori baru harus diisi jika memilih Lainnya...'])->withInput();
            }
        }

        unset($validated['new_category']);
        $validated['category_id'] = (int) $validated['category_id'];

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        if (auth()->check()) {
            $click = ProductUserClick::where('user_id', auth()->id())
                ->where('product_id', $id)
                ->first();

            if ($click) {
                $click->click_count += 1;
                $click->save();
            } else {
                ProductUserClick::create([
                    'user_id' => auth()->id(),
                    'product_id' => $id,
                    'click_count' => 1,
                ]);
            }
        }

        return view('product_detail', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('product_edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('product.show', $product->id)
            ->with('success', 'Produk berhasil diperbarui!');
    }
}