@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-8 grid-margin stretch-card mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title">Tạo Người Dùng Mới</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('nguoi-dung.store') }}" class="pt-3">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ten">Họ và tên</label>
                                        <input type="text" class="form-control border-0 shadow-sm" id="ten" name="ten" required placeholder="Nhập họ và tên">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control border-0 shadow-sm" id="email" name="email" required placeholder="Nhập địa chỉ email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ten_dang_nhap">Tên đăng nhập</label>
                                        <input type="text" class="form-control border-0 shadow-sm" id="ten_dang_nhap" name="ten_dang_nhap" required placeholder="Nhập tên đăng nhập">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="so_dien_thoai">Số điện thoại</label>
                                        <input type="tel" class="form-control border-0 shadow-sm" id="so_dien_thoai" name="so_dien_thoai" placeholder="Nhập số điện thoại">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ngay_sinh">Ngày sinh</label>
                                        <input type="date" class="form-control border-0 shadow-sm" id="ngay_sinh" name="ngay_sinh">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gioi_tinh">Giới tính</label>
                                        <select class="form-control border-0 shadow-sm" id="gioi_tinh" name="gioi_tinh">
                                            <option value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                            <option value="Khác">Khác</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dia_chi">Địa chỉ</label>
                                        <input type="text" class="form-control border-0 shadow-sm" id="dia_chi" name="dia_chi" placeholder="Nhập địa chỉ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vai_tro_id">Vai trò</label>
                                        <select class="form-control border-0 shadow-sm" id="vai_tro_id" name="vai_tro_id" required>
                                            <option value="">Chọn vai trò</option>
                                            @foreach($vaiTroList as $vaiTro)
                                                <option value="{{ $vaiTro->id }}">{{ $vaiTro->ten_vai_tro }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="khoa_id">Khoa</label>
                                    <select class="form-control border-0 shadow-sm" id="khoa_id" name="khoa_id">
                                        <option value="">Chọn khoa</option>
                                        @foreach($khoaList as $khoa)
                                            <option value="{{ $khoa->id }}">{{ $khoa->ten_khoa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ghi_chu">Ghi chú</label>
                                <textarea class="form-control border-0 shadow-sm" id="ghi_chu" name="ghi_chu" rows="3" placeholder="Nhập ghi chú (nếu có)"></textarea>
                            </div>

                            <!-- Thông báo mật khẩu mặc định -->
                            <div class="alert alert-info">
                                <i class="mdi mdi-information-outline"></i> Mật khẩu mặc định sẽ là <strong>12345678</strong>.
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                    <i class="mdi mdi-account-plus"></i> Tạo Người Dùng
                                </button>
                                <a href="{{ route('danh-sach-nguoi-dung') }}" class="btn btn-secondary btn-lg shadow-sm">
                                    <i class="mdi mdi-arrow-left"></i> Quay lại
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
