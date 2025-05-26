<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use Illuminate\Http\Request;

class KhoaController extends Controller
{
    public function index()
    {
        $khoaList = Khoa::all();
        return view('pages.khoa.index', compact('khoaList'));
    }

    public function create()
    {
        return view('pages.khoa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_khoa' => 'required|string|max:100',
            'ma_khoa' => 'required|string|max:20|unique:khoa',
            'mo_ta' => 'nullable|string',
        ]);

        Khoa::create([
            'ten_khoa' => $request->ten_khoa,
            'ma_khoa' => $request->ma_khoa,
            'mo_ta' => $request->mo_ta,
            'trang_thai' => true,
        ]);

        return redirect()->route('danh-sach-khoa')->with('success', 'Thêm khoa thành công.');
    }

    public function edit($id)
    {
        $khoa = Khoa::findOrFail($id);
        return view('pages.khoa.edit', compact('khoa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_khoa' => 'required|string|max:100',
            'ma_khoa' => 'required|string|max:20|unique:khoa,ma_khoa,' . $id,
            'mo_ta' => 'nullable|string',
            'trang_thai' => 'boolean',
        ]);

        $khoa = Khoa::findOrFail($id);
        $khoa->update([
            'ten_khoa' => $request->ten_khoa,
            'ma_khoa' => $request->ma_khoa,
            'mo_ta' => $request->mo_ta,
            'trang_thai' => $request->trang_thai ?? true,
        ]);

        return redirect()->route('danh-sach-khoa')->with('success', 'Cập nhật khoa thành công.');
    }

    public function destroy($id)
    {
        $khoa = Khoa::findOrFail($id);
        $khoa->delete();

        return redirect()->route('danh-sach-khoa')->with('success', 'Xóa khoa thành công.');
    }
} 