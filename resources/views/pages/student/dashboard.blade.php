@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Xin chào, {{ Auth::user()->ten_dang_nhap }}</h4>
                        <p class="card-description">Đây là trang quản lý của sinh viên</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Môn học đã đăng ký</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã môn</th>
                                        <th>Tên môn</th>
                                        <th>Thời gian</th>
                                        <th>Phòng học</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dangKyMonHoc as $dk)
                                        <tr>
                                            <td>{{ $dk->monHoc->ma_mon_hoc }}</td>
                                            <td>{{ $dk->monHoc->ten_mon_hoc }}</td>
                                            <td>{{ $dk->lichHoc->thoi_gian }}</td>
                                            <td>{{ $dk->lichHoc->phong_hoc }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Bạn chưa đăng ký môn học nào</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Điểm môn học</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã môn</th>
                                        <th>Tên môn</th>
                                        <th>Điểm giữa kỳ</th>
                                        <th>Điểm cuối kỳ</th>
                                        <th>Điểm tổng kết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($diem as $d)
                                        <tr>
                                            <td>{{ $d->monHoc->ma_mon_hoc }}</td>
                                            <td>{{ $d->monHoc->ten_mon_hoc }}</td>
                                            <td>{{ $d->diem_giua_ky ?? '-' }}</td>
                                            <td>{{ $d->diem_cuoi_ky ?? '-' }}</td>
                                            <td>{{ $d->diem_tong_ket ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Chưa có điểm môn học nào</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 