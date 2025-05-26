@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Quản lý tin tức</h4>
                        <a href="{{ route('tin-tuc.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Thêm tin tức
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Ảnh đại diện</th>
                                    <th>Tiêu đề</th>
                                    <th>Ngày đăng</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tinTuc as $tin)
                                    <tr>
                                        <td>
                                            @if($tin->anh_dai_dien)
                                                <img src="{{ asset('storage/' . $tin->anh_dai_dien) }}" alt="Ảnh đại diện" style="width: 100px; height: 60px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Không có ảnh" style="width: 100px; height: 60px; object-fit: cover;">
                                            @endif
                                        </td>
                                        <td>{{ $tin->tieu_de }}</td>
                                        <td>{{ $tin->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <span class="badge {{ $tin->trang_thai ? 'bg-success' : 'bg-danger' }}">
                                                {{ $tin->trang_thai ? 'Hiển thị' : 'Ẩn' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('tin-tuc.edit', $tin->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <form action="{{ route('tin-tuc.destroy', $tin->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa tin tức này?')">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
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