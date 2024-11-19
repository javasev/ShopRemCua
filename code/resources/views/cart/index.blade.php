@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Giỏ hàng của bạn</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th> 
                    <th>Danh mục</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                
                @foreach ($cart as $id => $details)
                    @php $total += $details['price'] * $details['quantity']; @endphp
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>
                            <img src="{{ asset('storage/' . ($details['image'] ?? 'images/default.png')) }}" alt="{{ $details['name'] }}" style="width: 100px;">
                        </td>
                        <td>{{ $details['category'] }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control" style="width: 80px; display: inline;">
                                <button type="submit" class="btn btn-sm btn-secondary">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($details['price'], 0 , '', '.') }} đ</td>
                        <td>{{ number_format($details['price'] * $details['quantity'], 0) }} VND</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm khỏi giỏ hàng?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right">
        <h3>Tổng tiền: {{ number_format($total, 0, '', '.') }} đ</h3>
        </div>

        <!-- Form đặt hàng với khoảng cách hợp lý -->
        <div class="card mt-4">
            <div class="card-header">
                <h5>Thông tin đặt hàng</h5>
            </div>
            <div class="card-body">
            @if(auth()->check())
                    <form action="{{ route('orders.store') }}" method="POST"> 
                        @csrf 
                        <input type="hidden" name="total" value="{{ $total }}"> 
                        
                        <div class="form-group mb-3"> 
                            <label for="payment_method">Phương thức thanh toán:</label> 
                            <select name="payment_method" id="payment_method" class="form-control"> 
                                <option value="COD">Thanh toán khi nhận hàng (COD)</option> 
                                <option value="online">Thanh toán trực tuyến</option> 
                            </select> 
                        </div> 

                        <button type="submit" class="btn btn-success btn-block mt-2">Đặt hàng</button> 
                    </form> 
                @else
                    <p>Để đặt hàng, bạn cần <a href="{{ route('login') }}">đăng nhập</a> hoặc <a href="{{ route('register') }}">đăng ký</a>.</p>
                @endif
            </div>
        </div>
    @else
        <p>Giỏ hàng của bạn trống.</p>
    @endif 

    <a href="{{ route('products.index') }}" class="btn btn-primary mt-2">Tiếp tục mua sắm</a>
</div>

@endsection
