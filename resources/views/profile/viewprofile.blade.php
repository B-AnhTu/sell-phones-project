@extends('header.dashboard')

@section('content')

<!-- Các thẻ thuộc tính khác để đây -->
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6 col-xs-6">
                <div class="profile p-3">
                    <h2 class="text-center">Thông tin người dùng</h2>
                    <img src="public/images/demouser.jpg" class="img-fluid d-block mx-auto my-3" alt="">
                    <p class="fs-4">Tên tài khoản: Nguyễn Văn A</p>
                    <p class="fs-4">Ngày sinh: 27/03/1994</p>
                    <p class="fs-4">Ngày tạo tài khoản: Nguyễn Văn A</p>
                    <p class="fs-4">Giới tính: Nam</p>
                    <p class="fs-4">Địa chỉ: </p>
                    <div class="profile_action">
                        <div class="col text-center py-3">
                            <a href="#" class="btnAction">Cập nhật thông tin</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Kết thúc thẻ -->

@endsection