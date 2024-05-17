@extends('admin.dashboard')

@section('content')
<div class="container">
    <div class="row bg-grey">
        <div class="col text-center text-danger">
            <h1>Sửa thông tin hãng</h1>
        </div>
    </div>
</div>
<div class="container bg-gray ">
    <div class="row my-4">
        <div class="col mt-3">
            <form action="{{ route('manufacturer.update', ['id' => $manufacturer->manu_id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="fw-bold" for="manufacturer_id">ID</label>
                    <input type="text" class="form-control" id="manufacturer_id" value="{{ $manufacturer->manu_id }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="fw-bold" for="manufacturer_name">Tên hãng</label>
                    <input type="text" class="form-control" id="manufacturer_name" name="manufacturer_name" value="{{ $manufacturer->manufacturer_name }}">
                    @if ($errors->has('manufacturer_name'))
                        <span class="text-danger">{{ $errors->first('manufacturer_name') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Sửa</button>
            </form>
        </div>
    </div>
</div>
@endsection
