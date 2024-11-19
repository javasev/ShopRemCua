<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductUserController extends Controller
{
    public function index()
    {
        // Lấy tất cả sản phẩm và hiển thị cùng với danh mục của chúng
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }
   
    public function show(Product $product)
    {
        // Kiểm tra xem sản phẩm có tồn tại không và trả về view
        return view('products.show', compact('product'));
    }    

    /**
     * Hiển thị form chỉnh sửa sản phẩm.
     */
    public function edit(Product $product)
    {
        // Lấy sản phẩm và danh mục để chỉnh sửa
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }
}
