@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h2 class="my-4">Tạo Lịch Kiểm Tra Định Kỳ</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('lich-kiem-tra.store') }}" method="POST" class="shadow p-4 rounded bg-light">
                @csrf

                <div class="form-group">
                    <label for="thiet_bi_id">Thiết Bị</label>
                    <select class="form-control border-0 shadow-sm" name="thiet_bi_id" id="thiet_bi_id" required>
                        <option value="" disabled selected>Chọn thiết bị</option>
                        @foreach($thietBis as $thietBi)
                            <option value="{{ $thietBi->id }}">{{ $thietBi->ten_thiet_bi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="ngay_thuc_hien">Ngày Thực Hiện</label>
                    <input type="date" class="form-control border-0 shadow-sm" id="ngay_thuc_hien" name="ngay_thuc_hien" required>
                </div>

                <div class="form-group">
                    <label for="nguoi_thuc_hien_id">Người Thực Hiện</label>
                    <select class="form-control border-0 shadow-sm" name="nguoi_thuc_hien_id" id="nguoi_thuc_hien_id" required>
                        <option value="" disabled selected>Chọn người thực hiện</option>
                        @foreach($nguoiDungs as $nguoiDung)
                            <option value="{{ $nguoiDung->id }}">{{ $nguoiDung->ten }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="ghi_chu">Ghi Chú</label>
                    <textarea class="form-control border-0 shadow-sm" id="ghi_chu" name="ghi_chu" rows="3" placeholder="Nhập ghi chú"></textarea>
                </div>

                <div class="form-group">
                    <label for="tinh_trang_truoc_khi_kiem_tra">Tình Trạng Trước Khi Kiểm Tra</label>
                    <input type="text" class="form-control border-0 shadow-sm" id="tinh_trang_truoc_khi_kiem_tra" name="tinh_trang_truoc_khi_kiem_tra" placeholder="Nhập tình trạng trước khi kiểm tra">
                </div>

                <div class="form-group">
                    <label for="tinh_trang_sau_khi_kiem_tra">Tình Trạng Sau Khi Kiểm Tra</label>
                    <input type="text" class="form-control border-0 shadow-sm" id="tinh_trang_sau_khi_kiem_tra" name="tinh_trang_sau_khi_kiem_tra" placeholder="Nhập tình trạng sau khi kiểm tra">
                </div>

                <button type="submit" class="btn btn-primary btn-block shadow-sm">Tạo Lịch Kiểm Tra</button>
            </form>
        </div>
    </div>
@endsection
