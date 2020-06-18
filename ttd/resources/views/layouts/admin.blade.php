<!DOCTYPE html>
<html lang="en">
@yield('head')
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img src="{{asset('admin/assets/images/logo.svg')}}" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><img src="{{asset('admin/assets/images/logo-mini.svg')}}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-img">
                            <img src="{!! \Illuminate\Support\Facades\Auth::user()->thumbnailUrl !!}" alt="image">
                            <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black">{!! \Illuminate\Support\Facades\Auth::user()->name !!}</p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ route('admin.products.me') }}">
                            <i class="mdi mdi-food mr-2 text-primary"></i> Sản phẩm của bạn</a>
                        <a class="dropdown-item" href="{{ route('admin.bookmarks.me') }}">
                            <i class="mdi mdi-bookmark-multiple mr-2 text-primary"></i> Đánh dấu của bạn</a>
                        <a class="dropdown-item" href="{{ route('admin.products.create') }}">
                            <i class="mdi mdi-plus-circle mr-2 text-primary"></i> Thêm sản phẩm</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout mr-2 text-primary"></i> Đăng xuất </a>
                    </div>
                </li>
                <li class="nav-item d-none d-lg-block full-screen-link">
                    <a class="nav-link">
                        <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                    </a>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <span class="menu-title">Trang chủ</span>
                        <i class="text-success mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->isSuperAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.products.nearby') }}">
                        <span class="menu-title">Tìm quanh đây</span>
                        <i class="text-success mdi mdi-google-nearby menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" href="#li-categories" aria-expanded="false" aria-controls="ui-basic">
                        <span class="menu-title">Quản lý danh mục</span>
                        <i class="menu-arrow"></i>
                        <i class="text-success mdi mdi-react"></i>
                    </a>
                    <div class="collapse" id="li-categories">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{route('admin.categories.index')}}">Danh sách danh mục</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('admin.categories.create')}}">Thêm danh mục</a></li>
                        </ul>
                    </div>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" href="#li-products" aria-expanded="false" aria-controls="ui-basic">
                        <span class="menu-title">Quản lý sản phẩm</span>
                        <i class="menu-arrow"></i>
                        <i class="text-success mdi mdi-food-fork-drink"></i>
                    </a>
                    <div class="collapse" id="li-products">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{route('admin.products.index')}}">Danh sách sản phẩm</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{route('admin.products.create')}}">Thêm sản phẩm</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-panel">
        @yield('content')
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<!-- plugins:js -->
<script src="{{asset('admin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="{{asset('admin/assets/js/off-canvas.js')}}"></script>
<script src="{{asset('admin/assets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('admin/assets/js/misc.js')}}"></script>
<!-- endinject -->
@yield('js')
</body>
</html>
