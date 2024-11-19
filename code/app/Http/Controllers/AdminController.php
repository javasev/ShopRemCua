<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Category; // Nhập model Category
use App\Models\Orders; // Nhập model Order

class AdminController extends Controller
{
    public function index()
    {
        // Lấy số lượng sản phẩm, danh mục và đơn hàng
        $productCount = Product::count();
        $categoryCount = Category::count();
        $orderCount = Orders::count();

        // Truyền dữ liệu vào view
        return view('admin.dashboard', compact('productCount', 'categoryCount', 'orderCount'));
    }

    public function dashboard()
    {
        // Lấy tất cả sản phẩm và hiển thị cùng với danh mục của chúng
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function products()
    {
        return app(ProductController::class)->index();
    }

    public function categories()
    {
        return app(CategoryController::class)->index();
    }
}
