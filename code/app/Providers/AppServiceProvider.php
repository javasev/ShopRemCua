<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Nếu bạn có hệ thống người dùng, hãy sử dụng Auth::id() để lấy giỏ hàng theo từng người dùng
            $cartCount = 0;

            if (auth()->check()) {
                // Lấy số lượng sản phẩm trong giỏ của người dùng đăng nhập
                $cartCount = Cart::where('user_id', auth()->id())->count();
            } else {
                // Nếu không có người dùng đăng nhập, sử dụng session để quản lý giỏ hàng tạm thời
                $cartCount = Session::get('cartCount', 0); // Mặc định là 0 nếu không có trong session
            }

            $view->with('cartCount', $cartCount);
        });
    }
}
