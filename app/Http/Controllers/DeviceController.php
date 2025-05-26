<?php
namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $thietBiList = Device::all();
        return view('pages.device.index', compact('thietBiList'));
    }

    public function create()
    {
        return view('pages.device.createDevice');
    }

    // Xử lý lưu thiết bị vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'ten_thiet_bi' => 'required|string|max:255',
            'nha_cung_cap' => 'required|string|max:255',
            'so_luong' => 'required|integer',
            'vi_tri' => 'required|string|max:255',
            'ngay_lap_dat' => 'required|date|before_or_equal:today',
            'ngay_kiem_tra_gan_nhat' => 'nullable|date',
            'tinh_trang' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'ten_thiet_bi.required' => 'Vui lòng nhập tên thiết bị.',

            'nha_cung_cap.required' => 'Vui lòng nhập nhà cung cấp.',

            'so_luong.required' => 'Vui lòng nhập số lượng.',
            'so_luong.integer' => 'Số lượng phải là một số nguyên.',
            'so_luong.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',

            'vi_tri.required' => 'Vui lòng nhập vị trí lắp đặt.',

            'ngay_lap_dat.required' => 'Vui lòng nhập ngày lắp đặt.',
            'ngay_lap_dat.date' => 'Ngày lắp đặt phải là một ngày hợp lệ.',
            'ngay_lap_dat.before_or_equal' => 'Ngày lắp đặt không được lớn hơn ngày hiện tại.',

            'ngay_kiem_tra_gan_nhat.date' => 'Ngày kiểm tra gần nhất phải là một ngày hợp lệ.',
            'ngay_kiem_tra_gan_nhat.after_or_equal' => 'Ngày kiểm tra gần nhất phải sau hoặc bằng ngày lắp đặt.',

            'tinh_trang.required' => 'Vui lòng nhập tình trạng thiết bị.',

            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, hoặc gif.',
        ]);

        // Khởi tạo biến cho đường dẫn
        $path = public_path('assets/images/Device'); // Đường dẫn lưu ảnh

        // Kiểm tra nếu có file hình ảnh được upload
        if ($request->hasFile('hinh_anh')) {
            // Lấy file và tạo tên file
            $file = $request->file('hinh_anh');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // Di chuyển file đến thư mục đã định nghĩa
            $file->move($path, $fileName);
        } else {
            $fileName = null; // Nếu không có file thì để là null
        }

        // Lưu thiết bị vào cơ sở dữ liệu
        Device::create([
            'ten_thiet_bi' => $request->ten_thiet_bi,
            'nha_cung_cap' => $request->nha_cung_cap,
            'so_luong' => $request->so_luong,
            'vi_tri' => $request->vi_tri,
            'ngay_lap_dat' => $request->ngay_lap_dat,
            'ngay_kiem_tra_gan_nhat' => $request->ngay_kiem_tra_gan_nhat,
            'tinh_trang' => $request->tinh_trang,
            'hinh_anh' => $fileName, // Lưu tên file hình ảnh
        ]);

        return redirect()->route('thiet-bi.create')->with('success', 'Thêm thiết bị thành công!');
    }

    public function edit($id)
    {
        $thietBi = Device::findOrFail($id);
        return view('pages.device.edittingDevice', compact('thietBi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_thiet_bi' => 'required|string|max:255',
            'nha_cung_cap' => 'required|string|max:255',
            'so_luong' => 'required|string|max:255',
            'vi_tri' => 'required|string|max:255',
            'ngay_lap_dat' => 'required|date|before_or_equal:today',
            'ngay_kiem_tra_gan_nhat' => 'nullable|date',
            'tinh_trang' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            // Tùy chỉnh thông báo lỗi cho ngày lắp đặt
            'ngay_lap_dat.before_or_equal' => 'Ngày lắp đặt không được lớn hơn ngày hiện tại.',
            'ngay_lap_dat.required' => 'Vui lòng nhập ngày lắp đặt.',
            'ngay_lap_dat.date' => 'Ngày lắp đặt phải là một ngày hợp lệ.',
        ]);

        $thietBi = Device::findOrFail($id);

        // Xử lý upload hình ảnh nếu có
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $hinhAnh = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/Device'), $hinhAnh); // Thay đổi đường dẫn

            // Xóa ảnh cũ nếu có
            if ($thietBi->hinh_anh && file_exists(public_path('assets/images/Device/' . $thietBi->hinh_anh))) {
                unlink(public_path('assets/images/Device/' . $thietBi->hinh_anh));
            }

            $thietBi->hinh_anh = $hinhAnh; // Cập nhật tên hình ảnh
        }

        // Cập nhật thông tin thiết bị
        $thietBi->update([
            'ten_thiet_bi' => $request->ten_thiet_bi,
            'nha_cung_cap' => $request->nha_cung_cap,
            'so_luong' => $request->so_luong,
            'vi_tri' => $request->vi_tri,
            'ngay_lap_dat' => $request->ngay_lap_dat,
            'ngay_kiem_tra_gan_nhat' => $request->ngay_kiem_tra_gan_nhat,
            'tinh_trang' => $request->tinh_trang,
        ]);

        return redirect()->route('danh-sach-thiet-bi')->with('success', 'Cập nhật thiết bị thành công.');
    }

    public function destroy($id)
    {
        $thietBi = Device::findOrFail($id);
        // Xóa hình ảnh nếu có
        if ($thietBi->hinh_anh && file_exists(public_path('assets/images/Device/' . $thietBi->hinh_anh))) {
            unlink(public_path('assets/images/Device/' . $thietBi->hinh_anh));
        }
        $thietBi->delete();

        return redirect()->route('danh-sach-thiet-bi')->with('success', 'Xóa thiết bị thành công.');
    }
}
