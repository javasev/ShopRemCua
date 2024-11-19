@extends('layouts.admin')

@section('content')

@section('title', 'Quản lý đơn hàng')

<style>
    .header {
        display: flex;
        align-items: center;
        margin-bottom: 20px; /* Khoảng cách giữa header và các thẻ card */
        margin-left: -150px; /* Điều chỉnh khoảng cách bên trái gần với sidebar */
    }
    
    .header img {
        width: 33px; /* Kích thước icon */
        height: 33px; /* Kích thước icon */
        margin-right: 10px; /* Khoảng cách giữa icon và tiêu đề */
    }

    .header h2 {
        font-size: 30px; /* Kích thước chữ tiêu đề */
        margin: 0; /* Bỏ margin để tiêu đề gần với icon hơn */
    }
</style>

<div class="container">
    <div class="header">
        <img src="{{ asset('storage/images/DH4.png') }}" alt="Quản lý đơn hàng Icon">
        <h2>/Quản Lý Đơn Hàng</h2>
    </div>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên người dùng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Phương thức thanh toán</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ number_format($order->total, 2) }} VND</td>
                        <td>
                            <!-- Form cập nhật trạng thái đơn hàng -->
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="custom-select" onchange="this.form.submit()">
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                            </form>
                        </td>
                        <td>{{ $order->payment_method }}</td>
                        <td class="text-center">
                            <!-- Xem chi tiết đơn hàng -->
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">Chi tiết</a>
                            
                            <!-- Xóa đơn hàng -->
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
