@extends('layouts.admin')

@section('content')

@section('title', 'Quản lý sản phẩm')

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
        
        <h2>Quản lý Danh Mục</h2>
    </div>

    <div class="container">
        <div class="mb-3">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Thêm Mới Danh Mục</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên Danh Mục</th>
                        <th>Hoạt Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info btn-sm">Xem</a>
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Cập Nhật</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có thực sự muốn xóa?');">Xoá</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
