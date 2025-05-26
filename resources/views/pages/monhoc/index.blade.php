@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title">Danh sách môn học</h4>
                            <a href="{{ route('monhoc.create') }}" class="btn btn-primary btn-icon-text">
                                <i class="mdi mdi-plus"></i> Thêm môn học mới
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã môn học</th>
                                        <th>Tên môn học</th>
                                        <th>Số tín chỉ</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($monHocList as $index => $monHoc)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $monHoc->ma_mon_hoc }}</td>
                                            <td>

                                                    {{ $monHoc->ten_mon_hoc }}
                                            </td>
                                            <td>{{ $monHoc->tin_chi }}</td>
                                            <td>
                                                @if($monHoc->trang_thai)
                                                    <span class="badge badge-success">Hoạt động</span>
                                                @else
                                                    <span class="badge badge-danger">Không hoạt động</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('monhoc.edit', $monHoc->id) }}" class="btn btn-sm btn-info">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <form action="{{ route('monhoc.destroy', $monHoc->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa môn học này?')">
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
@endsection
