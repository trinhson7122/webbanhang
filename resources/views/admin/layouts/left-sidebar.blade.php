<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <!-- LOGO -->
    <a href="{{ route('admin.index') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('images/logo.png') }}" alt="" height="50">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/logo.png') }}" alt="" height="50">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('admin.index') }}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('images/logo.png') }}" alt="" height="50">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/logo.png') }}" alt="" height="50">
        </span>
    </a>
    
    <div class="h-100" id="left-side-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-title side-nav-item">Điều hướng</li>

            <li class="side-nav-item">
                <a href="{{ route('admin.index') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboards</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.product_manager') }}" class="side-nav-link">
                    <i class="uil-archive"></i>
                    <span>Quản lý sản phẩm</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.user_manager') }}" class="side-nav-link">
                    <i class="uil-user-circle"></i>
                    <span>Quản lý người dùng</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.order_manager') }}" class="side-nav-link">
                    <i class="uil-cart"></i>
                    <span>Quản lý yêu cầu</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.coupon_manager') }}" class="side-nav-link">
                    <i class="uil-processor"></i>
                    <span>Quản lý mã giảm giá</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.slide_manager') }}" class="side-nav-link">
                    <i class="uil-processor"></i>
                    <span>Quản lý slide</span>
                </a>
            </li>
        </ul>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->