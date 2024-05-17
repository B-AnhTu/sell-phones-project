@extends('admin.dashboard')

@section('content')
<div class="container">
    <div class="row bg-grey">
        <div class="col text-center text-danger"><h1>Quản lý hãng</h1></div>
    </div>
</div>
<div class="container bg-gray">
    <div class="row my-4">
        <div class="col mt-3">
            <form action="{{ route('manufacturer.store') }}" method="post">
                @csrf <!-- Bổ sung CSRF token -->
                <label class="fw-bold" for="manufacturer_name">Thêm hãng</label>
                <input type="text" name="manufacturer_name" id="manufacturer_name"><br><br>
                @if ($errors->has('manufacturer_name'))
                    <span class="text-danger">{{ $errors->first('manufacturer_name') }}</span>
                @endif
                <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="row py-3">
        <div class="col">
            <table class="table table-bordered bg-light">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên Hãng</th> 
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- @foreach ($manufacturers as $manufacturer)
                        <tr>
                            <th scope="row">{{ $manufacturer->manu_id }}</th>
                            <td>{{ $manufacturer->manufacturer_name }}</td>
                            <td>
                                <a href="{{ route('manufacturer.edit', ['id' => $manufacturer->manu_id]) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen"></i> Sửa
                                </a>
                                <form action="{{ route('manufacturer.destroy', ['id' => $manufacturer->manu_id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc là muốn xóa?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach  -->
                    @foreach ($manufacturers as $manufacturer)
    <tr>
        <th scope="row">{{ $manufacturer->manu_id }}</th>
        <td>{{ $manufacturer->manufacturer_name }}</td>
        <td>
            <a href="{{ route('manufacturer.edit', ['id' => $manufacturer->manu_id]) }}" class="btn btn-sm btn-warning">
                <i class="fa-solid fa-pen"></i> Sửa
            </a>
            <form action="{{ route('manufacturer.destroy', ['id' => $manufacturer->manu_id]) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc là muốn xóa?')">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
@endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
