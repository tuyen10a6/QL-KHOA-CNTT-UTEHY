@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="text-primary">Danh sách Báo Cáo</h1>
            <a href="{{ route('baocao.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Tạo Báo Cáo Mới
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-hover table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên Thiết Bị</th>
                <th>Ngày Báo Cáo</th>
                <th>Chi Tiết Báo Cáo</th>
                <th>Thời Gian Tạo</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($baoCaos as $baoCao)
                <tr>
                    <td>{{ $baoCao->id }}</td>
                    <td>{{ $baoCao->thietBi->ten_thiet_bi }}</td>
                    <td>{{ \Carbon\Carbon::parse($baoCao->ngay_bao_cao)->format('d/m/Y') }}</td>
                    <td>{{ Str::limit($baoCao->chi_tiet_bao_cao, 50) }} {{-- Rút ngắn chi tiết nếu quá dài --}}</td>
                    <td>{{ \Carbon\Carbon::parse($baoCao->created_at)->format('H:i d/m/Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
