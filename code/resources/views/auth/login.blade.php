<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <!-- Add FontAwesome for the eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background: url('storage/images/login1.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 1.5rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: white;
        }

        .card-header {
            background-color: transparent;
            color: #fff;
            text-align: center;
            padding: 0.7rem;
            border-bottom: none;
        }

        .card-header h4 {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .card-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .form-control::placeholder {
            color: #fff;
            opacity: 0.7;
        }

        .btn-primary {
            background-color: #28a745;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 1.2rem;
            font-weight: 600;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .form-group label {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 500;
        }

        .text-center {
            margin-top: 1.5rem;
        }

        .register-link {
            color: #fff;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .forgot-password {
            text-align: right;
            margin-top: 1rem;
        }

        .forgot-password a {
            color: #ff6f61;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .input-group {
            display: flex; /* Đảm bảo các phần tử trong input group nằm trên cùng một hàng */
        }

        .eye-icon {
            cursor: pointer;
            opacity: 0.7;
        }

        .eye-icon:hover {
            opacity: 1;
        }

        .password-wrapper {
            position: relative;
        }

        .error-message {
            color: #ff6f61;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Đăng Nhập</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                </div>
                                @error('email')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group password-wrapper">
                                <label for="password">Mật khẩu</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input id="password" type="password" name="password" class="form-control" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text eye-icon" id="togglePassword">
                                            <i class="fas fa-eye-slash"></i> <!-- Biểu tượng mắt gạch chéo mặc định -->
                                        </span>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                        </form>
                        <div class="text-center">
                            <span>Bạn chưa có tài khoản? </span>
                            <a href="{{ url('register') }}" class="register-link">Đăng ký tại đây</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const eyeIcon = togglePassword.querySelector('i');

        // Mặc định là ẩn mật khẩu và mắt gạch chéo
        password.type = 'password';
        eyeIcon.classList.add('fa-eye-slash'); // Mặc định là mắt gạch chéo

        togglePassword.addEventListener('mousedown', function() {
            // Hiện mật khẩu khi giữ chuột
            password.type = 'text';
            eyeIcon.classList.remove('fa-eye-slash'); // Xóa biểu tượng mắt gạch chéo
            eyeIcon.classList.add('fa-eye'); // Thêm biểu tượng mắt mở
        });

        togglePassword.addEventListener('mouseup', function() {
            // Ẩn mật khẩu khi thả chuột
            password.type = 'text'; // Giữ mật khẩu hiển thị
            eyeIcon.classList.remove('fa-eye'); // Xóa biểu tượng mắt
            eyeIcon.classList.add('fa-eye-slash'); // Thêm biểu tượng mắt gạch chéo
        });

        togglePassword.addEventListener('mouseleave', function() {
            // Ẩn mật khẩu khi di chuột ra khỏi biểu tượng
            password.type = 'password';
            eyeIcon.classList.remove('fa-eye'); // Xóa biểu tượng mắt
            eyeIcon.classList.add('fa-eye-slash'); // Thêm lại biểu tượng mắt gạch chéo
        });
    </script>
</body>

</html>
