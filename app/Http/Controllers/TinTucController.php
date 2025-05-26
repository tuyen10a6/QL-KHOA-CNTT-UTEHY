<?php

namespace App\Http\Controllers;

use App\Models\TinTuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TinTucController extends Controller
{
    public function index()
    {
        $tinTuc = TinTuc::with('nguoiDang')->orderBy('created_at', 'desc')->get();
        return view('pages.tin-tuc.index', compact('tinTuc'));
    }

    public function create()
    {
        return view('pages.tin-tuc.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'trang_thai' => 'required|boolean'
        ]);

        $data = $request->all();
        $data['nguoi_dang_id'] = auth()->id();

        if ($request->hasFile('anh_dai_dien')) {
            $path = $request->file('anh_dai_dien')->store('public/tin-tuc');
            $data['anh_dai_dien'] = str_replace('public/', '', $path);
        }

        TinTuc::create($data);

        return redirect()->route('tin-tuc.index')->with('success', 'Thêm tin tức thành công.');
    }

    public function edit($id)
    {
        $tinTuc = TinTuc::findOrFail($id);
        return view('pages.tin-tuc.edit', compact('tinTuc'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'trang_thai' => 'required|boolean'
        ]);

        $tinTuc = TinTuc::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('anh_dai_dien')) {
            // Xóa ảnh cũ nếu có
            if ($tinTuc->anh_dai_dien) {
                Storage::delete('public/' . $tinTuc->anh_dai_dien);
            }
            $path = $request->file('anh_dai_dien')->store('public/tin-tuc');
            $data['anh_dai_dien'] = str_replace('public/', '', $path);
        }

        $tinTuc->update($data);

        return redirect()->route('tin-tuc.index')->with('success', 'Cập nhật tin tức thành công.');
    }

    public function destroy($id)
    {
        $tinTuc = TinTuc::findOrFail($id);
        
        // Xóa ảnh nếu có
        if ($tinTuc->anh_dai_dien) {
            Storage::delete('public/' . $tinTuc->anh_dai_dien);
        }
        
        $tinTuc->delete();

        return redirect()->route('tin-tuc.index')->with('success', 'Xóa tin tức thành công.');
    }

    public function show($id)
    {
        $tinTuc = TinTuc::with('nguoiDang')->findOrFail($id);
        return view('pages.tin-tuc.detail', compact('tinTuc'));
    }
} 