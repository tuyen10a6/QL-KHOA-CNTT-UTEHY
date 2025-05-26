@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách lịch học môn học</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="order-listing" class="table">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Mã môn học</th>
                                                <th>Tên môn học</th>
                                                <th>Mã lớp</th>
                                                <th>Phòng học</th>
                                                <th>Thứ</th>
                                                <th>Tiết học</th>
                                                <th>Giảng viên</th>
                                                <th>Số lượng SV</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($lichHocMonHoc as $index => $lich)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $lich->monHoc->ma_mon_hoc }}</td>
                                                    <td>{{ $lich->monHoc->ten_mon_hoc }}</td>
                                                    <td>{{ $lich->ma_lop }}</td>
                                                    <td>{{ $lich->phong_hoc }}</td>
                                                    <td>{{ $lich->thu }}</td>
                                                    <td>{{ $lich->tiet_bat_dau }} - {{ $lich->tiet_ket_thuc }}</td>
                                                    <td>{{ $lich->giangVien->ten }}</td>
                                                    <td>{{ $lich->so_luong_sv_da_dang_ky }}/{{ $lich->so_luong_sv_toi_da }}</td>
                                                    <td>
                                                        @if($lich->trang_thai)
                                                            <span class="badge badge-success">Đang mở</span>
                                                        @else
                                                            <span class="badge badge-danger">Đã đóng</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('lich-hoc-mon-hoc.edit', $lich->id) }}" class="btn btn-sm btn-info">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('lich-hoc-mon-hoc.destroy', $lich->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa lịch học này?')">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 