@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h2>Thêm Thiết Bị PCCC</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('thiet-bi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="ten_thiet_bi">Tên Thiết Bị</label>
                    <input type="text" class="form-control" id="ten_thiet_bi" name="ten_thiet_bi" required>
                </div>

                <div class="form-group">
                    <label for="hinh_anh">Hình Ảnh Thiết Bị</label>
                    <input type="file" class="form-control" id="hinh_anh" name="hinh_anh" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="vi_tri">Vị Trí Lắp Đặt</label>
                    <input type="text" class="form-control" id="vi_tri" name="vi_tri" required>
                </div>

                <div class="form-group">
                    <label for="ngay_lap_dat">Ngày Lắp Đặt</label>
                    <input type="date" class="form-control" id="ngay_lap_dat" name="ngay_lap_dat" required>
                </div>

                <div class="form-group">
                    <label for="ngay_kiem_tra_gan_nhat">Ngày Kiểm Tra Gần Nhất</label>
                    <input type="date" class="form-control" id="ngay_kiem_tra_gan_nhat" name="ngay_kiem_tra_gan_nhat">
                </div>

                <div class="form-group">
                    <label for="tinh_trang">Tình Trạng Thiết Bị</label>
                    <input type="text" class="form-control" id="tinh_trang" name="tinh_trang" required>
                </div>

                <button type="submit" class="btn btn-primary">Thêm Thiết Bị</button>
            </form>
        </div>
    </div>

@endsection
