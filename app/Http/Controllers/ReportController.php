<?php
namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Device;  // Giả sử bạn có model này
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Hiển thị danh sách báo cáo
    public function index()
    {
        // Lấy tất cả báo cáo cùng với thiết bị liên quan
        $baoCaos = Report::with('thietBi')->get();

        // Trả về view với dữ liệu
        return view('pages.report.index', compact('baoCaos'));
    }

    // Hiển thị form tạo báo cáo
    public function create()
    {
        // Lấy danh sách thiết bị để chọn khi tạo báo cáo
        $thietBis = Device::all();
        return view('pages.report.createReport', compact('thietBis'));
    }

    // Xử lý lưu báo cáo
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'thiet_bi_id' => 'required|exists:thiet_bi_pccc,id',
            'ngay_bao_cao' => 'required|date',
            'chi_tiet_bao_cao' => 'required|string',
        ]);

        // Tạo báo cáo mới
        Report::create($request->all());

        // Redirect về trang danh sách báo cáo
        return redirect()->route('baocao.index')->with('success', 'Báo cáo đã được tạo thành công!');
    }
}
