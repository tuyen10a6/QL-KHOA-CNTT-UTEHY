<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class NotificationController extends Controller
{
    public function showNotifications()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem thông báo.');
        }
        if ($user->vaiTro->ten_vai_tro === 'admin') {
            // Nếu là admin, lấy tất cả thông báo
            $thongBao = Notification::orderBy('created_at', 'desc')->get();
        } else {
            // Nếu không phải admin, lấy thông báo của người dùng hiện tại
            $thongBao = $user->thongBao()->orderBy('created_at', 'desc')->get();
        }
        // Truyền dữ liệu thông báo và người dùng vào view
        return view('pages.Notification.index', compact('user', 'thongBao'));
    }

    public function create()
    {
        $allUsers = User::where('id', '!=', auth()->id())->get();
        return view('pages.Notification.createNotification', compact('allUsers'));
    }

    // Gửi thông báo khẩn cấp đến người dùng đã chọn
    public function sendEmergencyAlert(Request $request)
    {
        // Validate yêu cầu
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string|max:500',
            'users' => 'nullable|array',
            'users.*' => 'exists:nguoi_dung,id',
            'loai_thong_bao' => 'required|string|in:Thông báo,Cảnh báo khẩn cấp',
        ],[
            'tieu_de.required' => 'Vui lòng nhập tiêu đề ngắn lại.',
            'noi_dung.required' => 'Vui lòng nhập nội dung ngắn lại.',
        ]);

        // Nội dung thông báo từ request
        $tieu_de = $request->input('tieu_de');
        $noi_dung = $request->input('noi_dung');
        $loai_thong_bao = $request->input('loai_thong_bao');

        if (in_array('all', $request->input('users', []))) {
            $nguoiDungs = User::all();
        } elseif ($request->input('users')) {
            $nguoiDungs = User::findMany($request->input('users'));
        } else {
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một người dùng để gửi thông báo.');
        }

        // Tạo thông báo cho từng người dùng
        foreach ($nguoiDungs as $nguoiDung) {
            Notification::create([
                'nguoi_dung_id' => $nguoiDung->id,
                'loai_thong_bao' => $loai_thong_bao,
                'tieu_de' => $tieu_de,
                'noi_dung' => $noi_dung,
            ]);
            if ($loai_thong_bao === 'Cảnh báo khẩn cấp') {
                Mail::send('emails.emergency-notification', [
                    'user' => $nguoiDung,
                    'tieu_de' => $tieu_de,
                    'noi_dung' => $noi_dung
                ], function ($message) use ($nguoiDung, $tieu_de) {
                    $message->to($nguoiDung->email)
                        ->subject('[Khẩn cấp] ' . $tieu_de);
                });
            }
        }


        return redirect()->back()->with('success', 'Thông báo đã được gửi đến người dùng được chọn.');
    }

    public function markNotificationsAsRead()
    {
        $user = Auth::user();
        if ($user) {
            Notification::where('nguoi_dung_id', $user->id)
                ->where('da_xem', false)
                ->update(['da_xem' => true]);
        }
        return response()->json(['status' => 'success']);
    }

    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Đánh dấu thông báo đã đọc
        if (!$notification->da_xem) {
            $notification->update(['da_xem' => true]);
        }
        
        return view('pages.Notification.view', compact('notification'));
    }

    public function approveRegistration($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Tạo user mới từ thông tin trong notification
        $content = $notification->noi_dung;
        $lines = explode("\n", $content);
        
        $userData = [];
        foreach ($lines as $line) {
            $parts = explode(": ", $line);
            if (count($parts) === 2) {
                $key = str_replace(' ', '_', strtolower($parts[0]));
                $userData[$key] = $parts[1];
            }
        }

        // Lấy khoa_id từ tên khoa
        $khoa = \App\Models\Khoa::where('ten_khoa', $userData['khoa'])->first();
        if (!$khoa) {
            return redirect()->back()->with('error', 'Không tìm thấy khoa tương ứng.');
        }

        // Tạo user với vai trò student (vai_tro_id = 3)
        $user = User::create([
            'ten' => $userData['tên'],
            'ten_dang_nhap' => $userData['tên_đăng_nhập'],
            'email' => $userData['email'],
            'sdt' => $userData['số_điện_thoại'],
            'gioi_tinh' => $userData['giới_tính'],
            'khoa_id' => $khoa->id,
            'mat_khau' => Hash::make($userData['mật_khẩu']),
            'vai_tro_id' => 4, // Vai trò Student
        ]);

        // Gửi email thông báo
        try {
            \Log::info('Attempting to send approval email to: ' . $userData['email']);
            Mail::to($userData['email'])->send(new \App\Mail\RegistrationApproved($userData));
            \Log::info('Approval email sent successfully to: ' . $userData['email']);
        } catch (\Exception $e) {
            \Log::error('Failed to send approval email: ' . $e->getMessage());
            // Vẫn tiếp tục tạo tài khoản người dùng ngay cả khi gửi email thất bại
        }

        // Xóa thông báo
        $notification->delete();

        return redirect('/')->with('success', 'Đã phê duyệt đăng ký thành công.');
    }

    public function rejectRegistration($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Lấy thông tin từ nội dung thông báo
        $content = $notification->noi_dung;
        $lines = explode("\n", $content);
        
        $userData = [];
        foreach ($lines as $line) {
            $parts = explode(": ", $line);
            if (count($parts) === 2) {
                $key = str_replace(' ', '_', strtolower($parts[0]));
                $userData[$key] = $parts[1];
            }
        }

        // Gửi email thông báo
        if (isset($userData['email'])) {
            Mail::to($userData['email'])->send(new \App\Mail\RegistrationRejected($userData));
        }

        // Xóa thông báo
        $notification->delete();

        return redirect('/')->with('success', 'Đã từ chối đăng ký thành công.');
    }

    public function showRegistrationDetail($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Kiểm tra xem thông báo có phải là yêu cầu đăng ký không
        if (!str_contains($notification->tieu_de, 'Yêu cầu đăng ký')) {
            return redirect()->route('thongbao.index')->with('error', 'Thông báo không phải là yêu cầu đăng ký');
        }

        return view('pages.Notification.registration-detail', compact('notification'));
    }
}

