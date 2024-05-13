@extends('admin.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h2 class="text-center">Thêm điện thoại</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('phones.postCreatePhone') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- Tên điện thoại -->
                        <div class="form-group mb-3">
                            <label for="phone_name">Tên điện thoại:</label>
                            <input type="text" id="phone_name" class="form-control" name="phone_name" required>
                        </div>

                        <!-- Ảnh điện thoại -->
                        <div class="form-group mb-3">
                            <label for="phone_image">Ảnh điện thoại:</label>
                            <input type="file" id="phone_image" class="form-control" name="phone_image">
                        </div>

                        <!-- Mô tả -->
                        <div class="form-group mb-3">
                            <label for="description">Mô tả:</label>
                            <textarea id="description" class="form-control" name="description" rows="3" required></textarea>
                        </div>

                        <!-- Số lượng -->
                        <div class="form-group mb-3">
                            <label for="quantities">Số lượng:</label>
                            <input type="number" id="quantities" class="form-control" name="quantities" required>
                        </div>

                        <!-- Giá -->
                        <div class="form-group mb-3">
                            <label for="price">Giá:</label>
                            <input type="text" id="price" class="form-control" name="price" required>
                        </div>

                        <!-- Trạng thái -->
                        <div class="form-group mb-3">
                            <label for="status">Trạng thái:</label>
                            <input type="number" id="status" class="form-control" name="status" disabled required>
                        </div>

                        <!-- Số lượt mua -->
                        <div class="form-group mb-3">
                            <label for="purchases">Số lượt mua:</label>
                            <input type="number" id="purchases" class="form-control" name="purchases" required>
                        </div>

                        <!-- Nhà sản xuất -->
                        <div class="form-group mb-3">
                            <label for="manu_id">Nhà sản xuất:</label>
                            <select id="manu_id" class="form-control" name="manu_id">
                                @foreach ($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->manufacturer_id }}">{{ $manufacturer->manufacturer_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Danh mục -->
                        <div class="form-group mb-3">
                            <label for="category_id">Danh mục:</label>
                            <select id="category_id" class="form-control" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection