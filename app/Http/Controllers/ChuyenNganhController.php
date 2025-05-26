<?php

namespace App\Http\Controllers;

use App\Models\ChuyenNganh;
use App\Models\MonHoc;
use App\Models\Nganh;
use Illuminate\Http\Request;

class ChuyenNganhController
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $nganhId = $request->input('nganh_id');

        $query = ChuyenNganh::with('nganh');

        if ($search) {
            $query->where('ten_chuyen_nganh', 'like', '%' . $search . '%');
        }

        if ($nganhId) {
            $query->where('nganh_id', $nganhId);
        }

        $chuyenNganhs = $query->paginate(10);
        $nganhs = Nganh::all();

        return view('pages/chuyen-nganh/index', compact('chuyenNganhs', 'nganhs', 'search', 'nganhId'));
    }

    public function create()
    {
        $nganhs = Nganh::all();
        return view('pages/chuyen-nganh/create', compact('nganhs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_chuyen_nganh' => 'required|string|max:255',
            'nganh_id'         => 'required|exists:nganh,id',
        ]);

        ChuyenNganh::query()->create($request->only('ten_chuyen_nganh', 'nganh_id', 'chuan_dau_ra'));

        return redirect()->route('chuyen-nganh.index')->with('success', 'Thêm chuyên ngành thành công.');
    }

    public function edit($id)
    {
        $chuyenNganh = ChuyenNganh::query()->findOrFail($id);
        $nganhs = Nganh::all();
        return view('pages/chuyen-nganh/edit', compact('chuyenNganh', 'nganhs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_chuyen_nganh' => 'required|string|max:255',
            'nganh_id'         => 'required|exists:nganh,id',
        ]);

        $chuyenNganh = ChuyenNganh::query()->findOrFail($id);
        $chuyenNganh->update($request->only('ten_chuyen_nganh', 'nganh_id', 'chuan_dau_ra'));

        return redirect()->route('chuyen-nganh.index')->with('success', 'Cập nhật chuyên ngành thành công.');
    }

    public function show($id)
    {
        $chuyenNganh = ChuyenNganh::with('monHoc')->findOrFail($id);

        return view('pages/chuyen-nganh/show', compact('chuyenNganh'));
    }

    public function destroy($id)
    {
        $data = ChuyenNganh::query()->findOrFail($id);

        try {
            $data->delete();
            return redirect()->route('chuyen-nganh.index')->with('success', 'Xóa ngành thành công!');
        }catch (\Exception $e){
            return redirect()->route('chuyen-nganh.index')->with('error', 'Không thể xóa ngành vì có dữ liệu liên quan.');
        }
    }

    public function ctdt()
    {
        $dsChuyenNganh = ChuyenNganh::with('monHoc')->get();

        return view('pages/chuyen-nganh/ctdt', compact('dsChuyenNganh'));
    }

    public function print($id)
    {
        $chuyenNganh = ChuyenNganh::with(['monHoc.giangViens'])->findOrFail($id);
        return view('pages/print/index', compact('chuyenNganh'));
    }

    public function chuyenNganhByNganh($id)
    {
        $chuyenNganhs = ChuyenNganh::with('monHoc')->where('nganh_id', $id)->get();

        $nganhs = Nganh::all();

        return view('pages/chuyen-nganh/student', compact('chuyenNganhs', 'nganhs'));
    }

    public function showMonHocByChuyenNganh($id)
    {
        $monHoc = MonHoc::query()->with('giangViens')->where('chuyen_nganh_id', $id)->get();
        $nganhs = Nganh::all();

        return view('pages/chuyen-nganh/mon_hoc', compact('monHoc', 'nganhs'));
    }
}
