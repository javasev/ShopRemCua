<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WellcomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController; // Import thêm OrderController
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController; // Alias cho OrderController admin
use Illuminate\Support\Facades\Route;

/*
|------------------------------------------------------
| Web Routes
|------------------------------------------------------
| Đây là nơi bạn có thể đăng ký các route cho ứng dụng.
| Các route này sẽ được tải bởi RouteServiceProvider
| và được gán vào nhóm middleware "web".
*/

// Trang chào
Route::get('/', [ProductUserController::class, 'index'])->name('welcome');

// Đăng ký và đăng nhập người dùng
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route dành cho admin (sử dụng middleware để kiểm tra quyền)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Route quản lý sản phẩm
    Route::resource('/products', ProductController::class, [
        'as' => 'admin'
    ]);

    // Route quản lý danh mục
    Route::resource('/categories', CategoryController::class, [
        'as' => 'admin'
    ]);

    // Route quản lý đơn hàng
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::patch('/orders/{order}', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show'); // Route cho show
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy'); // Route cho destroy

    // Route quản lý báo cáo
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('admin/reports/income-data', [ReportController::class, 'getIncomeData'])->name('admin.reports.getIncomeData');
    Route::get('admin/reports/monthly-income-data', [ReportController::class, 'getMonthlyIncomeData'])->name('admin.reports.getMonthlyIncomeData');
    Route::get('admin/reports/yearly-income-data', [ReportController::class, 'getYearlyIncomeData'])->name('admin.reports.getYearlyIncomeData');

});

// Route cho tất cả người dùng (đã đăng nhập và chưa đăng nhập)
Route::get('/products', [ProductUserController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductUserController::class, 'show'])->name('products.show');

// Route cho giỏ hàng (người dùng chưa đăng nhập có thể thêm sản phẩm vào giỏ hàng)
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');

// Route dành cho người dùng đã đăng nhập để đặt hàng
Route::middleware(['auth'])->group(function () {
    // Các route đặt hàng
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
   
});

