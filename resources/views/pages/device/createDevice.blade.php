@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h2 class="my-4">Thêm Thiết Bị PCCC</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('thiet-bi.store') }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
                @csrf

                <div class="form-group">
                    <label for="ten_thiet_bi">Tên Thiết Bị</label>
                    <input type="text" class="form-control border-0 shadow-sm" id="ten_thiet_bi" name="ten_thiet_bi" required placeholder="Nhập tên thiết bị">
                    @if ($errors->has('ten_thiet_bi'))
                        <div class="alert alert-danger">{{ $errors->first('ten_thiet_bi') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="nha_cung_cap">Nhà Cung Cấp</label>
                    <input type="text" class="form-control border-0 shadow-sm" id="nha_cung_cap" name="nha_cung_cap" required placeholder="Nhập tên nhà cung cấp">
                    @if ($errors->has('nha_cung_cap'))
                        <div class="alert alert-danger">{{ $errors->first('nha_cung_cap') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="so_luong">Số Lượng</label>
                    <input type="number" class="form-control border-0 shadow-sm" id="so_luong" name="so_luong" required placeholder="Nhập số lượng">
                    @if ($errors->has('so_luong'))
                        <div class="alert alert-danger">{{ $errors->first('so_luong') }}</div>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="vi_tri" class="form-label">Vị Trí</label>
                    <input type="text" class="form-control" name="vi_tri" placeholder="Nhập vị trí" required>
                    @if ($errors->has('vi_tri'))
                        <div class="text-danger mt-1">{{ $errors->first('vi_tri') }}</div>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="ngay_lap_dat" class="form-label">Ngày Lắp Đặt</label>
                    <input type="date" class="form-control" name="ngay_lap_dat" placeholder="Nhập ngày lắp đặt" required>
                    @if ($errors->has('ngay_lap_dat'))
                        <div class="text-danger mt-1">{{ $errors->first('ngay_lap_dat') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="ngay_kiem_tra_gan_nhat">Ngày Kiểm Tra Gần Nhất</label>
                    <input type="date" class="form-control border-0 shadow-sm" id="ngay_kiem_tra_gan_nhat" name="ngay_kiem_tra_gan_nhat">
                    @if ($errors->has('ngay_kiem_tra_gan_nhat'))
                        <div class="alert alert-danger">{{ $errors->first('ngay_kiem_tra_gan_nhat') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="tinh_trang">Tình Trạng Thiết Bị</label>
                    <input type="text" class="form-control border-0 shadow-sm" id="tinh_trang" name="tinh_trang" required placeholder="Nhập tình trạng thiết bị">
                    @if ($errors->has('tinh_trang'))
                        <div class="alert alert-danger">{{ $errors->first('tinh_trang') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="hinh_anh">Hình Ảnh Thiết Bị</label>
                    <input type="file" class="form-control border-0 shadow-sm" id="hinh_anh" name="hinh_anh" accept="image/*">
                    @if ($errors->has('hinh_anh'))
                        <div class="alert alert-danger">{{ $errors->first('hinh_anh') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-block shadow-sm">Thêm Thiết Bị</button>
            </form>
        </div>
    </div>
@endsection
