<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Trang chu</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>

</head>
<body>
    <header>
        <div class="container me-auto">
            <div class="row">
                <div class="col">
                    <img class="img-fluid logo" src="{{asset('images/logo.png')}}" alt="">
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
                                      <li><a class="dropdown-item" href="{{route('home')}}">Trang chủ</a></li>

                                      <li><hr class="dropdown-divider"></li>
                                      @guest
                                      <li><a class="dropdown-item" href="{{route('login')}}">Đăng nhập</a></li>
                                      <li><a class="dropdown-item" href="{{route('user.createUser')}}">Đăng ký</a></li>
                                      @endguest
                                      @auth
                                      <li><a class="dropdown-item" href="{{route('signout')}}">Đăng xuất</a></li>
                                      @endauth
                                    </ul>
                                  </li>
                            </ul>
                          </div>

                        </div>
                      </nav>
                </div>
            </div>
            
        </div>
    </header>
    @yield('content')
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
    <script src="{{ asset('js/scripts.js')}}"></script>
    <script src="https://kit.fontawesome.com/8d630c67fe.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>

