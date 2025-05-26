@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h1 class="text-primary mb-4">Tạo Báo Cáo Mới</h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Đã có lỗi xảy ra!</strong> Vui lòng kiểm tra lại thông tin bên dưới:
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('baocao.store') }}" method="POST" class="p-4 shadow-sm rounded bg-light">
            @csrf

            <div class="form-group mb-3">
                <label for="thiet_bi_id" class="form-label">Chọn Thiết Bị</label>
                <select name="thiet_bi_id" id="thiet_bi_id" class="form-select" required>
                    <option value="" disabled selected>-- Chọn thiết bị --</option>
                    @foreach ($thietBis as $thietBi)
                        <option value="{{ $thietBi->id }}">{{ $thietBi->ten_thiet_bi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="ngay_bao_cao" class="form-label">Ngày Báo Cáo</label>
                <input type="date" name="ngay_bao_cao" id="ngay_bao_cao" class="form-control" required>
            </div>

            <div class="form-group mb-4">
                <label for="chi_tiet_bao_cao" class="form-label">Chi Tiết Báo Cáo</label>
                <textarea name="chi_tiet_bao_cao" id="chi_tiet_bao_cao" class="form-control" rows="5" placeholder="Nhập chi tiết báo cáo..." required></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Lưu Báo Cáo
                </button>
            </div>
        </form>
    </div>
@endsection
