<!-- resources/views/admin/orders/show.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Chi tiết Đơn hàng #{{ $order->id }}</h1>

    <table class="table">
        <tr>
            <th>Tên người dùng</th>
            <td>{{ $order->user->name }}</td>
        </tr>
        <tr>
            <th>Tổng tiền</th>
            <td>{{ number_format($order->total, 2) }} VND</td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>{{ $order->status }}</td>
        </tr>
        <tr>
            <th>Phương thức thanh toán</th>
            <td>{{ $order->payment_method }}</td>
        </tr>
        <tr>
            <th>Ngày tạo</th>
            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <!-- Nút quay lại danh sách đơn hàng -->
    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Quay lại</a>

    <!-- Nút xóa đơn hàng -->
    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="mt-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Xóa đơn hàng</button>
    </form>
</div>
@endsection
