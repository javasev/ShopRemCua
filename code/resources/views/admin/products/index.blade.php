@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')
<style>
    .header {
        display: flex;
        align-items: center;
        margin-bottom: 20px; /* Khoảng cách giữa header và các thẻ card */
        margin-left: -150px; /* Điều chỉnh khoảng cách bên trái gần với sidebar */
    }
    
    .header img {
        width: 30px; /* Kích thước icon */
        height: 30px; /* Kích thước icon */
        margin-right: 10px; /* Khoảng cách giữa icon và tiêu đề */
    }

    .header h2 {
        font-size: 30px; /* Kích thước chữ tiêu đề */
        margin: 0; /* Bỏ margin để tiêu đề gần với icon hơn */
    }
</style>

<div class="container">
    <div class="header">
        
        <h2>Quản lý sản phẩm</h2>
    </div>
    <div class="mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Thêm Mới Sản Phẩm</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Miêu tả</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th>Hình ảnh</th>
                    <th>Hoạt động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ number_format($product->price) }} VNĐ</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">Xem</a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Cập nhật</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
