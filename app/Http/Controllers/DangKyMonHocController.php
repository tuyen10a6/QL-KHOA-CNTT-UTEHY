<?php

namespace App\Http\Controllers;

use App\Models\DangKyMonHoc;
use App\Models\MonHoc;
use App\Models\Nganh;
use App\Models\User;
use App\Models\LichHocMonHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DangKyMonHocController extends Controller
{
    public function index()
    {
        // Kiểm tra vai trò sinh viên
        if (auth()->user()->vaiTro->ten_vai_tro !== 'student') {
            return redirect()->back()->with('error', 'Chỉ sinh viên mới có thể xem danh sách đăng ký môn học.');
        }

        $dangKyMonHoc = DangKyMonHoc::where('sinh_vien_id', auth()->id())
            ->with(['monHoc', 'lichHoc'])
            ->get();

        $nganhs = Nganh::all();
        return view('pages.dang-ky-mon-hoc.index', compact('dangKyMonHoc', 'nganhs'));
    }

    public function create()
    {
        // Lấy danh sách lịch học môn học còn hoạt động và còn slot trống
        $lichHocMonHoc = LichHocMonHoc::where('trang_thai', 1)
            ->where('so_luong_sv_da_dang_ky', '<', \DB::raw('so_luong_sv_toi_da'))
            ->with(['monHoc', 'giangVien'])
            ->get();

        // Lấy danh sách môn học đã đăng ký của sinh viên hiện tại
        $dangKyMonHoc = DangKyMonHoc::where('sinh_vien_id', auth()->id())
            ->where('trang_thai', 1)
            ->get();

        $nganhs = Nganh::all();

        return view('pages.dang-ky-mon-hoc.create', compact('lichHocMonHoc', 'dangKyMonHoc', 'nganhs'));
    }

    public function store(Request $request)
    {
        // Kiểm tra vai trò sinh viên
        if (auth()->user()->vaiTro->ten_vai_tro !== 'student') {
            return redirect()->back()->with('error', 'Chỉ sinh viên mới có thể đăng ký môn học.');
        }

        $request->validate([
            'lich_hoc_mon_hoc_id' => 'required|exists:lich_hoc_mon_hoc,id',
        ]);

        // Kiểm tra xem lịch học còn chỗ trống không
        $lichHoc = LichHocMonHoc::findOrFail($request->lich_hoc_mon_hoc_id);
        if ($lichHoc->so_luong_sv_da_dang_ky >= $lichHoc->so_luong_sv_toi_da) {
            return redirect()->back()->with('error', 'Lớp học đã đầy.');
        }

        // Kiểm tra xem sinh viên đã đăng ký môn học này chưa
        $daDangKy = DangKyMonHoc::where('sinh_vien_id', auth()->id())
            ->whereHas('lichHoc', function($query) use ($lichHoc) {
                $query->where('mon_hoc_id', $lichHoc->mon_hoc_id);
            })
            ->exists();

        if ($daDangKy) {
            return redirect()->back()->with('error', 'Bạn đã đăng ký môn học này.');
        }

        // Tạo đăng ký mới
        DangKyMonHoc::create([
            'sinh_vien_id' => auth()->id(),
            'mon_hoc_id' => $lichHoc->mon_hoc_id,
            'lich_hoc_mon_hoc_id' => $request->lich_hoc_mon_hoc_id,
            'ma_lop' => $lichHoc->ma_lop,
            'phong_hoc' => $lichHoc->phong_hoc,
            'thu' => $lichHoc->thu,
            'tiet_bat_dau' => $lichHoc->tiet_bat_dau,
            'tiet_ket_thuc' => $lichHoc->tiet_ket_thuc,
            'giang_vien' => $lichHoc->giangVien->ten,
            'trang_thai' => 1,
        ]);

        // Cập nhật số lượng sinh viên đã đăng ký
        $lichHoc->increment('so_luong_sv_da_dang_ky');

        return redirect()->route('dang-ky-mon-hoc.index')
            ->with('success', 'Đăng ký môn học thành công.');
    }

    public function show($id)
    {
        $dangKyMonHoc = DangKyMonHoc::with('monHoc')->findOrFail($id);
        return view('pages.dang-ky-mon-hoc.show', compact('dangKyMonHoc'));
    }

    public function edit($id)
    {
        $dangKyMonHoc = DangKyMonHoc::findOrFail($id);

        // Kiểm tra quyền chỉnh sửa
        if ($dangKyMonHoc->sinh_vien_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Bạn không có quyền chỉnh sửa đăng ký này.');
        }

        // Lấy danh sách lịch học môn học còn slot trống
        $lichHocMonHoc = LichHocMonHoc::where('trang_thai', 1)
            ->where('so_luong_sv_da_dang_ky', '<', \DB::raw('so_luong_sv_toi_da'))
            ->where('mon_hoc_id', $dangKyMonHoc->mon_hoc_id)
            ->with('monHoc')
            ->get();

        return view('pages.dang-ky-mon-hoc.edit', compact('dangKyMonHoc', 'lichHocMonHoc'));
    }

    public function update(Request $request, $id)
    {
        $dangKyMonHoc = DangKyMonHoc::findOrFail($id);

        // Kiểm tra quyền chỉnh sửa
        if ($dangKyMonHoc->sinh_vien_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Bạn không có quyền chỉnh sửa đăng ký này.');
        }

        $request->validate([
            'lich_hoc_mon_hoc_id' => 'required|exists:lich_hoc_mon_hoc,id',
        ]);

        // Kiểm tra xem lịch học mới còn chỗ trống không
        $lichHocMoi = LichHocMonHoc::findOrFail($request->lich_hoc_mon_hoc_id);
        if ($lichHocMoi->so_luong_sv_da_dang_ky >= $lichHocMoi->so_luong_sv_toi_da) {
            return redirect()->back()->with('error', 'Lớp học đã đầy.');
        }

        // Giảm số lượng sinh viên ở lớp cũ
        $dangKyMonHoc->lichHoc->decrement('so_luong_sv_da_dang_ky');

        // Cập nhật thông tin đăng ký với lớp mới
        $dangKyMonHoc->update([
            'lich_hoc_mon_hoc_id' => $request->lich_hoc_mon_hoc_id,
            'ma_lop' => $lichHocMoi->ma_lop,
            'phong_hoc' => $lichHocMoi->phong_hoc,
            'thu' => $lichHocMoi->thu,
            'tiet_bat_dau' => $lichHocMoi->tiet_bat_dau,
            'tiet_ket_thuc' => $lichHocMoi->tiet_ket_thuc,
            'giang_vien' => $lichHocMoi->giangVien->ten,
        ]);

        // Tăng số lượng sinh viên ở lớp mới
        $lichHocMoi->increment('so_luong_sv_da_dang_ky');

        return redirect()->route('dang-ky-mon-hoc.index')
            ->with('success', 'Cập nhật đăng ký môn học thành công.');
    }

    public function destroy($id)
    {
        // Kiểm tra vai trò sinh viên
        if (auth()->user()->vaiTro->ten_vai_tro !== 'student') {
            return redirect()->back()->with('error', 'Chỉ sinh viên mới có thể hủy đăng ký môn học.');
        }

        $dangKyMonHoc = DangKyMonHoc::findOrFail($id);

        // Kiểm tra xem đây có phải đăng ký của sinh viên này không
        if ($dangKyMonHoc->sinh_vien_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Bạn không có quyền hủy đăng ký này.');
        }

        // Giảm số lượng sinh viên đã đăng ký trong lịch học
        $dangKyMonHoc->lichHoc->decrement('so_luong_sv_da_dang_ky');

        $dangKyMonHoc->delete();

        return redirect()->route('dang-ky-mon-hoc.index')
            ->with('success', 'Hủy đăng ký môn học thành công.');
    }

    public function lichHoc()
    {
        // Kiểm tra đăng nhập
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem lịch học.');
        }

        // Kiểm tra vai trò sinh viên
        if (auth()->user()->vaiTro->ten_vai_tro !== 'student') {
            return redirect()->back()->with('error', 'Chỉ sinh viên mới có thể xem lịch học.');
        }

        // Lấy danh sách đăng ký môn học của sinh viên
        $dangKyMonHoc = DangKyMonHoc::where('sinh_vien_id', auth()->id())
            ->where('trang_thai', 1)
            ->with(['monHoc', 'lichHoc.giangVien'])
            ->get();

        // Debug dữ liệu
        \Log::info('Dữ liệu đăng ký môn học:', [
            'count' => $dangKyMonHoc->count(),
            'data' => $dangKyMonHoc->map(function($item) {
                return [
                    'mon_hoc' => $item->monHoc->ten_mon_hoc,
                    'thu' => $item->thu,
                    'tiet_bat_dau' => $item->tiet_bat_dau,
                    'tiet_ket_thuc' => $item->tiet_ket_thuc,
                    'phong_hoc' => $item->phong_hoc,
                    'giang_vien' => $item->lichHoc->giangVien->ten
                ];
            })->toArray()
        ]);

        // Chuyển đổi format thứ và tiết học
        $dangKyMonHoc->transform(function ($item) {
            // Chuyển đổi thứ - chỉ thêm "Thứ " nếu chưa có
            if (!str_starts_with($item->thu, 'Thứ ')) {
                $item->thu = "Thứ " . $item->thu;
            }

            // Chuyển đổi tiết học sang số nguyên
            $item->tiet_bat_dau = (int)$item->tiet_bat_dau;
            $item->tiet_ket_thuc = (int)$item->tiet_ket_thuc;

            // Debug sau khi chuyển đổi
            \Log::info('Sau khi chuyển đổi:', [
                'thu' => $item->thu,
                'tiet_bat_dau' => $item->tiet_bat_dau,
                'tiet_ket_thuc' => $item->tiet_ket_thuc
            ]);

            return $item;
        });

        return view('pages.dang-ky-mon-hoc.lich-hoc', compact('dangKyMonHoc'));

    }
}
