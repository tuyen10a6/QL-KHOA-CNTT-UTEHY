@extends('layouts.main')

@section('content')
    <div class="container mt-5 mb-5">
        <h3>Danh sách Chương trình Đào tạo</h3>
        <table class="table table-bordered mt-3">
            <thead>
            <tr>
                <th>Tên Chương trình</th>
                <th>Tổng Số Tín chỉ</th>
                <th>Chuẩn Đầu ra</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($dsChuyenNganh as $chuyenNganh)
                <tr>
                    <td>{{ $chuyenNganh->ten_chuyen_nganh }}</td>
                    <td>
                        {{ $chuyenNganh->monHoc->sum('tin_chi') }}
                    </td>
                    <td style="max-width: 450px; white-space: normal; word-break: break-word; line-height: 25px">
                        {{ $chuyenNganh->chuan_dau_ra ?? 'Chưa cập nhật' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

{{--        <h5 class="mt-5">Các yếu tố cần quản lý</h5>--}}
{{--        <ol>--}}
{{--            <li><strong>Tên Chương trình:</strong> Tên chính thức của chương trình đào tạo.</li>--}}
{{--            <li><strong>Số Tín chỉ:</strong> Tổng số tín chỉ cần hoàn thành để tốt nghiệp.</li>--}}
{{--            <li><strong>Chuẩn Đầu ra:</strong> Các kỹ năng và kiến thức mà sinh viên sẽ đạt được sau khi hoàn thành chương trình.</li>--}}
{{--        </ol>--}}
    </div>
@endsection
