@extends('admin.dashboard')

@section('content')
<div class="container">
        <div class="row bg-grey">
            <div class="col text-center text-danger"><h1>Quản lý danh mục</h1></div>
        </div>
    </div>
    <div class="container bg-gray ">
        <div class="row my-4">
            <div class="col mt-3">
              <form action="" method="post">
                <label class="fw-bold" for="">Tên danh mục</label>
                <input type="text"><br><br>
                <a href="#" class="btnAction">Thêm</a>
                <a href="#" class="btnAction">Làm mới</a><br><br>
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
                  <th scope="col">Tên Danh Mục</th>                
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Điện Thoại</td>                
                  <td><a href="#" >Xóa</a>|<a href="">Sửa</a>
                  </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Máy Tính Bảng</td>                
                    <td><a href="#" >Xóa</a>|<a href="">Sửa</a>
                    </td>
                  </tr>
                <!-- Thêm các hàng khác nếu cần -->
              </tbody>
            </table>
          </div>
        </div>
      </div>   
@endsection


