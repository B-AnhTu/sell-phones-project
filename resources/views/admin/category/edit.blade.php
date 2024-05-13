@extends('admin.dashboard')

@section('content')
    <div class="container">
        <h2>Chỉnh sửa danh mục</h2>
        <form method="POST" action="{{ route('categories.update', ['id' => $category->category_id]) }}">
            @csrf
            @method('PUT') <!-- Thêm phương thức PUT để Laravel hiểu rằng bạn đang gửi yêu cầu cập nhật -->
            <div class="form-group mb-3">
                <label for="category_name" class="form-label">Tên danh mục</label>
                <input type="text" name="category_name" class="form-control" id="category_name" value="{{ $category->category_name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </form>
    </div>
@endsection
