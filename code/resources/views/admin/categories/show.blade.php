<!-- resources/views/categories/show.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4 text-uppercase">Chi tiết loại</h1>
        <div class="card">
        <div class="card-body">
        <h5 class="card-title mb-3">Thông tin loại</h5>
        <p><strong>ID:</strong> {{ $category->id }}</p>
        <p><strong>Name:</strong> {{ $category->name }}</p>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to List</a>
        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection