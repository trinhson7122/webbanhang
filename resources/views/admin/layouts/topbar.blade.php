<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topbar-right-menu float-right mb-0">
        <li class="dropdown notification-list d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-search noti-icon"></i>
            </a>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span>
                    <span class="account-user-name">{{ auth()->user()->name }}</span>
                    <span class="account-position">{{ auth()->user()->printRole() }}</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Chào mừng !</h6>
                </div>
                <a href="{{ route('auth.admin_logout') }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout mr-1"></i>
                    <span>Đăng xuất</span>
                </a>

            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left disable-btn">
        <i class="mdi mdi-menu"></i>
    </button>
    <div class="app-search dropdown d-none d-lg-block">
        <form method="get">
            <div class="input-group">
                @if (session()->has('by'))
                    <input type="hidden" name="type" value="{{ session()->get('type') }}">
                    <input type="hidden" name="by" value="{{ session()->get('by') }}">
                @endif
                <input type="text" name="search" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                <span class="mdi mdi-magnify search-icon"></span>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                </div>
            </div>
             
        </form>
    </div>
</div>
<!-- end Topbar -->