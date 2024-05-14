@extends('admin.dashboard')

@section('content')
<main class="login-form">
    <h3 class="text-center mt-3">Quản lý người dùng</h3>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col">
                <form class="d-flex ms-auto">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="search-btn btn btn-outline-success" type="submit"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center my-3">
            <div class="col p-2 my-3">
                <a class="btnAction" href="{{ route('user.sort', ['direction' => 'asc']) }}">Ascending</a>
                <a class="btnAction" href="{{ route('user.sort', ['direction' => 'desc']) }}">Descending</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Loại tài khoản</th>
                        <th>Hinh ảnh</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <th>{{ $user->user_fullname }}</th>
                            <th>{{ $user->email }}</th>
                            <th>{{ $user->user_type == 1 ? 'Admin' : 'Người dùng' }}</th>
                            <th><img class="img-list table-img" src="{{ asset('images/' . $user->avatar) }}"
                                    alt="User Image"></th>
                            <th>
                                <a href="{{ route('user.readUser', ['id' => $user->id]) }}"><i
                                        class="fa-solid fa-eye"></i></a> |
                                <a href="{{ route('user.updateUser', ['id' => $user->id]) }}"><i
                                        class="fa-solid fa-pen"></i></a> |
                                <a onclick="return confirmDelete();"
                                    href="{{ route('user.deleteUser', ['id' => $user->id]) }}"><i
                                        class="fa-solid fa-trash"></i></a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col mt-3">
                <!-- Hiển thị thanh phân trang -->
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</main>
@endsection