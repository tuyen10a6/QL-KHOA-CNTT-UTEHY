<?php

namespace App\Http\Controllers;

use App\Models\Diem;
use App\Models\DangKyMonHoc;
use App\Models\Nganh;
use Illuminate\Http\Request;

class DiemController extends Controller
{
    public function index()
    {
        // Giảng viên xem danh sách sinh viên trong lớp mình dạy
        if (auth()->user()->vaiTro->ten_vai_tro === 'lecturer') {
            $dangKyMonHoc = DangKyMonHoc::whereHas('lichHoc', function($query) {
                $query->where('giang_vien_id', auth()->id());
            })
            ->with(['sinhVien', 'monHoc', 'diem'])
            ->get();
        }
        // Sinh viên xem điểm của mình
        else if (auth()->user()->vaiTro->ten_vai_tro === 'student') {
            $dangKyMonHoc = DangKyMonHoc::where('sinh_vien_id', auth()->id())
                ->with(['monHoc', 'diem'])
                ->get();
        }

        return view('pages.diem.index', compact('dangKyMonHoc'));
    }

    public function create($dangKyMonHocId)
    {
        $dangKyMonHoc = DangKyMonHoc::with(['sinhVien', 'monHoc', 'lichHoc'])->findOrFail($dangKyMonHocId);

        // Kiểm tra quyền
        if (auth()->user()->vaiTro->ten_vai_tro !== 'lecturer') {
            return redirect()->back()->with('error', 'Bạn không có quyền nhập điểm.');
        }

        // Kiểm tra xem đây có phải lớp của giảng viên này không
        if ($dangKyMonHoc->lichHoc->giang_vien_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Bạn không có quyền nhập điểm cho lớp này.');
        }

        return view('pages.diem.create', compact('dangKyMonHoc'));
    }

    public function store(Request $request, $dangKyMonHocId)
    {
        // Kiểm tra quyền
        if (auth()->user()->vaiTro->ten_vai_tro !== 'lecturer') {
            return redirect()->back()->with('error', 'Bạn không có quyền nhập điểm.');
        }

        $dangKyMonHoc = DangKyMonHoc::with('lichHoc')->findOrFail($dangKyMonHocId);

        // Kiểm tra xem đây có phải lớp của giảng viên này không
        if ($dangKyMonHoc->lichHoc->giang_vien_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Bạn không có quyền nhập điểm cho lớp này.');
        }

        $request->validate([
            'diem_giua_ky' => 'required|numeric|min:0|max:10',
            'diem_cuoi_ky' => 'required|numeric|min:0|max:10',
            'nhan_xet' => 'nullable|string|max:500'
        ]);

        $diem = Diem::create([
            'dang_ky_mon_hoc_id' => $dangKyMonHocId,
            'diem_giua_ky' => $request->diem_giua_ky,
            'diem_cuoi_ky' => $request->diem_cuoi_ky,
            'nhan_xet' => $request->nhan_xet
        ]);

        $diem->calculateDiemTongKet();

        return redirect()->route('diem.index')
            ->with('success', 'Nhập điểm thành công.');
    }

    public function edit($id)
    {
        $diem = Diem::with(['dangKyMonHoc.lichHoc'])->findOrFail($id);

        // Kiểm tra quyền
        if (auth()->user()->vaiTro->ten_vai_tro !== 'lecturer') {
            return redirect()->back()->with('error', 'Bạn không có quyền sửa điểm.');
        }

        // Kiểm tra xem đây có phải lớp của giảng viên này không
        if ($diem->dangKyMonHoc->lichHoc->giang_vien_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Bạn không có quyền sửa điểm cho lớp này.');
        }

        return view('pages.diem.edit', compact('diem'));
    }

    public function update(Request $request, $id)
    {
        // Kiểm tra quyền
        if (auth()->user()->vaiTro->ten_vai_tro !== 'lecturer') {
            return redirect()->back()->with('error', 'Bạn không có quyền sửa điểm.');
        }

        $diem = Diem::with(['dangKyMonHoc.lichHoc'])->findOrFail($id);

        // Kiểm tra xem đây có phải lớp của giảng viên này không
        if ($diem->dangKyMonHoc->lichHoc->giang_vien_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Bạn không có quyền sửa điểm cho lớp này.');
        }

        $request->validate([
            'diem_giua_ky' => 'required|numeric|min:0|max:10',
            'diem_cuoi_ky' => 'required|numeric|min:0|max:10',
            'nhan_xet' => 'nullable|string|max:500'
        ]);

        $diem->update([
            'diem_giua_ky' => $request->diem_giua_ky,
            'diem_cuoi_ky' => $request->diem_cuoi_ky,
            'nhan_xet' => $request->nhan_xet
        ]);

        $diem->calculateDiemTongKet();

        return redirect()->route('diem.index')
            ->with('success', 'Cập nhật điểm thành công.');
    }

    public function studentView()
    {
        $dangKyMonHoc = DangKyMonHoc::where('sinh_vien_id', auth()->id())
            ->with(['monHoc', 'diem'])
            ->get();

        $nganhs = Nganh::query()->get();

        return view('pages.diem.student', compact('dangKyMonHoc', 'nganhs'));
    }
}
