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
        }

        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
        }

        .navbar-brand img {
            max-height: 80px;
            margin-left: 16px;
        }

        .navbar-nav .nav-link {
            position: relative;
            color: #555;
            padding: 15px 25px;
            font-weight: bold;
            font-size: 1.2rem; /* Tăng kích thước chữ lên */
            padding-top: 45px; /* Điều chỉnh khoảng cách từ trên xuống */
            padding-bottom: 5px; /* Điều chỉnh khoảng cách từ dưới lên */
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #28a745;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 3px; /* Độ dày của viền */
            background-color: #28a745; /* Màu viền */
            transform: scaleX(0); /* Bắt đầu với viền không hiển thị */
            transition: transform 0.3s ease; /* Hiệu ứng chuyển tiếp */
        }

        .navbar-nav .nav-link:hover::after {
            transform: scaleX(1); /* Hiển thị viền khi hover */
        }

        .cart-icon {
            position: relative;
            margin-right: 15px;
        }

        .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #dc3545;
            color: white;
            padding: 5px;
            border-radius: 50%;
            font-size: 12px;
        }

        .container {
            margin-top: 20px;
        }

        .content-area {
            margin-top: 80px;
        }

        .card {
            margin-bottom: 30px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-toggle::after {
            display: none; /* Ẩn mũi tên dropdown */
        }

        @media (max-width: 768px) {
            .navbar-nav .nav-link {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('products.index') }}">
                <img src="{{ asset('storage/images/logorem.jpg') }}" alt="My Application">
            </a>
            <div class="navbar-collapse collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">SẢN PHẨM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">ĐƠN HÀNG</a>
                    </li>
                </ul>

                <div class="cart-icon ms-3 d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center" href="{{ route('cart.index') }}">
                            <div style="position: relative;">
                                <img src="{{ asset('storage/images/shopping.png') }}" alt="Giỏ Hàng" style="width: 55px; height: 55px;">
                                <span class="badge" style="position: absolute; top: -5px; right: -10px;">{{ $cartCount ? $cartCount : 0 }}</span>
                            </div>
                            <span class="ms-3" style="font-size: 20px;">Giỏ hàng</span>
                        </a>
                    </div>

                <div class="d-flex align-items-center">
                    <!-- Dropdown cho Tài khoản -->
                    <div class="dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('storage/images/user.png') }}" alt="Tài khoản" style="width: 50px; height: 50px;">
                            <span class="ms-2" style="font-size: 20px;">{{ session('user_name', 'Tài khoản') }}</span> 

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @if(auth()->check())
                                <li>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size: 20px;">
                                        <img src="{{ asset('storage/images/LO2.png') }}" alt="Logout" style="width: 35px; height: 35px; margin-right: 5px;">
                                        Logout
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <img src="{{ asset('storage/images/LG1.png') }}" alt="Login" style="width: 30px; height: 30px; margin-right: 8px;">
                                        Đăng nhập
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    
                </div>
            </div>
        </div>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="container content-area">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
