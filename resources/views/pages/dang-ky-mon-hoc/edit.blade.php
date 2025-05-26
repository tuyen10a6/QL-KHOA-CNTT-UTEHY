@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Chỉnh sửa đăng ký môn học</h4>
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

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('dang-ky-mon-hoc.update', $dangKyMonHoc->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Chọn</th>
                            <th>Mã môn học</th>
                            <th>Tên môn học</th>
                            <th>Mã lớp</th>
                            <th>Phòng học</th>
                            <th>Thứ</th>
                            <th>Tiết học</th>
                            <th>Giảng viên</th>
                            <th>Số lượng SV</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lichHocMonHoc as $lichHoc)
                            <tr>
                                <td>
                                    <input type="radio" name="lich_hoc_mon_hoc_id" value="{{ $lichHoc->id }}"
                                        {{ $dangKyMonHoc->lich_hoc_mon_hoc_id == $lichHoc->id ? 'checked' : '' }}
                                        required>
                                </td>
                                <td>{{ $lichHoc->monHoc->ma_mon_hoc }}</td>
                                <td>{{ $lichHoc->monHoc->ten_mon_hoc }}</td>
                                <td>{{ $lichHoc->ma_lop }}</td>
                                <td>{{ $lichHoc->phong_hoc }}</td>
                                <td>Thứ {{ $lichHoc->thu }}</td>
                                <td>Tiết {{ $lichHoc->tiet_bat_dau }} - {{ $lichHoc->tiet_ket_thuc }}</td>
                                <td>{{ $lichHoc->giang_vien }}</td>
                                <td>{{ $lichHoc->so_luong_sv_da_dang_ky }}/{{ $lichHoc->so_luong_sv_toi_da }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('dang-ky-mon-hoc.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@endsection 