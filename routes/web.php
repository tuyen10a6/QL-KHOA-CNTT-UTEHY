<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaintenanceScheduleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\DangKyMonHocController;
use App\Http\Controllers\LichHocMonHocController;
use App\Http\Controllers\DiemController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TinTucController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard.index');
})->name('home')->middleware('auth');


Route::get('/dang-ky', [AuthController::class, 'showRegistrationForm'])->name('dang-ky');
Route::post('/dang-ky', [AuthController::class, 'register']);
Route::get('/dang-nhap', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'login']);
Route::get('/quen-mat-khau', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/quen-mat-khau', [AuthController::class, 'handleForgotPassword'])->name('forgot-password.post');
Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('dang-xuat')->middleware('auth');

Route::middleware(['role:admin'])->group(function () {
    Route::get('/danh-sach-nguoi-dung', [UserController::class, 'index'])->name('danh-sach-nguoi-dung-role-admin')->middleware('auth');
    Route::get('/nguoi-dung-chi-tiet/{id}', [UserController::class, 'showDetailUser'])->name('nguoi-dung-chi-tiet.profile.role.admin')->middleware('auth');
    Route::get('/danh-sach-nguoi-dung/sua/{id}', [UserController::class, 'edit'])->middleware('auth');
    Route::post('/danh-sach-nguoi-dung/sua/{id}', [UserController::class, 'update'])->middleware('auth');
    Route::get('/find-user-by-email', [UserController::class, 'findUserByEmail'])->middleware('auth');
    Route::get('/danh-sach-nguoi-dung/permissions/{id}', [UserController::class, 'showUserPermissions'])->name('assignUserPermissionsForm');
    Route::post('/danh-sach-nguoi-dung/permissions/{id}', [UserController::class, 'assignUserPermissions'])->name('assignUserPermissions');
    Route::get('/thong-ke', [ReportController::class, 'statistics'])->name('thong-ke');
});

Route::middleware(['role:subAdmin'])->group(function () {
    Route::get('/quan-ly-thiet-bi', [DeviceController::class, 'manage'])->name('quan-ly-thiet-bi');
    Route::get('/quan-ly-nguoi-dung', [UserController::class, 'manage'])->name('quan-ly-nguoi-dung');
});

Route::middleware(['role:lecturer'])->group(function () {
    Route::get('/danh-sach-sinh-vien', [UserController::class, 'studentList'])->name('danh-sach-sinh-vien');
    Route::get('/quan-ly-lop-hoc', [UserController::class, 'classManagement'])->name('quan-ly-lop-hoc');
});

Route::middleware(['role:student'])->group(function () {
    Route::get('/thong-tin-ca-nhan', [UserController::class, 'profile'])->name('thong-tin-ca-nhan');
    Route::put('/thong-tin-ca-nhan', [UserController::class, 'updateProfile'])->name('thong-tin-ca-nhan.update.student');
    // Route::get('/lich-hoc', [UserController::class, 'schedule'])->name('lich-hoc');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/danh-sach-nguoi-dung/them', [UserController::class, 'create'])->name('nguoi-dung.create');
    Route::post('/danh-sach-nguoi-dung/them', [UserController::class, 'store'])->name('nguoi-dung.store');
    Route::post('/danh-sach-nguoi-dung/xoa/{id}', [UserController::class, 'destroy']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tin-tuc/{id}/xem', [TinTucController::class, 'show'])->name('tin-tuc.view');
});

Route::get('/danh-sach-thiet-bi', [DeviceController::class, 'index'])->name('danh-sach-thiet-bi')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/thiet-bi/them', [DeviceController::class, 'create'])->name('thiet-bi.create');
    Route::post('/thiet-bi/them', [DeviceController::class, 'store'])->name('thiet-bi.store');
    Route::get('/thiet-bi-pccc/sua/{id}', [DeviceController::class, 'edit'])->name('thiet-bi.edit');
    Route::put('/thiet-bi-pccc/sua/{id}', [DeviceController::class, 'update'])->name('thiet-bi.update');
    Route::delete('/thiet-bi-pccc/xoa/{id}', [DeviceController::class, 'destroy'])->name('thiet-bi.destroy');
});

Route::get('/lich-kiem-tra', [MaintenanceScheduleController::class, 'index'])->name('lich-kiem-tra')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/lich-kiem-tra/create', [MaintenanceScheduleController::class, 'create'])->name('lich-kiem-tra.create');
    Route::post('/lich-kiem-tra', [MaintenanceScheduleController::class, 'store'])->name('lich-kiem-tra.store');
    Route::get('/lich-kiem-tra/{id}/edit', [MaintenanceScheduleController::class, 'edit'])->name('lich-kiem-tra.edit');
    Route::post('/lich-kiem-tra/{id}', [MaintenanceScheduleController::class, 'update'])->name('lich-kiem-tra.update');
    Route::delete('/lich-kiem-tra/{id}', [MaintenanceScheduleController::class, 'destroy'])->name('lich-kiem-tra.destroy');
});

Route::get('/thong-bao', [NotificationController::class, 'showNotifications'])->name('thongbao.index')->middleware('auth');
Route::get('/thong-bao/{id}/xem', [NotificationController::class, 'show'])->name('thongbao.view')->middleware('auth');
Route::get('/thong-bao/{id}/xem-dang-ky', [NotificationController::class, 'showRegistrationDetail'])->name('thongbao.registration-detail')->middleware('auth');
Route::post('/thong-bao/mark-as-read', [NotificationController::class, 'markNotificationsAsRead'])->name('thong-bao.markAsRead');
Route::middleware(['auth'])->group(function () {
    Route::get('/thong-bao/create', [NotificationController::class, 'create'])->name('thongbao.create');
    Route::post('/thong-bao/send', [NotificationController::class, 'sendEmergencyAlert'])->name('thongbao.send');
});

Route::get('/bao-cao', [ReportController::class, 'index'])->name('baocao.index')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/bao-cao/create', [ReportController::class, 'create'])->name('baocao.create');
    Route::post('/bao-cao', [ReportController::class, 'store'])->name('baocao.store');
});

// Routes cho quản lý khoa
Route::middleware(['auth'])->group(function () {
    Route::get('/danh-sach-khoa', [KhoaController::class, 'index'])->name('danh-sach-khoa');
    Route::get('/khoa/them', [KhoaController::class, 'create'])->name('khoa.create');
    Route::post('/khoa/them', [KhoaController::class, 'store'])->name('khoa.store');
    Route::get('/khoa/sua/{id}', [KhoaController::class, 'edit'])->name('khoa.edit');
    Route::put('/khoa/sua/{id}', [KhoaController::class, 'update'])->name('khoa.update');
    Route::delete('/khoa/xoa/{id}', [KhoaController::class, 'destroy'])->name('khoa.destroy');
});

// Routes cho quản lý môn học
Route::middleware(['auth'])->group(function () {
    Route::get('/danh-sach-mon-hoc', [MonHocController::class, 'index'])->name('danh-sach-mon-hoc');
    Route::get('/mon-hoc/them', [MonHocController::class, 'create'])->name('monhoc.create');
    Route::post('/mon-hoc/them', [MonHocController::class, 'store'])->name('monhoc.store');
    Route::get('/mon-hoc/{id}', [MonHocController::class, 'show'])->name('monhoc.show');
    Route::get('/mon-hoc/sua/{id}', [MonHocController::class, 'edit'])->name('monhoc.edit');
    Route::put('/mon-hoc/sua/{id}', [MonHocController::class, 'update'])->name('monhoc.update');
    Route::delete('/mon-hoc/xoa/{id}', [MonHocController::class, 'destroy'])->name('monhoc.destroy');
});

// Route đăng ký môn học
Route::middleware(['auth'])->group(function () {
    Route::get('/dang-ky-mon-hoc/lich-hoc', [DangKyMonHocController::class, 'lichHoc'])->name('dang-ky-mon-hoc.lich-hoc');
    Route::get('/dang-ky-mon-hoc', [DangKyMonHocController::class, 'index'])->name('dang-ky-mon-hoc.index');
    Route::get('/dang-ky-mon-hoc/create', [DangKyMonHocController::class, 'create'])->name('dang-ky-mon-hoc.create');
    Route::post('/dang-ky-mon-hoc', [DangKyMonHocController::class, 'store'])->name('dang-ky-mon-hoc.store');
    Route::get('/dang-ky-mon-hoc/{id}', [DangKyMonHocController::class, 'show'])->name('dang-ky-mon-hoc.show');
    Route::get('/dang-ky-mon-hoc/{id}/edit', [DangKyMonHocController::class, 'edit'])->name('dang-ky-mon-hoc.edit');
    Route::put('/dang-ky-mon-hoc/{id}', [DangKyMonHocController::class, 'update'])->name('dang-ky-mon-hoc.update');
    Route::delete('/dang-ky-mon-hoc/{id}', [DangKyMonHocController::class, 'destroy'])->name('dang-ky-mon-hoc.destroy');
});

// Quản lý lịch học môn học
Route::middleware(['auth'])->group(function () {
    Route::get('/lich-hoc-mon-hoc', [LichHocMonHocController::class, 'index'])->name('lich-hoc-mon-hoc.index');
    Route::get('/lich-hoc-mon-hoc/create', [LichHocMonHocController::class, 'create'])->name('lich-hoc-mon-hoc.create');
    Route::post('/lich-hoc-mon-hoc', [LichHocMonHocController::class, 'store'])->name('lich-hoc-mon-hoc.store');
    Route::get('/lich-hoc-mon-hoc/{id}/edit', [LichHocMonHocController::class, 'edit'])->name('lich-hoc-mon-hoc.edit');
    Route::put('/lich-hoc-mon-hoc/{id}', [LichHocMonHocController::class, 'update'])->name('lich-hoc-mon-hoc.update');
    Route::delete('/lich-hoc-mon-hoc/{id}', [LichHocMonHocController::class, 'destroy'])->name('lich-hoc-mon-hoc.destroy');
});

// Quản lý điểm
Route::middleware(['auth'])->group(function () {
    // Route chung cho cả giảng viên và sinh viên
    Route::get('/diem', [DiemController::class, 'index'])->name('diem.index');

    // Route chỉ dành cho giảng viên
    Route::middleware(['role:lecturer'])->group(function () {
        Route::get('/diem/create/{dangKyMonHocId}', [DiemController::class, 'create'])->name('diem.create');
        Route::post('/diem/{dangKyMonHocId}', [DiemController::class, 'store'])->name('diem.store');
        Route::get('/diem/{id}/edit', [DiemController::class, 'edit'])->name('diem.edit');
        Route::put('/diem/{id}', [DiemController::class, 'update'])->name('diem.update');
    });

    // Route mới dành cho sinh viên xem điểm
    Route::middleware(['role:student'])->group(function () {
        Route::get('/xem-diem', [DiemController::class, 'studentView'])->name('diem.student');
    });

    Route::middleware(['role:student'])->group(function () {
        Route::get('/chuyen-nganh/{id}', [\App\Http\Controllers\ChuyenNganhController::class, 'chuyenNganhByNganh'])->name('student.chuyen-nganh.by.nganh');
        Route::get('/mon-hoc-by-chuyen-nganh/{id}', [\App\Http\Controllers\ChuyenNganhController::class, 'showMonHocByChuyenNganh'])->name('student.chuyen-nganh-by-mon-hoc');
    });
});


// Routes cho admin và lecturer
Route::prefix('admin')->middleware(['auth', 'role:admin,lecturer'])->group(function () {
    // Quản lý người dùng
    Route::get('/danh-sach-nguoi-dung', [UserController::class, 'index'])->name('danh-sach-nguoi-dung');
    Route::get('/nguoi-dung-chi-tiet/{id}', [UserController::class, 'showDetailUser'])->name('nguoi-dung-chi-tiet.profile');
    Route::get('/danh-sach-nguoi-dung/sua/{id}', [UserController::class, 'edit']);
    Route::post('/danh-sach-nguoi-dung/sua/{id}', [UserController::class, 'update']);
    Route::get('/find-user-by-email', [UserController::class, 'findUserByEmail']);
    Route::get('/danh-sach-nguoi-dung/them', [UserController::class, 'create'])->name('nguoi-dung.create.role.admin');
    Route::post('/danh-sach-nguoi-dung/them', [UserController::class, 'store'])->name('nguoi-dung.store.role.admin');
    Route::post('/danh-sach-nguoi-dung/xoa/{id}', [UserController::class, 'destroy']);

    // Quản lý thiết bị
    Route::get('/danh-sach-thiet-bi', [DeviceController::class, 'index'])->name('danh-sach-thiet-bi.role.admin');
    Route::get('/thiet-bi/them', [DeviceController::class, 'create'])->name('thiet-bi.create.role.admin2');
    Route::post('/thiet-bi/them', [DeviceController::class, 'store'])->name('thiet-bi.store.role.admin2');
    Route::get('/thiet-bi-pccc/sua/{id}', [DeviceController::class, 'edit'])->name('thiet-bi.edit');
    Route::put('/thiet-bi-pccc/sua/{id}', [DeviceController::class, 'update'])->name('thiet-bi.update');
    Route::delete('/thiet-bi-pccc/xoa/{id}', [DeviceController::class, 'destroy'])->name('thiet-bi.destroy');

    // Quản lý lịch kiểm tra
    Route::get('/lich-kiem-tra', [MaintenanceScheduleController::class, 'index'])->name('lich-kiem-tra.role.admin');
    Route::get('/lich-kiem-tra/create', [MaintenanceScheduleController::class, 'create'])->name('lich-kiem-tra.create.role.admin');
    Route::post('/lich-kiem-tra', [MaintenanceScheduleController::class, 'store'])->name('lich-kiem-tra.store.role.admin');
    Route::get('/lich-kiem-tra/{id}/edit', [MaintenanceScheduleController::class, 'edit'])->name('lich-kiem-tra.edit.role.admin');
    Route::post('/lich-kiem-tra/{id}', [MaintenanceScheduleController::class, 'update'])->name('lich-kiem-tra.update.role.admin');
    Route::delete('/lich-kiem-tra/{id}', [MaintenanceScheduleController::class, 'destroy'])->name('lich-kiem-tra.destroy.role.admin');

    // Quản lý thông báo
    Route::get('/thong-bao', [NotificationController::class, 'showNotifications'])->name('thongbao.index');
    Route::post('/thong-bao/mark-as-read', [NotificationController::class, 'markNotificationsAsRead'])->name('thong-bao.markAsRead');
    Route::get('/thong-bao/create', [NotificationController::class, 'create'])->name('thongbao.create');
    Route::post('/thong-bao/send', [NotificationController::class, 'sendEmergencyAlert'])->name('thongbao.send');

    // Quản lý báo cáo
    Route::get('/bao-cao', [ReportController::class, 'index'])->name('baocao.index.role.admin');
    Route::get('/bao-cao/create', [ReportController::class, 'create'])->name('baocao.create.role.admin');
    Route::post('/bao-cao', [ReportController::class, 'store'])->name('baocao.store.role.admin');

    // Quản lý khoa
    Route::get('/danh-sach-khoa', [KhoaController::class, 'index'])->name('danh-sach-khoa.role.admin');
    Route::get('/khoa/them', [KhoaController::class, 'create'])->name('khoa.create.role.admin');
    Route::post('/khoa/them', [KhoaController::class, 'store'])->name('khoa.store.role.admin');
    Route::get('/khoa/sua/{id}', [KhoaController::class, 'edit'])->name('khoa.edit.role.admin');
    Route::put('/khoa/sua/{id}', [KhoaController::class, 'update'])->name('khoa.update.role.admin');
    Route::delete('/khoa/xoa/{id}', [KhoaController::class, 'destroy'])->name('khoa.destroy.role.admin');

    // Quản lý môn học
    Route::get('/danh-sach-mon-hoc', [MonHocController::class, 'index'])->name('danh-sach-mon-hoc.role.admin');
    Route::get('/mon-hoc/them', [MonHocController::class, 'create'])->name('monhoc.create.role.admin');
    Route::post('/mon-hoc/them', [MonHocController::class, 'store'])->name('monhoc.store.role.admin');
    Route::get('/mon-hoc/{id}', [MonHocController::class, 'show'])->name('monhoc.show.role.admin');
    Route::get('/mon-hoc/sua/{id}', [MonHocController::class, 'edit'])->name('monhoc.edit.role.admin');
    Route::put('/mon-hoc/sua/{id}', [MonHocController::class, 'update'])->name('monhoc.update.role.admin');
    Route::delete('/mon-hoc/xoa/{id}', [MonHocController::class, 'destroy'])->name('monhoc.destroy.role.admin');

    // Quản lý lịch học môn học
    Route::get('/lich-hoc-mon-hoc', [LichHocMonHocController::class, 'index'])->name('lich-hoc-mon-hoc.index.role.admin');
    Route::get('/lich-hoc-mon-hoc/create', [LichHocMonHocController::class, 'create'])->name('lich-hoc-mon-hoc.create.role.admin');
    Route::post('/lich-hoc-mon-hoc', [LichHocMonHocController::class, 'store'])->name('lich-hoc-mon-hoc.store.role.admin');
    Route::get('/lich-hoc-mon-hoc/{id}/edit', [LichHocMonHocController::class, 'edit'])->name('lich-hoc-mon-hoc.edit.role.admin');
    Route::put('/lich-hoc-mon-hoc/{id}', [LichHocMonHocController::class, 'update'])->name('lich-hoc-mon-hoc.update.role.admin');
    Route::delete('/lich-hoc-mon-hoc/{id}', [LichHocMonHocController::class, 'destroy'])->name('lich-hoc-mon-hoc.destroy.role.admin');

    // Quản lý điểm
    Route::get('/diem', [DiemController::class, 'index'])->name('diem.index.role.admin');
    Route::get('/diem/create/{dangKyMonHocId}', [DiemController::class, 'create'])->name('diem.create.role.admin');
    Route::post('/diem/{dangKyMonHocId}', [DiemController::class, 'store'])->name('diem.store.role.admin');
    Route::get('/diem/{id}/edit', [DiemController::class, 'edit'])->name('diem.edit.role.admin');
    Route::put('/diem/{id}', [DiemController::class, 'update'])->name('diem.update.role.admin');

    // Routes cho chức năng xem lịch giảng dạy của giảng viên
    Route::get('/lich-giang-day', [LichHocMonHocController::class, 'lecturerSchedule'])->name('lecturer.schedule');
});

// Routes chỉ dành cho admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    // Quản lý thiết bị
    Route::get('/danh-sach-thiet-bi', [DeviceController::class, 'index'])->name('danh-sach-thiet-bi.role.admin2');
    Route::get('/thiet-bi/them', [DeviceController::class, 'create'])->name('thiet-bi.create.role.admin');
    Route::post('/thiet-bi/them', [DeviceController::class, 'store'])->name('thiet-bi.store.role.admin');
    Route::get('/thiet-bi-pccc/sua/{id}', [DeviceController::class, 'edit'])->name('thiet-bi.edit.role.admin');
    Route::put('/thiet-bi-pccc/sua/{id}', [DeviceController::class, 'update'])->name('thiet-bi.update.role.admin');
    Route::delete('/thiet-bi-pccc/xoa/{id}', [DeviceController::class, 'destroy'])->name('thiet-bi.destroy.role.admin');

    // Quản lý lịch kiểm tra
    Route::get('/lich-kiem-tra', [MaintenanceScheduleController::class, 'index'])->name('lich-kiem-tra.role.admin2');
    Route::get('/lich-kiem-tra/create', [MaintenanceScheduleController::class, 'create'])->name('lich-kiem-tra.create.role.admin2');
    Route::post('/lich-kiem-tra', [MaintenanceScheduleController::class, 'store'])->name('lich-kiem-tra.store.role.admin2');
    Route::get('/lich-kiem-tra/{id}/edit', [MaintenanceScheduleController::class, 'edit'])->name('lich-kiem-tra.edit.role.admin2');
    Route::post('/lich-kiem-tra/{id}', [MaintenanceScheduleController::class, 'update'])->name('lich-kiem-tra.update.role.admin2');
    Route::delete('/lich-kiem-tra/{id}', [MaintenanceScheduleController::class, 'destroy'])->name('lich-kiem-tra.destroy.role.admin2');

    // Quản lý thông báo
    Route::get('/thong-bao', [NotificationController::class, 'showNotifications'])->name('thongbao.index.role.admin');
    Route::post('/thong-bao/mark-as-read', [NotificationController::class, 'markNotificationsAsRead'])->name('thong-bao.markAsRead.role.admin');
    Route::get('/thong-bao/create', [NotificationController::class, 'create'])->name('thongbao.create.role.admin');
    Route::post('/thong-bao/send', [NotificationController::class, 'sendEmergencyAlert'])->name('thongbao.send.role.admin');

    // Quản lý báo cáo
    Route::get('/bao-cao', [ReportController::class, 'index'])->name('baocao.index.admin.role2');
    Route::get('/bao-cao/create', [ReportController::class, 'create'])->name('baocao.create.admin.role2');
    Route::post('/bao-cao', [ReportController::class, 'store'])->name('baocao.store.admin.role2');

    // Quản lý môn học
    Route::get('/danh-sach-mon-hoc', [MonHocController::class, 'index'])->name('danh-sach-mon-hoc.role.admin2');
    Route::get('/mon-hoc/them', [MonHocController::class, 'create'])->name('monhoc.create.role.admin2');
    Route::post('/mon-hoc/them', [MonHocController::class, 'store'])->name('monhoc.store.role.admin2');
    Route::get('/mon-hoc/{id}', [MonHocController::class, 'show'])->name('monhoc.show.role.admin2');
    Route::get('/mon-hoc/sua/{id}', [MonHocController::class, 'edit'])->name('monhoc.edit.role.admin2');
    Route::put('/mon-hoc/sua/{id}', [MonHocController::class, 'update'])->name('monhoc.update.role.admin2');
    Route::delete('/mon-hoc/xoa/{id}', [MonHocController::class, 'destroy'])->name('monhoc.destroy.role.admin2');

    // News management routes
    Route::get('/tin-tuc', [TinTucController::class, 'index'])->name('tin-tuc.index');
    Route::get('/tin-tuc/them', [TinTucController::class, 'create'])->name('tin-tuc.create');
    Route::post('/tin-tuc', [TinTucController::class, 'store'])->name('tin-tuc.store');
    Route::get('/tin-tuc/{id}/sua', [TinTucController::class, 'edit'])->name('tin-tuc.edit');
    Route::put('/tin-tuc/{id}', [TinTucController::class, 'update'])->name('tin-tuc.update');
    Route::delete('/tin-tuc/{id}', [TinTucController::class, 'destroy'])->name('tin-tuc.destroy');
    Route::get('/tin-tuc/{id}', [TinTucController::class, 'show'])->name('tin-tuc.show');

    Route::prefix('nganh')->group(function () {
        Route::get('index', [\App\Http\Controllers\NganhController::class, 'index'])->name('nganh.index');
        Route::post('store', [\App\Http\Controllers\NganhController::class, 'store'])->name('nganh.store');
        Route::get('edit/{id}', [\App\Http\Controllers\NganhController::class, 'edit'])->name('nganh.edit');
        Route::post('update/{id}', [\App\Http\Controllers\NganhController::class, 'update'])->name('nganh.update');
        Route::post('destroy/{id}', [\App\Http\Controllers\NganhController::class, 'destroy'])->name('nganh.destroy');
    });
    Route::prefix('chuyen-nganh')->group(function () {
        Route::get('index', [\App\Http\Controllers\ChuyenNganhController::class, 'index'])->name('chuyen-nganh.index');
        Route::get('create', [\App\Http\Controllers\ChuyenNganhController::class, 'create'])->name('chuyen-nganh.create');
        Route::get('edit/{id}', [\App\Http\Controllers\ChuyenNganhController::class, 'edit'])->name('chuyen-nganh.edit');
        Route::post('store', [\App\Http\Controllers\ChuyenNganhController::class, 'store'])->name('chuyen-nganh.store');
        Route::post('update/{id}', [\App\Http\Controllers\ChuyenNganhController::class, 'update'])->name('chuyen-nganh.update');
        Route::post('destroy/{id}', [\App\Http\Controllers\ChuyenNganhController::class, 'destroy'])->name('chuyen-nganh.destroy');
        Route::get('show/{id}', [\App\Http\Controllers\ChuyenNganhController::class, 'show'])->name('chuyen-nganh.show');
        Route::get('ctdt', [\App\Http\Controllers\ChuyenNganhController::class, 'ctdt'])->name('chuyen-nganh.ctdt');
        Route::get('print/{id}', [\App\Http\Controllers\ChuyenNganhController::class, 'print'])->name('chuyen-nganh.print');
    });
    Route::prefix('mon-hoc')->group(function () {
        Route::get('show/{id}', [\App\Http\Controllers\MonHocController::class, 'show'])->name('monhoc.show.admin');
    });
});

// Routes cho sinh viên
// Routes cho sinh viên
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/thong-tin-ca-nhan', [UserController::class, 'profile'])->name('thong-tin-ca-nhan');
    Route::get('/thong-tin-ca-nhan/sua', [UserController::class, 'editProfile'])->name('thong-tin-ca-nhan.edit');
    Route::put('/thong-tin-ca-nhan/sua', [UserController::class, 'updateProfile'])->name('thong-tin-ca-nhan.update');
    Route::get('/dang-ky-mon-hoc/lich-hoc', [DangKyMonHocController::class, 'lichHoc'])->name('dang-ky-mon-hoc.lich-hoc');
    Route::get('/dang-ky-mon-hoc', [DangKyMonHocController::class, 'index'])->name('dang-ky-mon-hoc.index');
    Route::get('/dang-ky-mon-hoc/create', [DangKyMonHocController::class, 'create'])->name('dang-ky-mon-hoc.create');
    Route::post('/dang-ky-mon-hoc', [DangKyMonHocController::class, 'store'])->name('dang-ky-mon-hoc.store');
    Route::get('/dang-ky-mon-hoc/{id}', [DangKyMonHocController::class, 'show'])->name('dang-ky-mon-hoc.show');
    Route::get('/dang-ky-mon-hoc/{id}/edit', [DangKyMonHocController::class, 'edit'])->name('dang-ky-mon-hoc.edit');
    Route::put('/dang-ky-mon-hoc/{id}', [DangKyMonHocController::class, 'update'])->name('dang-ky-mon-hoc.update');
    Route::delete('/dang-ky-mon-hoc/{id}', [DangKyMonHocController::class, 'destroy'])->name('dang-ky-mon-hoc.destroy');
    Route::get('/diem', [DiemController::class, 'index'])->name('diem.index');
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

Route::post('/thong-bao/{id}/phe-duyet', [NotificationController::class, 'approveRegistration'])->name('thongbao.approve')->middleware('auth');
Route::post('/thong-bao/{id}/tu-choi', [NotificationController::class, 'rejectRegistration'])->name('thongbao.reject')->middleware('auth');
