@extends('layouts.main')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    <div class="components-preview mx-auto">

                        {{-- Thanh tìm kiếm --}}
                        <div class="card card-bordered mb-4 mt-5">
                            <div class="card-inner">
                                <form method="GET" action="{{ route('nganh.index') }}">
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label">Tìm kiếm ngành</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="search" class="form-control" placeholder="Nhập tên ngành..." value="{{ request('search') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2" style="margin-top:32px">
                                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                        </div>
                                        <div class="col-lg-2" style="margin-top:32px">
                                            <a class="btn btn-success" href="{{route('nganh.index')}}">
                                               Làm mới
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Form thêm ngành --}}
                        <div class="card card-bordered mb-4">
                            <div class="card-inner">
                                <form method="POST" action="{{route('nganh.store')}}">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">Tên ngành</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="name" class="form-control" placeholder="Ví dụ: Kỹ thuật phần mềm" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2" style="margin-top: 32px">
                                            <button type="submit" class="btn btn-success">Thêm ngành</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Danh sách ngành --}}
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <h6 class="title mb-3">Danh sách ngành</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên ngành</th>
                                            <th>Ngày tạo</th>
                                            <th>Thao tác</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($nganhs as $nganh)
                                            <tr>
                                                <td>{{ $nganh->id }}</td>
                                                <td>{{ $nganh->name }}</td>
                                                <td>{{ $nganh->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('nganh.edit', $nganh->id) }}" class="btn btn-sm btn-primary">
                                                            <em class="icon ni ni-edit"></em> Sửa
                                                        </a>

                                                        <form action="{{ route('nganh.destroy', $nganh->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xoá ngành này?')">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <em class="icon ni ni-trash"></em> Xoá
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">Không có dữ liệu</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Phân trang --}}
                                <div class="mt-3">
                                    {{ $nganhs->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
