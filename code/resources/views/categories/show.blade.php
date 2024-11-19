<!-- resources/views/categories/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-uppercase">Category Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Categories Information</h5>
            <p><strong>ID:</strong> {{ $category->id }}</p>
            <p><strong>Name:</strong> {{ $category->name }}</p>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection