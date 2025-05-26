<?php

namespace App\Http\Controllers;

use App\Models\Nganh;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class NganhController
{
    public function index(Request $request)
    {
        $query = Nganh::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $nganhs = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('pages/nganh/index', compact('nganhs'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:nganh,name',
        ]);

        Nganh::query()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('nganh.index')->with('success', 'Thêm ngành thành công!');
    }

    public function edit($id)
    {
        $nganh = Nganh::query()->findOrFail($id);

        return view('pages/nganh/edit', compact('nganh'));
    }

    public function update(Request $request, $id)
    {
        $data = Nganh::query()->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:nganh,name',
        ]);

        $data->update([
            'name' => $request->get('name')
        ]);

        return redirect()->route('nganh.index');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $data = Nganh::query()->findOrFail($id);

        try {
            $data->delete();
            return redirect()->route('nganh.index')->with('success', 'Xóa ngành thành công!');
        } catch (QueryException $e) {
            return redirect()->route('nganh.index')->with('error', 'Không thể xóa ngành vì có dữ liệu liên quan.');
        }
    }
}
