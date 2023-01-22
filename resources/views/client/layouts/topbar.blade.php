<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="/"><img src="{{ asset('images/logo.png') }}" width="50" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link text-dark bold" href="{{ route('index') }}">TRANG CHỦ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark bold" href="{{ route('cart') }}">GIỎ HÀNG</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark bold" href="#">VỀ CHÚNG TÔI</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark bold" href="#">SẢN PHẨM</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>
        <a href="{{ route('cart') }}" class="btn btn-warning my-2 my-sm-0 ml-2 mr-2">Giỏ hàng</a>
        @auth
        <div class="dropdown">
          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="topbar-userdrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span>{{ auth()->user()->name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop" style="">
              <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome !</h6>
              </div>
              <a href="{{ route('profile') }}" class="dropdown-item notify-item">
                  <i class="mdi mdi-account-circle mr-1"></i>
                  <span>Tài khoản của tôi</span>
              </a>
              <a href="{{ route('auth.logout') }}" class="dropdown-item notify-item">
                  <i class="mdi mdi-logout mr-1"></i>
                  <span>Đăng xuất</span>
              </a>
          </div>
        </div>
        @endauth
        @guest
          <a href="{{ route('auth.login') }}" class="btn btn-danger my-2 my-sm-0">Đăng nhập</a>
          <button class="btn btn-success my-2 my-sm-0 ml-2 mr-2" type="button">Đăng ký</button>
        @endguest
      </form>
    </div>
  </nav>