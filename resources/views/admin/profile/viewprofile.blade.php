@extends('admin.dashboard')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-6 col-xs-6">
            <div class="profile p-3 rounded">
                <h2 class="text-center">Thông tin người dng</h2>
                <img src="{{ asset("images/" . ($profile->image ?? 'demouser.jpg')) }}"
                    class="img-fluid d-block mx-auto my-3 profile-img" alt="">
                <p class="fs-4">Tên người dùng: {{ $user->user_fullname }}</p>
                <p class="fs-4">Giới tính: {{ $profile->gender }}</p>
                <p class="fs-4">Ngày sinh: {{ $profile->date_of_birth }}</p>
                <p class="fs-4">SĐT: {{ $profile->phone_number }}</p>
                <p class="fs-4">Địa chỉ: {{ $profile->address }}</p>
                <div class="profile_action">
                    <div class="col text-center py-3">
                    @if (!$profile->exists)
                            <a href="{{ route('admin.createProfile') }}" class="btnAction">Tạo thông tin</a>
                        @else
                            <a href="{{ route('admin.editProfile') }}" class="btnAction">Cập nhật thông tin</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection