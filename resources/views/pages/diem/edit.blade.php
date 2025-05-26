@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Chỉnh sửa điểm</h4>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(!$diem)
                            <div class="alert alert-danger">
                                Không tìm thấy thông tin điểm
                            </div>
                            <a href="{{ route('diem.index') }}" class="btn btn-secondary">Quay lại</a>
                        @else
                            <form action="{{ route('diem.update', $diem->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="ma_mon_hoc">Mã môn học</label>
                                    <input type="text" class="form-control" id="ma_mon_hoc" value="{{ $diem->dangKyMonHoc->monHoc->ma_mon_hoc }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="ten_mon_hoc">Tên môn học</label>
                                    <input type="text" class="form-control" id="ten_mon_hoc" value="{{ $diem->dangKyMonHoc->monHoc->ten_mon_hoc }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="ten_sinh_vien">Tên sinh viên</label>
                                    <input type="text" class="form-control" id="ten_sinh_vien" value="{{ $diem->dangKyMonHoc->sinhVien->ten }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="diem_giua_ky">Điểm giữa kỳ</label>
                                    <input type="number" step="0.1" min="0" max="10" class="form-control @error('diem_giua_ky') is-invalid @enderror" id="diem_giua_ky" name="diem_giua_ky" value="{{ old('diem_giua_ky', $diem->diem_giua_ky) }}" required>
                                    @error('diem_giua_ky')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="diem_cuoi_ky">Điểm cuối kỳ</label>
                                    <input type="number" step="0.1" min="0" max="10" class="form-control @error('diem_cuoi_ky') is-invalid @enderror" id="diem_cuoi_ky" name="diem_cuoi_ky" value="{{ old('diem_cuoi_ky', $diem->diem_cuoi_ky) }}" required>
                                    @error('diem_cuoi_ky')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nhan_xet">Nhận xét</label>
                                    <textarea class="form-control @error('nhan_xet') is-invalid @enderror" id="nhan_xet" name="nhan_xet" rows="3">{{ old('nhan_xet', $diem->nhan_xet) }}</textarea>
                                    @error('nhan_xet')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <a href="{{ route('diem.index') }}" class="btn btn-secondary">Quay lại</a>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 