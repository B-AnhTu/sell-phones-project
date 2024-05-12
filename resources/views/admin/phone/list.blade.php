@extends('admin.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="text-center my-3">Quản lý điện thoại</h3>
            <div class="container">
                <div class="row">
                    <div class="col">
                    <form class="d-flex ms-auto my-3">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="search-btn btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    </div>
                </div>
            </div>
            <a href="{{ route('phones.addPhone') }}" class="btn btn-primary mb-3 float-end">Thêm điện thoại</a>
            <table class="table table-bordered table-primary">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên điện thoại <a href="{{ route('phones.sortByName') }}" class="btn btn-primary"><i class="fa-solid fa-sort"></i></a></th>
                        <th>Hình Ảnh</th>
                        <th>Số lượng <a href="{{ route('phones.sortByQuantity') }}" class="btn btn-primary"><i class="fa-solid fa-sort"></i></a></th>
                        <th>Giá tiền <a href="{{ route('phones.sortByPrice') }}" class="btn btn-primary"><i class="fa-solid fa-sort"></i></a></th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo <a href="{{ route('phones.sortByPurchaseDate') }}" class="btn btn-primary"><i class="fa-solid fa-sort"></i></a></th>
                        <th>Ngày cập nhật</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($phones as $phone)
                        <tr>
                            <td>{{ $phone->phone_id }}</td>
                            <td>{{ $phone->phone_name }}</td>
                            <td><img class="img-fluid table-img" src="{{ asset('images/' . $phone->phone_image) }}"></td>
                            <td>{{ $phone->quantities }}</td>
                            <td>{{ number_format($phone->price) }}</td>
                            <td>{{ $phone->status == 1 ? 'Còn hàng' : 'Hết hàng'}}</td>
                            <td>{{ $phone->created_at }}</td>
                            <td>{{ $phone->updated_at }}</td>
                            <td>
                                <a href="{{ route('phones.updatePhone', ['id' => $phone->phone_id]) }}"><i class="fa-solid fa-pen"></i></a> |
                                <a href="{{ route('phones.deletePhone', ['id' => $phone->phone_id]) }}"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col mt-3">
        <!-- Hiển thị thanh phân trang -->
        {{ $phones->links('pagination::bootstrap-5') }}
    </div>
@endsection