<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    public function __construct()
    {
        View::composer('*', function ($view) {
            $view->with('cartCount', $this->getCartCount());
        });
    }

    private function getCartCount()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->count(); // Đếm số sản phẩm khác nhau
        } else {
            $cart = session()->get('cart', []);
            return count($cart); // Đếm số sản phẩm khác nhau trong session cart
        }
    }

    public function index()
    {
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->get();
            $cart = [];

            foreach ($cartItems as $item) {
                $cart[$item->product_id] = [
                    'name' => $item->product_name,
                    'image' => $item->image,
                    'category' => $item->category,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ];
            }
        } else {
            $cart = session()->get('cart', []);
        }

        // Lấy số lượng sản phẩm trong giỏ hàng
        $cartCount = $this->getCartCount();

        return view('cart.index', compact('cart', 'cartCount'));
    }

    public function add(Request $request, Product $product)
    {
        try {
            $user = auth()->user();
            if (Auth::check()) {
                $existingCartItem = Cart::where('user_id', $user->id)
                    ->where('product_id', $product->id)
                    ->first();
                if ($existingCartItem) {
                    $existingCartItem->quantity += 1;
                    $existingCartItem->save();
                } else {
                    try {
                        Cart::create([
                            'user_id' => $user->id,
                            'product_id' => $product->id,
                            'product_name' => $product->name,
                            'quantity' => 1,
                            'price' => $product->price,
                            'image' => $product->image,
                           'category' => $product->category ? $product->category->name : null,
                        ]);
                    } catch (\Exception $e) {
                        dd($e->getMessage());
                    }
                }
            } else {
                // Xử lý cho người dùng không đăng nhập
                $cart = session()->get('cart', []);

                if (isset($cart[$product->id])) {
                    $cart[$product->id]['quantity']++;
                } else {
                    $cart[$product->id] = [
                        'name' => $product->name,
                        'image' => $product->image,
                        'category' => $product->category->name,
                        'quantity' => 1,
                        'price' => $product->price,
                    ];
                }

                session()->put('cart', $cart);
            }

            return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }


    public function update(Request $request, $id)
    {
        if ($request->has('quantity') && $request->quantity > 0) {
            if (Auth::check()) {
                $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

                if ($cartItem) {
                    $cartItem->quantity = $request->quantity;
                    $cartItem->save();
                    return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được cập nhật!');
                }
            } else {
                $cart = session()->get('cart');

                if (isset($cart[$id])) {
                    $cart[$id]['quantity'] = $request->quantity;
                    session()->put('cart', $cart);
                    return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được cập nhật!');
                }
            }
        }

        return redirect()->route('cart.index')->with('error', 'Cập nhật thất bại! Vui lòng thử lại.');
    }

    public function remove(Product $product)
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->where('product_id', $product->id)->delete();
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                unset($cart[$product->id]);
                session()->put('cart', $cart);
            }
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xoá khỏi giỏ hàng.');
    }
}
