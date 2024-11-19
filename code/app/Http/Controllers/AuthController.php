<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegisterForm() {
        return view('auth.register');
    }

    // Xử lý đăng ký người dùng
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer'
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }

    // Hiển thị form đăng nhập
    public function showLoginForm() {
        return view('auth.login');
    }

    // Xử lý đăng nhập người dùng
    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Kiểm tra xem người dùng có tồn tại không
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email không chính xác.'])->withInput();
        }

        // Kiểm tra mật khẩu
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Mật khẩu không chính xác.'])->withInput();
        }

        // Đăng nhập người dùng
        Auth::login($user);
        $request->session()->regenerate();

        // Lưu tên người dùng vào session
        $request->session()->put('user_name', $user->name);

        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('products.index'));
    }
    
    // Xử lý đăng xuất người dùng
    public function logout(Request $request) {
        // Xóa tên người dùng khỏi session
        $request->session()->forget('user_name');
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login');
    }
}
