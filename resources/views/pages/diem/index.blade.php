@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            @if(auth()->user()->vaiTro->ten_vai_tro === 'lecturer')
                                Quản lý điểm
                            @else
                                Xem điểm
                            @endif
                        </h4>
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

                        @if(auth()->user()->vaiTro->ten_vai_tro === 'lecturer')
                            @php
                                $groupedDangKy = $dangKyMonHoc->groupBy('mon_hoc_id');
                            @endphp

                            @forelse($groupedDangKy as $monHocId => $dangKyList)
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">
                                            <i class="fa-solid fa-book"></i> 
                                            {{ $dangKyList->first()->monHoc->ten_mon_hoc }}
                                            <small class="float-right">Mã môn: {{ $dangKyList->first()->monHoc->ma_mon_hoc }}</small>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="text-center">Tên SV</th>
                                                        <th class="text-center">Điểm giữa kỳ</th>
                                                        <th class="text-center">Điểm cuối kỳ</th>
                                                        <th class="text-center">Điểm tổng kết</th>
                                                        <th class="text-center">Xếp loại</th>
                                                        <th class="text-center">Nhận xét</th>
                                                        <th class="text-center">Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($dangKyList as $dk)
                                                        <tr>
                                                            <td>{{ $dk->sinhVien->ten }}</td>
                                                            <td class="text-center">{{ $dk->diem ? $dk->diem->diem_giua_ky : '-' }}</td>
                                                            <td class="text-center">{{ $dk->diem ? $dk->diem->diem_cuoi_ky : '-' }}</td>
                                                            <td class="text-center">{{ $dk->diem ? $dk->diem->diem_tong_ket : '-' }}</td>
                                                            <td class="text-center">
                                                                @if($dk->diem)
                                                                    <span class="badge badge-{{ $dk->diem->xep_loai === 'F' ? 'danger' : 'success' }}">
                                                                        {{ $dk->diem->xep_loai }}
                                                                    </span>
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>{{ $dk->diem ? $dk->diem->nhan_xet : '-' }}</td>
                                                            <td class="text-center">
                                                                @if(!$dk->diem)
                                                                    <a href="{{ route('diem.create', $dk->id) }}" class="btn btn-primary btn-sm" title="Nhập điểm">
                                                                        <i class="fa-solid fa-plus"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('diem.edit', $dk->diem->id) }}" class="btn btn-warning btn-sm" title="Sửa điểm">
                                                                        <i class="fa-solid fa-edit"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center">
                                                                <div class="alert alert-info">
                                                                    Chưa có sinh viên nào đăng ký môn học này
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    Chưa có môn học nào được đăng ký
                                </div>
                            @endforelse
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">Mã môn</th>
                                            <th class="text-center">Tên môn</th>
                                            <th class="text-center">Điểm giữa kỳ</th>
                                            <th class="text-center">Điểm cuối kỳ</th>
                                            <th class="text-center">Điểm tổng kết</th>
                                            <th class="text-center">Xếp loại</th>
                                            <th class="text-center">Nhận xét</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($dangKyMonHoc as $dk)
                                            <tr>
                                                <td class="text-center">{{ $dk->monHoc->ma_mon_hoc }}</td>
                                                <td>{{ $dk->monHoc->ten_mon_hoc }}</td>
                                                <td class="text-center">{{ $dk->diem ? $dk->diem->diem_giua_ky : '-' }}</td>
                                                <td class="text-center">{{ $dk->diem ? $dk->diem->diem_cuoi_ky : '-' }}</td>
                                                <td class="text-center">{{ $dk->diem ? $dk->diem->diem_tong_ket : '-' }}</td>
                                                <td class="text-center">
                                                    @if($dk->diem)
                                                        <span class="badge badge-{{ $dk->diem->xep_loai === 'F' ? 'danger' : 'success' }}">
                                                            {{ $dk->diem->xep_loai }}
                                                        </span>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $dk->diem ? $dk->diem->nhan_xet : '-' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    <div class="alert alert-info">
                                                        Bạn chưa có điểm môn học nào
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 