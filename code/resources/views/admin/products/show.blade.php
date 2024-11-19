@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4 text-uppercase">Chi tiết sản phẩm</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="img-fluid rounded">
                        @else
                            <p class="text-muted">No Image Available</p>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title mb-4">Thông tin sản phẩm</h5>
                        <p><strong>ID:</strong> {{ $product->id }}</p>
                        <p><strong>Name:</strong> {{ $product->name }}</p>
                        <p><strong>Description:</strong> {{ $product->description }}</p>
                        <p><strong>Quantity:</strong> {{ number_format($product->quantity) }}</p>
                        <p><strong>Price:</strong> {{ number_format($product->price ) }} VNĐ</p>
                        <p><strong>Category:</strong> {{ $product->category->name }}</p>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
