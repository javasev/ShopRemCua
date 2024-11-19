<?php

namespace App\Http\Controllers;

use App\Models\Cart; // Đảm bảo import đúng mô hình Cart
use App\Models\Orders;
use App\Models\OrderItem;
use App\Models\Payment; // Import model Payment
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng của người dùng
    public function index()
    {
        $orders = Orders::where('user_id', Auth::id())->get();
        return view('orders.index', compact('orders'));
    }

    // Xử lý việc tạo đơn hàng
    public function store(Request $request)
    {
        // Lấy giỏ hàng từ cơ sở dữ liệu
        $cartItems = Cart::getItemsByUser(Auth::id());

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn trống.');
        }

        // Tính tổng tiền từ giỏ hàng
        $total = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        // Tạo đơn hàng mới
        $order = Orders::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'processing',
            'payment_method' => $request->payment_method,
        ]);

        // Lưu các mặt hàng trong đơn hàng
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Tạo bản ghi thanh toán
        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => $order->payment_method, // Sửa lỗi bỏ sót dấu nháy đơn
        ]);

        // Xóa các mặt hàng trong giỏ hàng
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.index')->with('success', 'Đặt hàng thành công!');
    }
}
