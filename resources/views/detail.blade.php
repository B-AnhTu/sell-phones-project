@extends('dashboard')

@section('content')
<div class="container bg-gray p-5 mt-3">
    <div class="row">
        <div class="col-6">
            <div class="item text-center">
                <img class="img-fluid" src="{{asset('images/'.$phone->phone_image)}}" alt="">
                <h5>{{ $phone->phone_name}}</h5>
                <p><span>{{ $phone->price}}</span> đồng</p> 
                <a href="#" class="addcart">Đặt hàng</a>
            </div>  
        </div>
        <div class="col-6">
            <h5>Mô tả điện thoại</h5>
            <p>{{$phone->description}}</p>
            <p>Số lượng: {{$phone->quantities}}</p>
            <p>Lượt mua: <span>{{$phone->purchases}}</span></p>
            <p>Trạng thái: <span>
            @if($phone->status == 1)
                Còn hàng
            @else
                Hết hàng
            @endif
        </span></p>
        </div>
    </div>
</div>

@endsection