@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Chi tiết tin tức</h4>
                        <div>
                            <a href="{{ route('tin-tuc.edit', $tinTuc->id) }}" class="btn btn-primary">Chỉnh sửa</a>
                            <a href="{{ route('tin-tuc.index') }}" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <h2>{{ $tinTuc->tieu_de }}</h2>
                            <p class="text-muted">
                                Đăng bởi: {{ $tinTuc->nguoiDang->ten_nguoi_dung }} | 
                                Ngày đăng: {{ $tinTuc->created_at->format('d/m/Y H:i') }}
                            </p>
                            <div class="mb-4">
                                @if($tinTuc->anh_dai_dien)
                                    <img src="{{ asset('storage/' . $tinTuc->anh_dai_dien) }}" alt="Ảnh đại diện" class="img-fluid">
                                @endif
                            </div>
                            <div class="content">
                                {!! nl2br(e($tinTuc->noi_dung)) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Thông tin tin tức</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Trạng thái:</strong> 
                                            <span class="badge badge-{{ $tinTuc->trang_thai ? 'success' : 'danger' }}">
                                                {{ $tinTuc->trang_thai ? 'Hiển thị' : 'Ẩn' }}
                                            </span>
                                        </li>
                                        <li><strong>Ngày tạo:</strong> {{ $tinTuc->created_at->format('d/m/Y H:i') }}</li>
                                        <li><strong>Ngày cập nhật:</strong> {{ $tinTuc->updated_at->format('d/m/Y H:i') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 