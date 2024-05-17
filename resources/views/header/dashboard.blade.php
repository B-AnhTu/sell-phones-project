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

    <style>
        .chat {
            position: fixed;
            bottom: 20px;
            right: 10px;
            z-index: 1000;
        }
        .chat a {
            font-size: 60px; 
        }
    </style>
</head>
<body>
    <header>
        <div class="container me-auto">
            <div class="row">
                <div class="col">
                    <a href="{{route('home')}}"><img class="img-fluid logo" src="{{asset('images/logo.png')}}" alt=""></a>
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
                                      @foreach($categories as $category)
                                          <li><a class="dropdown-item" href="{{route('categories.show', $category->category_id)}}">{{$category->category_name}}</a></li>
                                      @endforeach

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
                            
                          <form class="d-flex ms-auto">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="search-btn btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                          </form>
                          <!-- Các icon điều hướng -->
                          <div class="navbar-action">
                            <a class="navbar-icon" href="{{route('carts.index')}}"><i class="fa-solid fa-cart-shopping"></i></a>
                            <a class="navbar-icon" href="{{route('profile.show')}}"><i class="fa-solid fa-user"></i></a>
                          </div>
                        </div>
                      </nav>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <a href="{{route('home')}}"><button type="button" class="btn btn-outline-primary ">All</button></a>
                    @foreach($manufacturers as $manufacturer)
                        <a href="{{route('manufacturers.show', $manufacturer->manu_id)}}"><button type="button" class="btn btn-outline-primary">{{$manufacturer->manufacturer_name}}</button></a>
                    @endforeach
                    </div>
                    </div>
                    <!-- <div class="dasboard-image-container">
                    @foreach($manufacturers as $manufacturer)
                        <a class="hang" href="#"><img class="dashboard-image" src="{{asset('images/'.$manufacturer->image)}}" alt=""></a>
                    @endforeach
                    </div> -->
                </div>
            </div>
        </div>
    </header>
    <!-----chat---->
    <div class="chat">
                                <a class="navbar-icon" href="{{ route('chat.showChat') }}">
                                    <i class="far fa-comment-dots"></i>
                                </a>
                            </div>
                            <!-----endchat---->
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

