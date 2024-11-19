@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-uppercase">{{ $product->name }}</h1>
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <!-- Hiển thị hình ảnh sản phẩm -->
                <div class="col-md-6">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="img-fluid rounded mb-3">
                    @else
                        <p class="text-muted">No Image Available</p>
                    @endif
                </div>

                <!-- Hiển thị thông tin sản phẩm -->
                <div class="col-md-6">
                    <h5 class="card-title mb-4">Thông tin chi tiết</h5>
                    <p><strong>Mô tả:</strong> {{ $product->description }}</p>
                    <p><strong>Số lượng:</strong> {{ number_format($product->quantity) }}</p>
                    <p><strong>Giá:</strong> {{ number_format($product->price, 0, '', '.') }} đ</p>
                    <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>

                    <!-- Kiểm tra xem người dùng đã đăng nhập hay chưa -->
                    @auth
                    <!-- Form để thêm sản phẩm vào giỏ hàng -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                    </form>
                    @else
                    <p>Để đặt hàng, bạn cần <a href="{{ route('login') }}">đăng nhập</a> hoặc <a href="{{ route('register') }}">đăng ký</a>.</p>
                    @endauth

                    <!-- Nút quay lại danh sách sản phẩm -->
                    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-2">Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
