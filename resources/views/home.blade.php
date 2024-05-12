@extends('header.dashboard')

@section('content')
<div class="container-fluid" style="text-align: center;">
        <h2>Dach sách sản phẩm</h2>
        <div class="result">
            <div class="row">
                @foreach($phones as $phone)
                <div class="col-md-3 my-4">
                    <div class="product border border-1 p-3">
                        <div class="product-image text-center">
                            <img class="img-fluid" src="{{ asset('images/' .$phone->phone_image) }}" alt="iPhone 15 Pro">
                        </div>
                        <div class="product-info">
                            <h3>{{$phone->phone_name}}</h3>
                            <p>Giá bán: {{$phone->price}}</p>
                            <a href="#" class="btn btn-primary">Xem chi tiết</a>
                            <a href="#" class="btn btn-light">Đặt hàng</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col mt-3">
        <!-- Hiển thị thanh phân trang -->
        {{ $phones->links('pagination::bootstrap-5') }}
    </div>

@endsection

