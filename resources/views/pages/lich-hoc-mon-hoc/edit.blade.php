@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Chỉnh sửa lịch học môn học</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('lich-hoc-mon-hoc.update', $lichHoc->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="mon_hoc_id">Môn học</label>
                <select class="form-control" id="mon_hoc_id" name="mon_hoc_id" required>
                    <option value="">Chọn môn học</option>
                    @foreach($monHocs as $mh)
                        <option value="{{ $mh->id }}" {{ $lichHoc->mon_hoc_id == $mh->id ? 'selected' : '' }}>
                            {{ $mh->ma_mon_hoc }} - {{ $mh->ten_mon_hoc }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="ma_lop">Mã lớp</label>
                <input type="text" class="form-control" id="ma_lop" name="ma_lop" value="{{ $lichHoc->ma_lop }}" required>
            </div>

            <div class="form-group">
                <label for="phong_hoc">Phòng học</label>
                <input type="text" class="form-control" id="phong_hoc" name="phong_hoc" value="{{ $lichHoc->phong_hoc }}" required>
            </div>

            <div class="form-group">
                <label for="thu">Thứ</label>
                <select class="form-control" id="thu" name="thu" required>
                    <option value="">Chọn thứ</option>
                    <option value="2" {{ $lichHoc->thu == 2 ? 'selected' : '' }}>Thứ 2</option>
                    <option value="3" {{ $lichHoc->thu == 3 ? 'selected' : '' }}>Thứ 3</option>
                    <option value="4" {{ $lichHoc->thu == 4 ? 'selected' : '' }}>Thứ 4</option>
                    <option value="5" {{ $lichHoc->thu == 5 ? 'selected' : '' }}>Thứ 5</option>
                    <option value="6" {{ $lichHoc->thu == 6 ? 'selected' : '' }}>Thứ 6</option>
                    <option value="7" {{ $lichHoc->thu == 7 ? 'selected' : '' }}>Thứ 7</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tiet_bat_dau">Tiết bắt đầu</label>
                <input type="number" class="form-control" id="tiet_bat_dau" name="tiet_bat_dau" value="{{ $lichHoc->tiet_bat_dau }}" min="1" max="12" required>
            </div>

            <div class="form-group">
                <label for="tiet_ket_thuc">Tiết kết thúc</label>
                <input type="number" class="form-control" id="tiet_ket_thuc" name="tiet_ket_thuc" value="{{ $lichHoc->tiet_ket_thuc }}" min="1" max="12" required>
            </div>

            <div class="form-group">
                <label for="giang_vien_id">Giảng viên</label>
                <select name="giang_vien_id" id="giang_vien_id" class="form-control @error('giang_vien_id') is-invalid @enderror" required>
                    <option value="">Chọn giảng viên</option>
                    @foreach($giangViens as $giangVien)
                        <option value="{{ $giangVien->id }}" 
                            {{ old('giang_vien_id', $lichHoc->giang_vien_id) == $giangVien->id ? 'selected' : '' }}>Giảng viên
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
                <input type="number" class="form-control" id="so_luong_sv_toi_da" name="so_luong_sv_toi_da" value="{{ $lichHoc->so_luong_sv_toi_da }}" min="1" required>
            </div>

            <div class="form-group">
                <label for="trang_thai">Trạng thái</label>
                <select class="form-control" id="trang_thai" name="trang_thai" required>
                    <option value="1" {{ $lichHoc->trang_thai == 1 ? 'selected' : '' }}>Mở đăng ký</option>
                    <option value="0" {{ $lichHoc->trang_thai == 0 ? 'selected' : '' }}>Đóng đăng ký</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('lich-hoc-mon-hoc.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection 