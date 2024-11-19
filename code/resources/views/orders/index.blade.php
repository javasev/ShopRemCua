@extends('layouts.app')

@section('content')
<h1>Đơn hàng của bạn</h1>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(count($orders) > 0)
<table class="table">
    <thead>
        <tr>
            
            <th>Mã đơn hàng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Phương thức thanh toán</th>
            <th>Ngày tạo</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ number_format($order->total, 0, '', '.') }} đ</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>{{ $order->payment_method }}</td>
            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td> <!-- Định dạng ngày tháng -->
           
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Quay lại trang chủ</a>

@else
<p>Bạn chưa có đơn hàng nào.</p>
@endif

@endsection
