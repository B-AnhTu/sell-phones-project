@extends('dashboard')

@section('content')
<main>
    <section class="register-form container py-5">

        <div style="text-align: center;">
            <h2>Đăng ký premium</h2>
        </div>
        <form action="{{ route('')}}" method="post" class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Họ và tên:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Mật khẩu:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="confirmPassword" class="form-label">Nhập lại mật khẩu:</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="address" class="form-label">Địa chỉ:</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Số điện thoại:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="hobbies" class="form-label">Sở thích:</label>
                <input type="text" class="form-control" id="hobbies" name="hobbies" required>
            </div>
            <div class="col-12 mt-3" style="text-align: center;">
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </div>
        </form>

    </section>
</main>


@endsection