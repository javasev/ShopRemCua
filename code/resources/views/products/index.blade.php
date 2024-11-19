@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($products->unique('id') as $product)
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm border-light" style="border-radius: 15px;">
                        <a href="{{ route('products.show', $product->id) }}" class="card-img-link">
                            <img src="{{ $product->image ? Storage::url($product->image) : asset('storage/images/default.png') }}" 
                                 alt="Hình Ảnh Sản Phẩm" 
                                 class="card-img-top" 
                                 style="height: 250px; object-fit: cover;">
                            <div class="overlay">
                                <span class="view-text">Xem sản phẩm</span>
                            </div>
                        </a>
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 1.1rem;">{{ $product->name }}</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-text text-success">{{ number_format($product->price, 0, '', '.') }} đ</p>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">                                    @csrf
                                    <button type="submit" class="btn btn-light btn-sm">
                                        <img src="{{ asset('storage/images/giohang.png') }}" alt="Thêm vào Giỏ" style="width: 30px; height:35px;">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            background-color: #fff;
        }

        .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .card-img-link {
            position: relative;
            border-radius: 15px 15px 0 0;
        }

        .overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 0, 0, 0.8);
            border-radius: 25px;
            padding: 10px 20px;
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .card-img-link:hover .overlay {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .view-text {
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
        }

        .btn-light {
            background-color: #ffffff;
            border: 1px solid #ddd;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        .btn-light:hover {
            background-color: #f8f9fa;
        }

        .text-success {
            font-size: 1.5rem; /* Kích thước chữ cho giá sản phẩm */
            font-weight: 600;
            color: #D0021B !important; /* Đổi màu thành đỏ */
        }
    </style>
@endsection
