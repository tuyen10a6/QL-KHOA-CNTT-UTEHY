@extends('layouts.main')

@section('content')
    <div class="nk-content">
        <div class="container">
            <div class="nk-content-inner">
                <div class="nk-content-body mt-5">
                    <div class="card">
                        <div class="card-inner">
                            <div class="d-flex justify-content-between align-center">
                                <h4 class="mt-3">Chi tiết chuyên ngành: {{ $chuyenNganh->ten_chuyen_nganh }} </h4>
                                <a class="btn btn-success" href="{{route('monhoc.create')}}">Thêm môn học</a>
                            </div>
                            <hr>
                            <h5>Danh sách môn học chuyên ngành: {{ $chuyenNganh->ten_chuyen_nganh }}</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Mã môn</th>
                                        <th>Tên môn</th>
                                        <th>Tín chỉ</th>
                                        <th>Loại môn</th>
                                        <th>Số tiết lý thuyết</th>
                                        <th>Số tiết thực hành</th>
                                        <th>Số tiết tự học</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($chuyenNganh->monHoc as $mon)
                                        <tr>
                                            <td>{{ $mon->ma_mon_hoc }}</td>
                                            <td>{{ $mon->ten_mon_hoc }}</td>
                                            <td>{{ $mon->tin_chi }}</td>
                                            <td>{{ $mon->loai_mon }}</td>
                                            <td>{{ $mon->so_tiet_ly_thuyet }}</td>
                                            <td>{{ $mon->so_tiet_thuc_hanh }}</td>
                                            <td>{{ $mon->so_tiet_tu_hoc }}</td>
                                            <td>
                                                <a href="{{route('monhoc.show.admin', $mon->id)}}" class="btn btn-success">Chi tiết</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">Không có môn học nào</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('chuyen-nganh.index') }}" class="btn btn-secondary mt-3 mb-3">Quay lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
