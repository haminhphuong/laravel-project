<!-- resources/views/layouts/admin.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/layout.css')}}">
    <!-- Các file CSS, JavaScript, Font, Icon khác -->
    <script src="{{asset('js/vendor/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" defer></script>
    <style>
        .container-fluid .row nav{
            height: 1200px;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand logo_h" href="{{ route('admin.dashboard') }}"><img src="{{ asset('img/logo.png') }}" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
</header>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{strpos(request()->url(),'dashboard') ? 'active' : ''}}" href="{{route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{strpos(request()->url(),'customers') ? 'active' : ''}}" href="{{ route('admin.customers.index') }}">Khách hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{strpos(request()->url(),'products') ? 'active' : ''}}" href="{{ route('admin.products.index') }}">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{strpos(request()->url(),'categories') ? 'active' : ''}}" href="{{ route('admin.categories.index') }}">Danh mục</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{strpos(request()->url(),'orders') ? 'active' : ''}}" href="{{ route('admin.orders.index') }}">Đơn hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{strpos(request()->url(),'contacts') ? 'active' : ''}}" href="{{ route('admin.contacts.index') }}">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>
</div>
<footer class="footer">
    <div class="container-fluid">
        <span class="text-muted">&copy; 2023. All rights reserved.</span>
    </div>
</footer>

