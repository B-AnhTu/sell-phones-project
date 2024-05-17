@extends('admin.dashboard')

@section('content')
<div class="container">
        <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="col-6 col-xs-6 mx-auto">
                <div class="profile-update border p-3 mt-3">
                <h2 class="text-center mb-3">Sửa thông tin người dùng</h2>
                <form action="{{ route('admin.updateProfile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <!-- Tên người dùng -->
                    <div class="form-group mb-3">
                        <label for="user_fullname">Tên người dùng:</label>
                        <input type="text" id="user_fullname" class="form-control" name="user_fullname" value="{{ $user->user_fullname }}" required autofocus>
                        @if ($errors->has('user_fullname'))
                            <span class="text-danger">{{ $errors->first('user_fullname') }}</span>
                        @endif
                    </div>
                    <!-- Ngày sinh -->
                    <div class="form-group mb-3">
                        <label for="date_of_birth">Ngày sinh:</label>
                        <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" value="{{ $profile->date_of_birth }}" required autofocus>
                        @if ($errors->has('date_of_birth'))
                            <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                        @endif
                    </div>
                    <!-- Giới tính -->
                    <div class="form-group mb-3">
                        <label for="gender">Giới tính:</label><br>
                        <input type="radio" id="male" name="gender" value="Nam" required {{ old('gender') == 'Nam' ? 'checked' : '' }}>
                        <label for="male">Nam</label><br>
                        <input type="radio" id="female" name="gender" value="Nữ" required {{ old('gender') == 'Nữ' ? 'checked' : '' }}>
                        <label for="female">Nữ</label><br>
                        @if ($errors->has('gender'))
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        @endif
                    </div>

                    <!-- SĐT -->
                    <div class="form-group mb-3">
                        <label for="phone_number">SĐT:</label>
                        <input type="text" id="phone_number" class="form-control" name="phone_number" value="{{ $profile->phone_number }}" required autofocus>
                        @if ($errors->has('phone_number'))
                            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                        @endif
                    </div>
                    <!-- Địa chỉ -->
                    <div class="form-group mb-3">
                        <label for="address">Địa chỉ:</label>
                        <textarea id="address" class="form-control" name="address" rows="4">{{ $profile->address }}</textarea>
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