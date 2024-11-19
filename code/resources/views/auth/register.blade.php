<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <!-- Add FontAwesome for the eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background: url('storage/images/login.jpeg') no-repeat center center fixed;
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

        .login-link {
            color: #fff;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
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
                        <h4 class="card-title">Đăng Ký</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Họ Tên</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                                </div>
                                @error('name')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

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
                                </div>
                                @error('password')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group password-wrapper">
                                <label for="password_confirmation">Nhập lại mật khẩu</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Đăng Ký</button>
                        </form>
                        <div class="text-center">
                            <span>Đã có tài khoản? </span>
                            <a href="{{ url('login') }}" class="login-link">Đăng nhập tại đây</a>
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
</body>

</html>
