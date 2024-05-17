@extends('dashboard')

@section('content')
<section class="register-form container py-5">
    <div style="text-align: center;">
        <h2>Đăng ký premium</h2>
    </div>
    {!! Form::open(['action' => 'Auth\RegisterController@register', 'method' => 'POST', 'class' => 'row']) !!}
    <div class="col-md-6 mb-3">
        {{ Form::label('name', 'Họ và tên:', ['class' => 'form-label']) }}
        {{ Form::text('name', old('name'), ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-6 mb-3">
        {{ Form::label('email', 'Email:', ['class' => 'form-label']) }}
        {{ Form::email('email', old('email'), ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-6 mb-3">
        {{ Form::label('password', 'Mật khẩu:', ['class' => 'form-label']) }}
        {{ Form::password('password', ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-6 mb-3">
        {{ Form::label('password_confirmation', 'Nhập lại mật khẩu:', ['class' => 'form-label']) }}
        {{ Form::password('password_confirmation', ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-12 mb-3">
        {{ Form::label('address', 'Địa chỉ:', ['class' => 'form-label']) }}
        {{ Form::textarea('address', old('address'), ['class' => 'form-control', 'rows' => 3, 'required']) }}
    </div>
    <div class="col-md-6 mb-3">
        {{ Form::label('phone', 'Số điện thoại:', ['class' => 'form-label']) }}
        {{ Form::tel('phone', old('phone'), ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-6 mb-3">
        {{ Form::label('hobbies', 'Sở thích:', ['class' => 'form-label']) }}
        {{ Form::text('hobbies', old('hobbies'), ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-12 mt-3" style="text-align: center;">
        {{ Form::submit('Đăng ký', ['class' => 'btn btn-primary']) }}
    </div>
    {!! Form::close() !!}
</section>
@endsection
