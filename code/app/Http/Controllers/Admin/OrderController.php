<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders; // Import Order model
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index()
    {
        $orders = Orders::with('user')->get(); // Tải quan hệ người dùng
        return view('admin.orders.index', compact('orders'));
    }

    // Hiển thị thông tin chi tiết của đơn hàng
    public function show(Orders $order)
    {
        return view('admin.orders.show', compact('order')); // Hiển thị trang show với dữ liệu đơn hàng
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus(Request $request, Orders $order)
    {
        $order->update(['status' => $request->status]);
        return redirect()->route('admin.orders.index')->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

    // Xóa đơn hàng
    public function destroy(Orders $order)
    {
        $order->delete(); // Xóa đơn hàng
        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được xóa.');
    }
}
