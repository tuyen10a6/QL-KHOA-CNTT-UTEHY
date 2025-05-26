@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="container">
            <h1>Danh Sách Thiết Bị PCCC</h1>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Thiết Bị</th>
                    <th>Hình Ảnh</th>
                    <th>Vị Trí</th>
                    <th>Ngày Lắp Đặt</th>
                    <th>Ngày Kiểm Tra Gần Nhất</th>
                    <th>Tình Trạng</th>
                    <th>Hành Động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($thietBiList as $thietBi)
                    <tr>
                        <td>{{ $thietBi->id }}</td>
                        <td>{{ $thietBi->ten_thiet_bi }}</td>
                        <td>
                            @if ($thietBi->hinh_anh)
                                <img src="{{ asset('assets/images/Device/' . $thietBi->hinh_anh) }}" alt="{{ $thietBi->ten_thiet_bi }}" style="width: 120px ;height: 120px;">
                            @else
                                Không có hình ảnh
                            @endif
                        </td>
                        <td>{{ $thietBi->vi_tri }}</td>
                        <td>{{ $thietBi->ngay_lap_dat }}</td>
                        <td>{{ $thietBi->ngay_kiem_tra_gan_nhat ?? 'Chưa kiểm tra' }}</td>
                        <td>{{ $thietBi->tinh_trang }}</td>
                        <td>
                            <!-- Nút Sửa và Xóa -->
                            <a href="{{ url('/thiet-bi-pccc/sua/' . $thietBi->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('thiet-bi.destroy', $thietBi->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


@endsection
