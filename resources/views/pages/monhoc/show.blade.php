@extends('layouts.main') {{-- hoặc layout bạn đang dùng --}}

@section('content')
    <div class="container mt-5">
        <h2>Chi tiết môn học: {{ $monHoc->ten_mon_hoc }}</h2>

        <table class="table table-bordered mt-3">
            <tr><th>Mã môn học</th><td>{{ $monHoc->ma_mon_hoc }}</td></tr>
            <tr><th>Tên môn học</th><td>{{ $monHoc->ten_mon_hoc }}</td></tr>
            <tr><th>Số tín chỉ</th><td>{{ $monHoc->tin_chi }}</td></tr>
            <tr><th>Loại môn</th><td>{{ $monHoc->loai_mon }}</td></tr>
            <tr><th>Số tiết lý thuyết</th><td>{{ $monHoc->so_tiet_ly_thuyet }}</td></tr>
            <tr><th>Số tiết thực hành</th><td>{{ $monHoc->so_tiet_thuc_hanh }}</td></tr>
            <tr><th>Số tiết tự học</th><td>{{ $monHoc->so_tiet_tu_hoc }}</td></tr>
            <tr>
                <th>Ghi chú</th>
                <td style="white-space: pre-wrap;">{{ $monHoc->ghi_chu ?? 'Không có' }}</td>
            </tr>
            <tr><th>Trạng thái</th><td>{{ $monHoc->trang_thai ? 'Hoạt động' : 'Ngưng' }}</td></tr>
            <tr><th>Khoa</th><td>{{ $monHoc->khoa->ten_khoa ?? 'Không có' }}</td></tr>
            <tr><th>Chuyên ngành</th><td>{{ $monHoc->chuyenNganh->ten_chuyen_nganh ?? 'Không có' }}</td></tr>
            <tr>
                <th>Tài liệu</th>
                <td>
                    @if ($monHoc->document)
                        <a href="{{ asset('storage/' . $monHoc->document) }}" target="_blank">Xem tài liệu</a>
                    @else
                        Không có
                    @endif
                </td>
            </tr>
        </table>

        <h4 class="mt-5">Danh sách giảng viên giảng dạy</h4>
        <ul>
            @forelse ($monHoc->giangViens as $gv)
                <li>{{ $gv->ten }} ({{ $gv->email ?? 'Không có email' }})</li>
            @empty
                <li>Chưa có giảng viên nào giảng dạy môn học này.</li>
            @endforelse
        </ul>

        <a href="{{ route('chuyen-nganh.show', $monHoc->chuyenNganh->id) }}" class="btn btn-secondary mt-3 mb-3">Quay lại danh sách</a>
    </div>
    <div class="p-5">
        <hr>
        <h5>Các môn học cùng chuyên ngành: {{ $monHoc->chuyenNganh->ten_chuyen_nganh }}</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Tín chỉ</th>
                    <th>Loại môn</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($monHoc->chuyenNganh->monHoc->where('id', '!=', $monHoc->id) as $mon)
                    <tr>
                        <td>{{ $mon->ma_mon_hoc }}</td>
                        <td>{{ $mon->ten_mon_hoc }}</td>
                        <td>{{ $mon->tin_chi }}</td>
                        <td>{{ $mon->loai_mon }}</td>
                        <td>
                            <a href="{{ route('monhoc.show.admin', $monHoc->chuyenNganh->id) }}" class="btn btn-outline-primary btn-sm">Chi tiết</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
