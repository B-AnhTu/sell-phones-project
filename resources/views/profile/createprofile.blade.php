@extends('header.dashboard')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-6 col-xs-6 mx-auto">
                <div class="profile-update border p-3 mt-3">
                <h2 class="text-center">Thêm thông tin người dùng</h2>

                <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <!-- Tên người dng -->
                    <div class="form-group mb-3">
                        <label for="user_fullname">Tên đầy đủ:</label>
                        <input type="text" id="user_fullname" class="form-control" name="user_fullname" required autofocus>
                        @if ($errors->has('user_fullname'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <!-- Ngày sinh -->
                    <div class="form-group mb-3">
                        <label for="date_of_birth">Ngày sinh:</label>
                        <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" required autofocus>
                        @if ($errors->has('date_of_birth'))
                            <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                        @endif
                    </div>
                    <!-- Giới tính -->
                    <div class="form-group mb-3">
                        <label for="gender">Giới tính:</label><br>
                        <input type="radio" id="male" name="gender" value="male" required>
                        <label for="male">Nam</label><br>
                        <input type="radio" id="female" name="gender" value="female" required>
                        <label for="female">Nữ</label><br>
                        @if ($errors->has('gender'))
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        @endif
                    </div>
                    <!-- Địa chỉ -->
                    <div class="form-group mb-3">
                        <label for="address">Địa chỉ:</label>
                        <textarea id="address" class="form-control" name="address" placeholder="Nhập địa chỉ của bạn" required autofocus rows="4"></textarea>
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <!-- Ảnh -->
                    <div class="form-group mb-3">
                        <label for="image">Ảnh:</label>
                        <input type="file" id="image" class="form-control" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
      </div>

@endsection