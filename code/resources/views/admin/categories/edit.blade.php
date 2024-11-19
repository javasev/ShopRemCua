@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4 text-uppercase">Sửa loại</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Tên loại mới</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" required>
                    </div>
                    <div class="form-group text-right mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
