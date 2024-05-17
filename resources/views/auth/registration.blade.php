@extends('dashboard')

@section('content')
    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Register User</h3>
                        <div class="card-body">
                            <!-- Form đăng kí -->
                            <form action="{{ route('user.postUser') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Tên đầy đủ -->
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Nhập tên người dùng" id="user_fullname" class="form-control" name="user_fullname"
                                           required autofocus>
                                    @if ($errors->has('user_fullname'))
                                        <span class="text-danger">{{ $errors->first('user_fullname') }}</span>
                                    @endif
                                </div>
                                <!-- Tên tài khoản -->
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Nhập username" id="username" class="form-control" name="username"
                                           required autofocus>
                                    @if ($errors->has('username'))
                                        <span class="text-danger">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                                <!-- Email -->
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email_address" class="form-control"
                                           name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <!-- Mật khẩu -->
                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control"
                                           name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <!-- Ảnh -->
                                <div class="form-group mb-3">
                                    <input type="file" id="image" class="form-control"
                                           name="image">
                                </div>
                                <!-- Nhớ tài khoản -->
                                <div class="form-group mb-3">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="remember"> Remember Me</label>
                                    </div>
                                </div>
                                <!-- Nút đăng kí -->
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection