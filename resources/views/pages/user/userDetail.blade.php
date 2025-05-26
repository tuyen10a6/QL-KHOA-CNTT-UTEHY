@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container mt-5">
            <h2 class="text-center mb-4">Hồ Sơ Người Bảo Trì</h2>

            <div class="card shadow-lg p-4">
                <div class="row d-flex justify-content-center align-items-center">
                    <!-- Avatar và tên người dùng -->
                    <div class="col-md-3 text-center d-flex flex-column justify-content-center align-items-center">
                        @if ($user->avatar)
                            <img src="{{ asset('assets/images/avatars/' . $user->avatar) }}" alt="Avatar" class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; border: 5px solid #007bff;">
                        @else
                            <img src="{{ asset('assets/images/avatars/default.png') }}" alt="Avatar" class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; border: 5px solid #007bff;">
                        @endif
                        <!-- Tên người dùng dưới avatar -->
                        <h3 class="mt-3 font-weight-bold">{{ $user->ten }}</h3>
                    </div>

                    <!-- Thông tin người dùng -->
                    <div class="col-md-3 d-flex flex-column justify-content-center align-items-start">
                        <h3 class="mt-4">Thông Tin Liên Hệ:</h3>
                        <p class="text-muted"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                        <p class="text-muted"><i class="fas fa-user"></i> Tên Đăng Nhập: <strong>{{ $user->ten_dang_nhap }}</strong></p>
                        <p class="text-muted"><i class="fas fa-user-tag"></i> Vai Trò: <strong>{{ $user->vaiTro->ten_vai_tro }}</strong></p>
                        <p class="text-muted"><i class="fas fa-venus-mars"></i> Giới Tính: <strong>{{ $user->gioi_tinh ?? 'Chưa xác định' }}</strong></p>
                        <p class="text-muted"><i class="fas fa-phone"></i> Số Điện Thoại: <strong>{{ $user->sdt ?? 'Chưa cập nhật' }}</strong></p>
                        <p class="text-muted"><i class="fas fa-id-card"></i> CCCD: <strong>{{ $user->cccd ?? 'Chưa cập nhật' }}</strong></p>
                        <p class="text-muted"><i class="fas fa-university"></i> Khoa: <strong>{{ $user->khoa ? $user->khoa->ten_khoa : 'Chưa có khoa' }}</strong></p>

                        <h3 class="mt-4">Thông Tin Khác:</h3>
                        <p class="text-muted"><i class="fas fa-toggle-on"></i> Trạng Thái: <strong>{{ $user->trang_thai ? 'Hoạt động' : 'Ngừng hoạt động' }}</strong></p>
                        <p class="text-muted"><i class="fas fa-calendar-alt"></i> Ngày Tạo: <strong>{{ $user->created_at->format('d/m/Y') }}</strong></p>
                        <p class="text-muted"><i class="fas fa-calendar-day"></i> Ngày Cập Nhật: <strong>{{ $user->updated_at->format('d/m/Y') }}</strong></p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('danh-sach-nguoi-dung') }}" class="btn btn-primary">Quay lại danh sách người dùng</a>
            </div>
        </div>
    </div>

    <!-- Thêm FontAwesome CDN để hiển thị các icon đẹp hơn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
