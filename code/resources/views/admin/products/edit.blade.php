@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4 text-uppercase">Sửa Sản Phẩm</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $product->quantity }}" min="0" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Price:</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" step="0.01" min="0" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="category">Category:</label>
                        <select name="category_id" id="category" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Hiển thị ảnh hiện tại nếu có -->
                    @if($product->image)
                        <div class="form-group mb-3">
                            <label>Current Image:</label>
                            <div>
                                <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="img-fluid" style="max-width: 100px;">
                            </div>
                        </div>
                    @endif
                    <!-- Trường tải lên ảnh -->
                    <div class="form-group mb-3">
                        <label for="image">Product Image:</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group text-center mt-4">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
