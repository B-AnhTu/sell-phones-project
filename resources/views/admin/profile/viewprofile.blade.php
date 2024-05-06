@extends('header.dashboard')

@section('content')

<!-- Các thẻ thuộc tính khác để đây -->
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6 col-xs-6">
                <div class="profile p-3">
                    <h2 class="text-center">Thông tin người dùng</h2>
                    <img src="{{asset('images/'.)}}" class="img-fluid d-block mx-auto my-3" alt="">
                    <p class="fs-4">Tên người dùng: <span class="profile-info">Nguyễn Văn A</span></p>
                    <p class="fs-4">Giới tính: <span class="profile-info">27/03/1994</span></p>
                    <p class="fs-4">Sở thích: <span class="profile-info">Nguyễn Văn A</span></p>
                    <p class="fs-4">Địa chỉ: <span class="profile-info">xxx</span></p>
                    <div class="profile_action">
                        <div class="col text-center py-3">
                            <a href="#" class="btnAction">Cập nhật thông tin</a>
                            <a href="#" class="btnAction">Lịch sử mua</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Kết thúc thẻ -->

@endsection