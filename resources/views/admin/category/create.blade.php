@extends('admin.dashboard')

@section('content')
    <div class="container">
        <h2>Thêm danh mục mới</h2>
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="category_name" class="form-label">Tên danh mục</label>
                <input type="text" name="category_name" class="form-control" id="category_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm danh mục</button>
        </form>
    </div>
@endsection
