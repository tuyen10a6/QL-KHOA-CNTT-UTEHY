<?php

namespace App\Http\Controllers;

use App\Models\ChuyenNganh;
use App\Models\GiangVienMonHoc;
use App\Models\MonHoc;
use App\Models\Khoa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MonHocController extends Controller
{
    public function index()
    {
        $monHocList = MonHoc::with('khoa')->get();
        return view('pages.monhoc.index', compact('monHocList'));
    }

    public function create()
    {
        $khoaList = Khoa::where('trang_thai', true)->get();
        $giaoViens = User::query()->where('vai_tro_id', '3')->get();
        $chuyenNganhs = ChuyenNganh::query()->get();

        return view('pages.monhoc.create', compact('khoaList', 'giaoViens', 'chuyenNganhs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ma_mon_hoc'        => 'required|string|max:20|unique:mon_hoc',
            'ten_mon_hoc'       => 'required|string|max:100',
            'tin_chi'           => 'required|integer|min:0',
            'document'          => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'khoa_id'           => 'required|exists:khoa,id',
            'trang_thai'        => 'required|boolean',
            'loai_mon'          => 'required|string|max:255',
            'so_tiet_ly_thuyet' => 'required|integer|min:0',
            'so_tiet_thuc_hanh' => 'required|integer|min:0',
            'so_tiet_tu_hoc'    => 'required|integer|min:0',
            'ghi_chu'           => 'nullable|string',
            'chuyen_nganh_id'   => 'required|exists:chuyen_nganh,id',
        ], [
            'ma_mon_hoc.required'        => 'Vui lòng nhập mã môn học.',
            'ma_mon_hoc.unique'          => 'Mã môn học đã tồn tại.',
            'ten_mon_hoc.required'       => 'Vui lòng nhập tên môn học.',
            'tin_chi.required'           => 'Vui lòng nhập số tín chỉ.',
            'tin_chi.integer'            => 'Tín chỉ phải là số.',
            'document.mimes'             => 'Tệp tài liệu phải có định dạng: pdf, doc, docx.',
            'khoa_id.required'           => 'Vui lòng chọn khoa.',
            'khoa_id.exists'             => 'Khoa không hợp lệ.',
            'trang_thai.required'        => 'Vui lòng chọn trạng thái.',
            'trang_thai.boolean'         => 'Trạng thái không hợp lệ.',
            'loai_mon.required'          => 'Vui lòng nhập loại môn.',
            'so_tiet_ly_thuyet.required' => 'Vui lòng nhập số tiết lý thuyết.',
            'so_tiet_thuc_hanh.required' => 'Vui lòng nhập số tiết thực hành.',
            'so_tiet_tu_hoc.required'    => 'Vui lòng nhập số tiết tự học.',
            'chuyen_nganh_id.required'   => 'Vui lòng chọn chuyên ngành.',
            'chuyen_nganh_id.exists'     => 'Chuyên ngành không hợp lệ.',
        ]);

        $data = $request->except('document');

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/documents', $fileName);
            $data['document'] = 'documents/' . $fileName;
        }
        unset($data['giao_viens']);

        $monHoc = MonHoc::query()->create($data);

        if ($request->has('giao_viens')) {
            $teachers = $request->get('giao_viens');
            foreach ($teachers as $teacher) {
                GiangVienMonHoc::query()->create([
                    'mon_hoc_id'    => $monHoc->id,
                    'giang_vien_id' => $teacher
                ]);
            }
        }

        return redirect()->route('chuyen-nganh.show', $request->get('chuyen_nganh_id'))
                         ->with('success', 'Thêm môn học thành công.');
    }


    public function edit($id)
    {
        $monHoc = MonHoc::findOrFail($id);
        $khoaList = Khoa::where('trang_thai', true)->get();
        return view('pages.monhoc.edit', compact('monHoc', 'khoaList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ma_mon_hoc'  => 'required|string|max:20|unique:mon_hoc,ma_mon_hoc,' . $id,
            'ten_mon_hoc' => 'required|string|max:100',
            'khoa_id'     => 'required|exists:khoa,id',
            'trang_thai'  => 'required|boolean',
            'document'    => 'nullable|file|mimes:pdf,doc,docx|max:10240'
        ]);

        $monHoc = MonHoc::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('document')) {
            // Delete old document if exists
            if ($monHoc->document) {
                Storage::delete('public/' . $monHoc->document);
            }

            $file = $request->file('document');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/documents', $fileName);
            $data['document'] = 'documents/' . $fileName;
        }

        $monHoc->update($data);

        return redirect()->route('danh-sach-mon-hoc')
                         ->with('success', 'Cập nhật môn học thành công.');
    }

    public function destroy($id)
    {
        $monHoc = MonHoc::findOrFail($id);
        $monHoc->delete();

        return redirect()->route('danh-sach-mon-hoc')->with('success', 'Xóa môn học thành công.');
    }

    public function show($id)
    {
        $monHoc = MonHoc::with(['khoa', 'chuyenNganh', 'giangViens'])->findOrFail($id);

        return view('pages/monhoc/show', compact('monHoc'));
    }
}
