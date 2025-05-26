@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title">Thêm lịch học môn học mới</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('lich-hoc-mon-hoc.store') }}" class="pt-3">
                            @csrf
                            <div class="form-group">
                                <label for="mon_hoc_id">Môn học</label>
                                <select class="form-control border-0 shadow-sm" id="mon_hoc_id" name="mon_hoc_id" required>
                                    <option value="">Chọn môn học</option>
                                    @foreach($monHocs as $monHoc)
                                        <option value="{{ $monHoc->id }}">{{ $monHoc->ma_mon_hoc }} - {{ $monHoc->ten_mon_hoc }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ma_lop">Mã lớp</label>
                                <input type="text" class="form-control border-0 shadow-sm" id="ma_lop" name="ma_lop" required placeholder="Nhập mã lớp">
                            </div>

                            <div class="form-group">
                                <label for="phong_hoc">Phòng học</label>
                                <input type="text" class="form-control border-0 shadow-sm" id="phong_hoc" name="phong_hoc" required placeholder="Nhập phòng học">
                            </div>

                            <div class="form-group">
                                <label for="thu">Thứ</label>
                                <select class="form-control border-0 shadow-sm" id="thu" name="thu" required>
                                    <option value="">Chọn thứ</option>
                                    <option value="Thứ 2">Thứ 2</option>
                                    <option value="Thứ 3">Thứ 3</option>
                                    <option value="Thứ 4">Thứ 4</option>
                                    <option value="Thứ 5">Thứ 5</option>
                                    <option value="Thứ 6">Thứ 6</option>
                                    <option value="Thứ 7">Thứ 7</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tiet_bat_dau">Tiết bắt đầu</label>
                                <input type="text" class="form-control border-0 shadow-sm" id="tiet_bat_dau" name="tiet_bat_dau" required placeholder="Nhập tiết bắt đầu">
                            </div>

                            <div class="form-group">
                                <label for="tiet_ket_thuc">Tiết kết thúc</label>
                                <input type="text" class="form-control border-0 shadow-sm" id="tiet_ket_thuc" name="tiet_ket_thuc" required placeholder="Nhập tiết kết thúc">
                            </div>

                            <div class="form-group">
                                <label for="giang_vien_id">Giảng viên</label>
                                <select name="giang_vien_id" id="giang_vien_id" class="form-control @error('giang_vien_id') is-invalid @enderror" required>
                                    <option value="">Chọn giảng viên</option>
                                    @foreach($giangViens as $giangVien)
                                        <option value="{{ $giangVien->id }}" {{ old('giang_vien_id') == $giangVien->id ? 'selected' : '' }}>Giảng viên
                                            {{ $giangVien->ten }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('giang_vien_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="so_luong_sv_toi_da">Số lượng sinh viên tối đa</label>
                                <input type="number" class="form-control border-0 shadow-sm" id="so_luong_sv_toi_da" name="so_luong_sv_toi_da" required placeholder="Nhập số lượng sinh viên tối đa">
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                    <i class="mdi mdi-content-save"></i> Thêm mới
                                </button>
                                <a href="{{ route('lich-hoc-mon-hoc.index') }}" class="btn btn-secondary btn-lg shadow-sm">
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