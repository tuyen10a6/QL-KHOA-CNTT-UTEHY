@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Chỉnh sửa tin tức</h4>
                    <form action="{{ route('tin-tuc.update', $tinTuc->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="tieu_de">Tiêu đề</label>
                            <input type="text" class="form-control" id="tieu_de" name="tieu_de" value="{{ $tinTuc->tieu_de }}" required>
                        </div>

                        <div class="form-group">
                            <label for="noi_dung">Nội dung</label>
                            <textarea class="form-control" id="noi_dung" name="noi_dung" rows="10" required>{{ $tinTuc->noi_dung }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="anh_dai_dien">Ảnh đại diện</label>
                            @if($tinTuc->anh_dai_dien)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $tinTuc->anh_dai_dien) }}" alt="Ảnh đại diện" style="max-width: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control" id="anh_dai_dien" name="anh_dai_dien">
                            <small class="form-text text-muted">Chỉ chấp nhận file ảnh (jpeg, png, jpg, gif) và kích thước tối đa 2MB</small>
                        </div>

                        <div class="form-group">
                            <label for="trang_thai">Trạng thái</label>
                            <select class="form-control" id="trang_thai" name="trang_thai" required>
                                <option value="1" {{ $tinTuc->trang_thai == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ $tinTuc->trang_thai == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('tin-tuc.index') }}" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 