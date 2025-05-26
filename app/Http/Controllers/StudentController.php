<?php

namespace App\Http\Controllers;

use App\Models\DangKyMonHoc;
use App\Models\Diem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();


        // Lấy danh sách môn học đã đăng ký của sinh viên
        $dangKyMonHoc = DangKyMonHoc::query()->where('ma_sinh_vien', $user->id)
            ->with(['monHoc', 'lichHoc'])
            ->get();

        // Lấy điểm của sinh viên
        $diem = Diem::where('ma_sinh_vien', $user->ma_nguoi_dung)
            ->with('monHoc')
            ->get();

        return view('pages.student.dashboard', compact('dangKyMonHoc', 'diem'));
    }
}
