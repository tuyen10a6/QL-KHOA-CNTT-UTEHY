@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Nhập điểm</h4>
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('diem.store', $dangKyMonHoc->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Mã sinh viên</label>
                                <input type="text" class="form-control" value="{{ $dangKyMonHoc->sinhVien->ma_sinh_vien }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tên sinh viên</label>
                                <input type="text" class="form-control" value="{{ $dangKyMonHoc->sinhVien->ten }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Mã môn học</label>
                                <input type="text" class="form-control" value="{{ $dangKyMonHoc->monHoc->ma_mon_hoc }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tên môn học</label>
                                <input type="text" class="form-control" value="{{ $dangKyMonHoc->monHoc->ten_mon_hoc }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Điểm giữa kỳ</label>
                                <input type="number" step="0.1" min="0" max="10" class="form-control @error('diem_giua_ky') is-invalid @enderror" name="diem_giua_ky" value="{{ old('diem_giua_ky') }}" required>
                                @error('diem_giua_ky')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Điểm cuối kỳ</label>
                                <input type="number" step="0.1" min="0" max="10" class="form-control @error('diem_cuoi_ky') is-invalid @enderror" name="diem_cuoi_ky" value="{{ old('diem_cuoi_ky') }}" required>
                                @error('diem_cuoi_ky')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nhận xét</label>
                                <textarea class="form-control @error('nhan_xet') is-invalid @enderror" name="nhan_xet" rows="3">{{ old('nhan_xet') }}</textarea>
                                @error('nhan_xet')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu điểm</button>
                            <a href="{{ route('diem.index') }}" class="btn btn-secondary">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 