<?php

namespace App\Http\Controllers;

use App\Models\LichHocMonHoc;
use App\Models\MonHoc;
use App\Models\User;
use Illuminate\Http\Request;

class LichHocMonHocController extends Controller
{
    public function index()
    {
        $lichHocMonHoc = LichHocMonHoc::with(['monHoc', 'giangVien'])->get();
        return view('pages.lich-hoc-mon-hoc.index', compact('lichHocMonHoc'));
    }

    public function create()
    {
        $monHocs = MonHoc::where('trang_thai', true)->get();
        $giangViens = User::whereHas('vaiTro', function($query) {
            $query->where('ten_vai_tro', 'lecturer');
        })->where('trang_thai', true)->get();

        return view('pages.lich-hoc-mon-hoc.create', compact('monHocs', 'giangViens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mon_hoc_id' => 'required|exists:mon_hoc,id',
            'ma_lop' => 'required|string|max:20',
            'phong_hoc' => 'required|string|max:50',
            'thu' => 'required|string|max:10',
            'tiet_bat_dau' => 'required|string|max:10',
            'tiet_ket_thuc' => 'required|string|max:10',
            'giang_vien_id' => 'required|exists:nguoi_dung,id',
            'so_luong_sv_toi_da' => 'required|integer|min:1',
        ]);

        $giangVien = User::find($request->giang_vien_id);

        LichHocMonHoc::create([
            'mon_hoc_id' => $request->mon_hoc_id,
            'ma_lop' => $request->ma_lop,
            'phong_hoc' => $request->phong_hoc,
            'thu' => $request->thu,
            'tiet_bat_dau' => $request->tiet_bat_dau,
            'tiet_ket_thuc' => $request->tiet_ket_thuc,
            'giang_vien_id' => $request->giang_vien_id,
            'giang_vien' => $giangVien->ten,
            'so_luong_sv_toi_da' => $request->so_luong_sv_toi_da,
            'so_luong_sv_da_dang_ky' => 0,
            'trang_thai' => true,
        ]);

        return redirect()->route('lich-hoc-mon-hoc.index')->with('success', 'Thêm lịch học thành công.');
    }

    public function edit($id)
    {
        $lichHoc = LichHocMonHoc::findOrFail($id);
        $monHocs = MonHoc::where('trang_thai', true)->get();
        $giangViens = User::whereHas('vaiTro', function($query) {
            $query->where('ten_vai_tro', 'lecturer');
        })->where('trang_thai', true)->get();

        return view('pages.lich-hoc-mon-hoc.edit', compact('lichHoc', 'monHocs', 'giangViens'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mon_hoc_id' => 'required|exists:mon_hoc,id',
            'ma_lop' => 'required|string|max:20',
            'phong_hoc' => 'required|string|max:50',
            'thu' => 'required|string|max:10',
            'tiet_bat_dau' => 'required|string|max:10',
            'tiet_ket_thuc' => 'required|string|max:10',
            'giang_vien_id' => 'required|exists:nguoi_dung,id',
            'so_luong_sv_toi_da' => 'required|integer|min:1',
        ]);

        $lichHoc = LichHocMonHoc::findOrFail($id);
        
        $giangVien = User::find($request->giang_vien_id);

        $lichHoc->update([
            'mon_hoc_id' => $request->mon_hoc_id,
            'ma_lop' => $request->ma_lop,
            'phong_hoc' => $request->phong_hoc,
            'thu' => $request->thu,
            'tiet_bat_dau' => $request->tiet_bat_dau,
            'tiet_ket_thuc' => $request->tiet_ket_thuc,
            'giang_vien_id' => $request->giang_vien_id,
            'giang_vien' => $giangVien->ten,
            'so_luong_sv_toi_da' => $request->so_luong_sv_toi_da,
        ]);

        return redirect()->route('lich-hoc-mon-hoc.index')->with('success', 'Cập nhật lịch học thành công.');
    }

    public function destroy($id)
    {
        $lichHoc = LichHocMonHoc::findOrFail($id);
        $lichHoc->delete();

        return redirect()->route('lich-hoc-mon-hoc.index')->with('success', 'Xóa lịch học thành công.');
    }

    public function lecturerSchedule()
    {
        $lichHocMonHoc = LichHocMonHoc::where('giang_vien_id', auth()->id())
            ->with(['monHoc'])
            ->orderBy('thu')
            ->orderBy('tiet_bat_dau')
            ->get();

        return view('pages.lich-hoc-mon-hoc.lecturer-schedule', compact('lichHocMonHoc'));
    }
} 