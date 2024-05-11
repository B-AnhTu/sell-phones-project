@extends('admin.dashboard')

@section('content')
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center my-3">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Hinh ảnh</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <th>{{ $user->id }}</th>
                                <th>{{ $user->user_fullname }}</th>
                                <th>{{ $user->email }}</th>
                                <th>{{ $user->phone }}</th>
                                <th><img class="img-list table-img" src="{{ asset('images/' . $user->avatar) }}" alt="User Image"></th>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
@endsection