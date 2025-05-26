<?php
namespace App\Http\Controllers;

use App\Models\MaintenanceSchedule;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;

class MaintenanceScheduleController extends Controller
{
    // Hiển thị danh sách lịch kiểm tra
    public function index()
    {
        $lichKiemTras = MaintenanceSchedule::with('thietBi', 'nguoiThucHien')
            ->where('hoat_dong', 'Kiểm tra') // Chỉ lấy những lịch kiểm tra
            ->orderBy('ngay_thuc_hien', 'desc')
            ->get();

        return view('pages.maintenanceSchedule.index', compact('lichKiemTras'));
    }

    // Hiển thị form để tạo lịch kiểm tra
    public function create()
    {
        $thietBis = Device::all(); // Lấy danh sách tất cả thiết bị
        $nguoiDungs = User::all(); // Lấy danh sách tất cả người thực hiện kiểm tra

        return view('pages.maintenanceSchedule.createSchedule', compact('thietBis', 'nguoiDungs'));
    }

    // Lưu lịch kiểm tra
    public function store(Request $request)
    {
        $request->validate([
            'thiet_bi_id' => 'required|exists:thiet_bi_pccc,id',
            'ngay_thuc_hien' => 'required|date',
            'nguoi_thuc_hien_id' => 'required|exists:nguoi_dung,id',
            'ghi_chu' => 'nullable|string',
            'tinh_trang_truoc_khi_kiem_tra' => 'nullable|string',
            'tinh_trang_sau_khi_kiem_tra' => 'nullable|string',
        ]);

        // Tạo bản ghi lịch kiểm tra
        MaintenanceSchedule::create([
            'thiet_bi_id' => $request->thiet_bi_id,
            'hoat_dong' => 'Kiểm tra', // Xác định đây là hoạt động kiểm tra
            'ngay_thuc_hien' => $request->ngay_thuc_hien,
            'nguoi_thuc_hien_id' => $request->nguoi_thuc_hien_id,
            'ghi_chu' => $request->ghi_chu,
            'tinh_trang_truoc_khi_kiem_tra' => $request->tinh_trang_truoc_khi_kiem_tra,
            'tinh_trang_sau_khi_kiem_tra' => $request->tinh_trang_sau_khi_kiem_tra,
        ]);

        return redirect()->route('lich-kiem-tra')->with('success', 'Lịch kiểm tra đã được tạo thành công.');
    }
    public function edit($id)
    {
        $lichKiemTra = MaintenanceSchedule::findOrFail($id);
        $thietBis = Device::all();
        $nguoiDungs = User::all();
        return view('pages.maintenanceSchedule.edittingSchedule', compact('lichKiemTra', 'thietBis', 'nguoiDungs'));
    }

    // Cập nhật dữ liệu lịch kiểm tra
    public function update(Request $request, $id)
    {
        $request->validate([
            'thiet_bi_id' => 'required',
            'ngay_thuc_hien' => 'required|date',
            'nguoi_thuc_hien_id' => 'required',
        ]);

        $lichKiemTra = MaintenanceSchedule::findOrFail($id);
        $lichKiemTra->update($request->all());

        return redirect()->route('lich-kiem-tra')->with('success', 'Lịch kiểm tra đã được cập nhật.');
    }

    // Xóa lịch kiểm tra
    public function destroy($id)
    {
        $lichKiemTra = MaintenanceSchedule::findOrFail($id);
        $lichKiemTra->delete();

        return redirect()->route('lich-kiem-tra')->with('success', 'Lịch kiểm tra đã được xóa.');
    }
}
