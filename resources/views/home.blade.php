@extends('dashboard')

@section('content')
<div class="container p-5 mt-3">
        <div class="row">
            @foreach($items as $item) 
            <div class="col-3 bg-gray">
                <div class="item text-center p-3 m-2">
                    <img class="img-fluid" src="public/images/iphonexmas.png" alt="">
                    <h5>Iphone Xmas</h5>
                    <p><span>8.999.000</span> đồng</p> 
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
@endsection