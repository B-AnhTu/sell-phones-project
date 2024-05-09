@extends('header.dashboard')

@section('content')
<div class="container p-5 mt-3">
        <div class="row">
            @foreach($phones as $phone) 
            <div class="col-3 bg-gray">
                <div class="item text-center p-3 m-2">
                    <img class="img-fluid" src="{{asset('images/'. $phone->phone_image)}}" alt="">
                    <h5>{{ $phone->phone_name }}</h5>
                    <p><span>{{ $phone->price}}</span> đồng</p> 
                    <div class="row">
                        <div class="col">     
                            <a href="#" class="addcart">Xem chi tiết</a>
                        </div>
                        <div class="col">
                            <a href="#" class="addcart">Đặt hàng</a>
                        </div>
                    </div>
                </div>  
            </div>
            @endforeach
        </div>
    </div>
<div class="col mt-3">
    <!-- Hiển thị thanh phân trang -->
    {{ $phones->links('pagination::bootstrap-4') }}
</div>
@endsection