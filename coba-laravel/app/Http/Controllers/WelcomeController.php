<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductUserClick;

class WelcomeController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();

        $userId = auth()->id();
        $totalClicks = 0;
        $clicksPerCategory = collect();

        if ($userId) {
            // Total klik semua produk oleh user ini
            $totalClicks = ProductUserClick::where('user_id', $userId)->sum('click_count');

            // Klik per kategori dan produk
            $categories = Category::with(['products'])->get();
            $clicksPerCategory = $categories->map(function($category) use ($userId) {
                $products = $category->products->map(function($product) use ($userId) {
                    $click = ProductUserClick::where('user_id', $userId)
                        ->where('product_id', $product->id)
                        ->first();
                    $product->click_count = $click ? $click->click_count : 0;
                    return $product;
                });
                $category->products = $products;
                return $category;
            });
        }

        return view('welcome', compact('productCount', 'categoryCount', 'totalClicks', 'clicksPerCategory'));
    }
}