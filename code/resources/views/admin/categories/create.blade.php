<!-- resources/views/categories/create.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Thêm Loại Rèm</h1>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên loại</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter category name">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection