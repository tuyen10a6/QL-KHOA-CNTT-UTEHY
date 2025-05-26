@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h2>Chỉnh Sửa Lịch Kiểm Tra</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('lich-kiem-tra.update', $lichKiemTra->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="thiet_bi_id">Thiết Bị</label>
                    <select class="form-control" name="thiet_bi_id" id="thiet_bi_id" required>
                        @foreach($thietBis as $thietBi)
                            <option value="{{ $thietBi->id }}" {{ $lichKiemTra->thiet_bi_id == $thietBi->id ? 'selected' : '' }}>
                                {{ $thietBi->ten_thiet_bi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="ngay_thuc_hien">Ngày Thực Hiện</label>
                    <input type="date" class="form-control" id="ngay_thuc_hien" name="ngay_thuc_hien" value="{{ $lichKiemTra->ngay_thuc_hien }}" required>
                </div>

                <div class="form-group">
                    <label for="nguoi_thuc_hien_id">Người Thực Hiện</label>
                    <select class="form-control" name="nguoi_thuc_hien_id" id="nguoi_thuc_hien_id" required>
                        @foreach($nguoiDungs as $nguoiDung)
                            <option value="{{ $nguoiDung->id }}" {{ $lichKiemTra->nguoi_thuc_hien_id == $nguoiDung->id ? 'selected' : '' }}>
                                {{ $nguoiDung->ten }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="ghi_chu">Ghi Chú</label>
                    <textarea class="form-control" id="ghi_chu" name="ghi_chu" rows="3">{{ $lichKiemTra->ghi_chu }}</textarea>
                </div>

                <div class="form-group">
                    <label for="tinh_trang_truoc_khi_kiem_tra">Tình Trạng Trước Khi Kiểm Tra</label>
                    <input type="text" class="form-control" id="tinh_trang_truoc_khi_kiem_tra" name="tinh_trang_truoc_khi_kiem_tra" value="{{ $lichKiemTra->tinh_trang_truoc_khi_kiem_tra }}">
                </div>

                <div class="form-group">
                    <label for="tinh_trang_sau_khi_kiem_tra">Tình Trạng Sau Khi Kiểm Tra</label>
                    <input type="text" class="form-control" id="tinh_trang_sau_khi_kiem_tra" name="tinh_trang_sau_khi_kiem_tra" value="{{ $lichKiemTra->tinh_trang_sau_khi_kiem_tra }}">
                </div>

                <button type="submit" class="btn btn-primary">Cập Nhật</button>
            </form>
        </div>
    </div>
@endsection
