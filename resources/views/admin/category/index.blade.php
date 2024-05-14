@extends('admin.dashboard')

@section('content')
    <div class="container">
        <h2>Danh sách danh mục</h2>
        <div class="mb-3">
            <a href="{{ route('categories.create')}}" class="btn btn-primary">Thêm mới danh mục</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->category_id }}</th>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            @if($category->category_id)
                                <a href="{{ route('categories.edit', ['id' => $category->category_id]) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen"></i> Sửa
                                </a>
                            @endif

                            <form action="{{ route('categories.destroy', ['id' => $category->category_id]) }}" method="POST" class="d-inline">
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
        {{ $categories->links('pagination::bootstrap-5') }} 

        <!-- Form để tạo danh mục mới -->
        
    </div>
@endsection
