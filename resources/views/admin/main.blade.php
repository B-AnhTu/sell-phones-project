<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Trang chu</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>

</head>
<body>
    <header>
        <div class="container me-auto">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" src="{{asset('images/logo.png')}}" alt="">
                </div>
            </div>
        </div>
        <!-- Thanh navbar -->
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-bars fs-3"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <li><a class="dropdown-item" href="#">Trang chủ</a></li>
                                      <li><a class="dropdown-item" href="#">Danh mục</a></li>
                                      <li><a class="dropdown-item" href="#">Hãng điện thoại</a></li>

                                      <li><hr class="dropdown-divider"></li>
                                      @guest
                                      <li><a class="dropdown-item" href="{{route('login')}}">Đăng nhập</a></li>
                                      <li><a class="dropdown-item" href="{{route('user.createUser')}}">Đăng ký</a></li>
                                      @else
                                      <li><a class="dropdown-item" href="{{route('signout')}}">Đăng xuất</a></li>
                                      @endguest
                                    </ul>
                                  </li>
                            </ul>
                          </div>
                          <form class="d-flex ms-auto">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="search-btn btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                          </form>
                          <div class="navbar-action">
                            <a class="navbar-icon" href="#"><i class="fa-solid fa-user mx-2"></i>Admin</a>
                          </div>
                        </div>
                      </nav>
                </div>
            </div>
        </div>
    </header>
    <footer>
        <div class="container bg-gray mt-3">
            <div class="row">
                <div class="col">
                    <p>53 Đ. Võ Văn Ngân, Linh Chiểu, Thành Phố
                        Thủ Đức, Thành phố Hồ Chí Minh</p>
                    <p>Copyright © 2024 TDC - All Rights Reserved</p>
                    <p>Liên hệ: 1800 34509</p>
                    <p>Email: ipro@gmail.com</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/8d630c67fe.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>