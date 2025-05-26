@extends('layouts.main')

@section('content')
    <div class="nk-content">
        <div class="container">
            <div class="nk-content-inner">
                <div class="nk-content-body mt-5">
                    <div class="card mb-4">
                        <div class="card-inner">
                            <form method="GET" action="{{ route('chuyen-nganh.index') }}" class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <input type="text" name="search" class="form-control" placeholder="Tìm chuyên ngành..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Ngành</label>
                                        <div class="form-control-wrap">
                                            <select name="nganh_id" class="form-control">
                                                <option value="">-- Tất cả ngành --</option>
                                                @foreach($nganhs as $nganh)
                                                    <option value="{{ $nganh->id }}" {{ request('nganh_id') == $nganh->id ? 'selected' : '' }}>
                                                        {{ $nganh->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary">Tìm kiếm</button>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('chuyen-nganh.index') }}" class="btn btn-light">Làm mới</a>
                                </div>
                                <div class="col-auto ms-auto">
                                    <a href="{{route('chuyen-nganh.create')}}" class="btn btn-success">+ Thêm chuyên ngành</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên chuyên ngành</th>
                                    <th>Ngành</th>
                                    <th>Ngày tạo</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($chuyenNganhs as $chuyenNganh)
                                    <tr>
                                        <td>{{ $chuyenNganh->id }}</td>
                                        <td>{{ $chuyenNganh->ten_chuyen_nganh }}</td>
                                        <td>{{ $chuyenNganh->nganh->name ?? 'Chưa rõ' }}</td>
                                        <td>{{ $chuyenNganh->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{route('chuyen-nganh.show', $chuyenNganh->id)}}" class="btn btn-sm btn-success">Chi tiết</a>
                                            <a href="{{ route('chuyen-nganh.edit', $chuyenNganh->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                                            <form action="{{route('chuyen-nganh.destroy', $chuyenNganh->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xoá?')">
                                                @csrf
                                                <button class="btn btn-sm btn-danger">Xoá</button>
                                            </form>
                                            <a href="{{ route('chuyen-nganh.print', $chuyenNganh->id) }}" target="_blank" class="btn btn-sm btn-warning">In</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Không có chuyên ngành nào.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $chuyenNganhs->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
