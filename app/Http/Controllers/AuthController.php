<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        $khoas = \App\Models\Khoa::all();
        return view('pages.user-pages.register.index', compact('khoas'));
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'ten'           => 'required|string|max:255',
                'ten_dang_nhap' => 'required|string|max:255|unique:nguoi_dung',
                'email'         => 'required|string|email|max:255|unique:nguoi_dung',
                'sdt'           => 'required|string|max:20',
                'gioi_tinh'     => 'required|string|in:Nam,Nữ',
                'khoa_id'       => 'required|exists:khoa,id',
                'mat_khau'      => 'required|string|min:8|confirmed',
            ]);

            // Tạo thông báo cho admin
            $notificationContent = "Tên: {$validatedData['ten']}\n" .
                                   "Tên đăng nhập: {$validatedData['ten_dang_nhap']}\n" .
                                   "Email: {$validatedData['email']}\n" .
                                   "Số điện thoại: {$validatedData['sdt']}\n" .
                                   "Giới tính: {$validatedData['gioi_tinh']}\n" .
                                   "Khoa: " . \App\Models\Khoa::find($validatedData['khoa_id'])->ten_khoa . "\n" .
                                   "Mật khẩu: {$validatedData['mat_khau']}";

            // Tìm tất cả các admin
            $admins = \App\Models\User::whereHas('vaiTro', function ($query) {
                $query->where('ten_vai_tro', 'admin');
            })->get();

            if ($admins->isEmpty()) {
                return redirect()->back()->with('error', 'Không tìm thấy quản trị viên. Vui lòng thử lại sau.');
            }

            // Tạo thông báo cho mỗi admin
            foreach ($admins as $admin) {
                \App\Models\Notification::create([
                    'nguoi_dung_id'  => $admin->id,
                    'tieu_de'        => 'Yêu cầu đăng ký mới',
                    'noi_dung'       => $notificationContent,
                    'loai_thong_bao' => 'Yêu cầu đăng ký'
                ]);
            }

            return redirect()->route('login')
                             ->with('success', 'Yêu cầu đăng ký của bạn đã được gửi thành công! Vui lòng đợi quản trị viên phê duyệt.')
                             ->with('info', 'Bạn sẽ nhận được email thông báo khi tài khoản được phê duyệt.');

        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());
            return redirect()->back()
                             ->with('error', 'Có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại sau.')
                             ->withInput();
        }
    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('pages.user-pages.login.index');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Validate đầu vào
        $request->validate([
            'email_or_username' => 'required|string',
            'mat_khau'          => 'required',
        ]);

        // Lấy giá trị từ request
        $credentials = $request->only('email_or_username', 'mat_khau');

        // Kiểm tra xem người dùng nhập email hay tên đăng nhập
        if (filter_var($credentials['email_or_username'], FILTER_VALIDATE_EMAIL)) {
            // Đăng nhập bằng email
            $attempt = Auth::attempt(['email' => $credentials['email_or_username'], 'password' => $credentials['mat_khau']]);
        } else {
            // Đăng nhập bằng tên đăng nhập
            $attempt = Auth::attempt(['ten_dang_nhap' => $credentials['email_or_username'], 'password' => $credentials['mat_khau']]);
        }

        // Nếu đăng nhập thành công
        if ($attempt) {
            $request->session()->regenerate();

            // Lấy thông tin người dùng
            $user = Auth::user();

            // Kiểm tra vai trò và điều hướng
            if ($user->vai_tro_id === 1 || $user->vai_tro_id === 3) { // admin hoặc lecturer
                return redirect('/');
            } else { // student
                return redirect('/dashboard');
            }
        }

        // Nếu đăng nhập thất bại, báo lỗi
        throw ValidationException::withMessages([
            'email_or_username' => ['Thông tin đăng nhập không chính xác.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showForgotPasswordForm()
    {
        return view('pages.user-pages.forgot-password');
    }

    // Xử lý yêu cầu quên mật khẩu
    public function handleForgotPassword(Request $request)
    {
        // Validate email
        $request->validate([
            'email' => 'required|email|exists:nguoi_dung,email',
        ]);

        // Lấy thông tin người dùng dựa trên email
        $user = User::where('email', $request->email)->first();

        // Tạo thông báo cho admin
        $admin = User::whereHas('vaiTro', function ($query) {
            $query->where('ten_vai_tro', 'admin');
        })->first();

        if ($admin) {
            Notification::create([
                'nguoi_dung_id'  => $admin->id,
                'loai_thong_bao' => 'Thông báo',
                'tieu_de'        => 'Yêu cầu đặt lại mật khẩu',
                'noi_dung'       => "Người dùng với email: {$user->email} đã yêu cầu đặt lại mật khẩu.",
            ]);
        }

        // Thông báo đã gửi thành công
        return redirect()->back()->with('success', 'Yêu cầu của bạn đã được gửi. Vui lòng chờ admin kiểm tra.');
    }

}
