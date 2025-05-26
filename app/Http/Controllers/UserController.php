<?php

namespace App\Http\Controllers;

use App\Models\Nganh;
use App\Models\Role;
use App\Models\User;
use App\Models\Khoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index(Request $request)
    {
        $query = User::query();

        // Lọc theo vai trò nếu có và không phải là giá trị rỗng
        if ($request->has('vai_tro') && !empty($request->vai_tro)) {
            $vaiTro = $request->vai_tro;
            $query->whereHas('vaiTro', function ($q) use ($vaiTro) {
                $q->where('ten_vai_tro', $vaiTro);
            });
        }

        $nguoiDung = $query->with(['vaiTro', 'khoa'])->get();
        $vaiTroList = Role::all();

        return view('pages.user.index', compact('nguoiDung', 'vaiTroList'));
    }

    public function showDetailUser($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.userDetail', compact('user'));
    }

    // Hiển thị form thêm người dùng
    public function create()
    {
        $vaiTroList = Role::all();
        $khoaList = Khoa::where('trang_thai', true)->get();
        return view('pages.user.createUser', compact('vaiTroList', 'khoaList'));
    }

    // Xử lý thêm người dùng
    public function store(Request $request)
    {
        $request->validate([
            'ten'           => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:nguoi_dung',
            'ten_dang_nhap' => 'required|string|max:255|unique:nguoi_dung',
            'vai_tro_id'    => 'required|exists:vai_tro,id',
            'khoa_id'       => 'nullable|exists:khoa,id',
            'so_dien_thoai' => 'nullable|string|max:15',
            'ngay_sinh'     => 'nullable|date',
            'gioi_tinh'     => 'nullable|in:Nam,Nữ,Khác',
            'dia_chi'       => 'nullable|string|max:255',
            'ghi_chu'       => 'nullable|string',
        ]);

        User::create([
            'ten'           => $request->ten,
            'email'         => $request->email,
            'ten_dang_nhap' => $request->ten_dang_nhap,
            'vai_tro_id'    => $request->vai_tro_id,
            'khoa_id'       => $request->khoa_id,
            'so_dien_thoai' => $request->so_dien_thoai,
            'ngay_sinh'     => $request->ngay_sinh,
            'gioi_tinh'     => $request->gioi_tinh,
            'dia_chi'       => $request->dia_chi,
            'ghi_chu'       => $request->ghi_chu,
            'mat_khau'      => Hash::make('12345678'),
            'trang_thai'    => true,
        ]);

        return redirect()->route('danh-sach-nguoi-dung')->with('success', 'Thêm người dùng thành công.');
    }

    // Hiển thị form sửa người dùng
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $vaiTroList = Role::all();
        $khoaList = Khoa::where('trang_thai', true)->get();
        return view('pages.user.edittingUser', compact('user', 'vaiTroList', 'khoaList'));
    }

    // Xử lý sửa người dùng
    public function update(Request $request, $id)
    {
        $request->validate([
            'ten'           => 'required|string|max:255',
            'ten_dang_nhap' => 'required|string|max:255|unique:nguoi_dung,ten_dang_nhap,' . $id,
            'email'         => 'required|string|email|max:255|unique:nguoi_dung,email,' . $id,
            'vai_tro_id'    => 'required|exists:vai_tro,id',
            'khoa_id'       => 'nullable|exists:khoa,id',
            'trang_thai'    => 'boolean',
            'gioi_tinh'     => 'nullable|in:nam,nu',
            'sdt'           => 'nullable|string|max:15',
            'cccd'          => 'nullable|string|max:20',
            'avatar'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mat_khau'      => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'ten'           => $request->ten,
            'ten_dang_nhap' => $request->ten_dang_nhap,
            'email'         => $request->email,
            'vai_tro_id'    => $request->vai_tro_id,
            'khoa_id'       => $request->khoa_id,
            'trang_thai'    => $request->trang_thai ? true : false,
            'gioi_tinh'     => $request->gioi_tinh,
            'sdt'           => $request->sdt,
            'cccd'          => $request->cccd,
        ]);

        if ($request->filled('mat_khau')) {
            $user->update([
                'mat_khau' => Hash::make($request->mat_khau),
            ]);

            // Gửi email thông báo mật khẩu mới cho người dùng
            Mail::send('emails.reset-password', ['user' => $user, 'mat_khau_moi' => $request->mat_khau], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Mật khẩu của bạn đã được cập nhật');
            });
        }

        // Xử lý avatar nếu có
        if ($request->hasFile('avatar')) {
            // Xóa avatar cũ nếu có
            if ($user->avatar) {
                // Đường dẫn cũ của avatar
                $oldAvatarPath = public_path('assets/images/avatars/' . $user->avatar);
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath); // Xóa tệp avatar cũ
                }
            }
            $avatarFile = $request->file('avatar');
            $avatarName = time() . '_' . $avatarFile->getClientOriginalName();
            $avatarPath = public_path('assets/images/avatars'); // Đường dẫn mới lưu avatar
            $avatarFile->move($avatarPath, $avatarName);

            $user->update(['avatar' => $avatarName]);
        }
        return redirect()->route('danh-sach-nguoi-dung')->with('success', 'Cập nhật người dùng thành công.');
    }


    // Xóa người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('danh-sach-nguoi-dung')->with('success', 'Xóa người dùng thành công.');
    }

    public function showUserPermissions($userId)
    {
        $user = User::findOrFail($userId);
        return view('pages.user.assignActions', compact('user'));
    }

    public function assignUserPermissions(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $request->validate([
            'can_create_user'         => 'required|boolean',
            'can_edit_user'           => 'required|boolean',
            'can_delete_user'         => 'required|boolean',
            'can_create_device'       => 'required|boolean',
            'can_edit_device'         => 'required|boolean',
            'can_delete_device'       => 'required|boolean',
            'can_create_schedule'     => 'required|boolean',
            'can_edit_schedule'       => 'required|boolean',
            'can_delete_schedule'     => 'required|boolean',
            'can_create_notification' => 'required|boolean',
            'can_create_report'       => 'required|boolean',
        ]);

        $userAction = $user->actions()->updateOrCreate(
            ['user_id' => $userId],
            [
                'can_create_user'         => $request->can_create_user,
                'can_edit_user'           => $request->can_edit_user,
                'can_delete_user'         => $request->can_delete_user,
                'can_create_device'       => $request->can_create_device,
                'can_edit_device'         => $request->can_edit_device,
                'can_delete_device'       => $request->can_delete_device,
                'can_create_schedule'     => $request->can_create_schedule,
                'can_edit_schedule'       => $request->can_edit_schedule,
                'can_delete_schedule'     => $request->can_delete_schedule,
                'can_create_notification' => $request->can_create_notification,
                'can_create_report'       => $request->can_create_report,
            ]
        );

        return redirect()->route('danh-sach-nguoi-dung')->with('success', 'Cập nhật quyền thành công.');
    }

    public function findUserByEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            return response()->json(['user_id' => $user->id]);
        }

        return response()->json(['error' => 'User not found'], 404);
    }

    public function profile()
    {
        $user = auth()->user();
        $nganhs = Nganh::all();
        return view('pages.user.profile', compact('user', 'nganhs'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        $khoaList = Khoa::where('trang_thai', true)->get();
        return view('pages.user.editProfile', compact('user', 'khoaList'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'ten'       => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:nguoi_dung,email,' . $user->id,
            'sdt'       => 'nullable|string|max:15',
            'gioi_tinh' => 'nullable|in:nam,nu',
            'dia_chi'   => 'nullable|string|max:255',
            'khoa_id'   => 'nullable|exists:khoa,id',
            'cccd'      => 'nullable|string|max:20',
            'avatar'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->update([
            'ten'       => $request->ten,
            'email'     => $request->email,
            'sdt'       => $request->sdt,
            'gioi_tinh' => $request->gioi_tinh,
            'dia_chi'   => $request->dia_chi,
            'khoa_id'   => $request->khoa_id,
            'cccd'      => $request->cccd,
        ]);

        if ($request->hasFile('avatar')) {
            // Xóa avatar cũ nếu có
            if ($user->avatar) {
                $oldAvatarPath = public_path('assets/images/avatars/' . $user->avatar);
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }

            $avatarFile = $request->file('avatar');
            $avatarName = time() . '_' . $avatarFile->getClientOriginalName();
            $avatarPath = public_path('assets/images/avatars');
            $avatarFile->move($avatarPath, $avatarName);

            $user->update(['avatar' => $avatarName]);
        }

        return redirect()->route('thong-tin-ca-nhan')->with('success', 'Cập nhật thông tin thành công.');
    }
}

