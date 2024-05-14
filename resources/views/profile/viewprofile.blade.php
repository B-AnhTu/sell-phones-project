@extends('header.dashboard')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-6 col-xs-6">
            <div class="profile p-3 rounded">
                <h2 class="text-center">Thông tin người dùng</h2>
                <img src="{{ asset($profile->image ?? 'images/demouser.jpg') }}" class="img-fluid d-block mx-auto my-3" alt="">
                <p class="fs-4">Tên người dùng: {{ $user->user_fullname }}</p>
                <p class="fs-4">Giới tính: {{ $profile->gender }}</p>
                <p class="fs-4">Ngày sinh: {{ $profile->date_of_birth }}</p>
                <p class="fs-4">SĐT: {{ $profile->phone_number }}</p>
                <p class="fs-4">Địa chỉ: {{ $profile->address }}</p>
                <div class="profile_action">
                    <div class="col text-center py-3">
                        <a href="{{ route('profile.edit') }}" class="btnAction">Cập nhật thông tin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection