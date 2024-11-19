<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            padding-top: 75px;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #ffffff;
            border-right: 1px solid #ddd;
            position: fixed;
            height: 100%;
            padding-top: 30px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .sidebar a {
            display: block;
            padding: 15px 20px;
            color: #555;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s, box-shadow 0.3s, transform 0.3s;
        }

        .sidebar a:hover {
            background-color: #f1f1f1;
            color: #28a745;
        }

        /* Hiển thị trạng thái active (đang chọn) */
        .sidebar a.active {
            background-color: Orange;
            color: #fff;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }

        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
            justify-content: space-between;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        .navbar-brand img {
            max-height: 60px;
            height: auto;
            width: auto;
            margin-right: 15px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding-top: 15px;
            }

            .content {
                margin-left: 0;
            }

            .navbar {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('storage/images/logorem.jpg') }}" alt="My Application">
            </a>
         
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}" style="font-size: 18px; text-decoration: none; color: black;">
            <img src="{{ asset('storage/images/home.png') }}" alt="Dashboard" style="width: 30px; height: 30px; margin-right: 10px;">
            Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->is('admin/products*') ? 'active' : '' }}" style="font-size: 18px; text-decoration: none; color: black;">
            <img src="{{ asset('storage/images/Box.png') }}" alt="Sản phẩm" style="width: 30px; height: 30px; margin-right: 10px;">
            Quản Lý Sản Phẩm
            </a>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->is('admin/categories*') ? 'active' : '' }}" style="font-size: 18px; text-decoration: none; color: black;">
            <img src="{{ asset('storage/images/DM.png') }}" alt="Danh mục" style="width: 30px; height: 30px; margin-right: 10px;">
            Quản Lý Danh Mục
            </a>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->is('admin/orders*') ? 'active' : '' }}" style="font-size: 18px; text-decoration: none; color: black;">
            <img src="{{ asset('storage/images/DH4.png') }}" alt="Đơn hàng" style="width: 30px; height: 30px; margin-right: 10px;">
            Quản Lý Đơn Hàng
            </a>
            <a href="{{ route('admin.reports.index') }}" class="{{ request()->is('admin/reports*') ? 'active' : '' }}" style="font-size: 18px; text-decoration: none; color: black;">
            <img src="{{ asset('storage/images/BC3.png') }}" alt="Báo cáo" style="width: 30px; height: 30px; margin-right: 10px;">
            Báo Cáo
            </a>


        
            <div class="d-flex align-items-center">
                <div class="dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center;">
                    <img src="{{ asset('storage/images/US.png') }}" alt="Tài khoản" style="width: 50px; height: 50px; margin-right: 8px;">
                    <span style="font-size: 20px; margin-right: 20px;">{{ session('user_name', 'Tài khoản') }}</span>                </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size: 20px;">
                                <img src="{{ asset('storage/images/LO1.png') }}" alt="Logout" style="width: 30px; height: 30px;">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        
    </nav>

    <!-- <div class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}" style="font-size: 18px;">
            <img src="{{ asset('storage/images/home.png') }}" alt="Dashboard" style="width: 30px; height: 30px; margin-right: 10px;">
            Dashboard
        </a>
        <a href="{{ route('admin.products.index') }}" class="{{ request()->is('admin/products*') ? 'active' : '' }}" style="font-size: 18px;">
            <img src="{{ asset('storage/images/Box.png') }}" alt="Sản phẩm" style="width: 30px; height: 30px; margin-right: 10px;">
            Quản Lý Sản Phẩm
        </a>
        <a href="{{ route('admin.categories.index') }}" class="{{ request()->is('admin/categories*') ? 'active' : '' }}" style="font-size: 18px;">
            <img src="{{ asset('storage/images/DM.png') }}" alt="Danh mục" style="width: 30px; height: 30px; margin-right: 10px;">
            Quản Lý Danh Mục
        </a>
        <a href="{{ route('admin.orders.index') }}" class="{{ request()->is('admin/orders*') ? 'active' : '' }}" style="font-size: 18px;">
            <img src="{{ asset('storage/images/DH4.png') }}" alt="Đơn hàng" style="width: 30px; height: 30px; margin-right: 10px;">
            Quản Lý Đơn Hàng
        </a>
        <a href="{{ route('admin.reports.index') }}" class="{{ request()->is('admin/reports*') ? 'active' : '' }}" style="font-size: 18px;">
            <img src="{{ asset('storage/images/BC3.png') }}" alt="Báo cáo" style="width: 30px; height: 30px; margin-right: 10px;">
            Báo Cáo
        </a>
    </div> -->

    <div class="content">
        <div class="container content-area">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
