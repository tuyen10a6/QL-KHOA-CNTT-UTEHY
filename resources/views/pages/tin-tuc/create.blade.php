@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm tin tức mới</h4>
                    <form action="{{ route('tin-tuc.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="tieu_de">Tiêu đề</label>
                            <input type="text" class="form-control" id="tieu_de" name="tieu_de" required>
                        </div>

                        <div class="form-group">
                            <label for="noi_dung">Nội dung</label>
                            <textarea class="form-control" id="noi_dung" name="noi_dung" rows="10" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="anh_dai_dien">Ảnh đại diện</label>
                            <input type="file" class="form-control" id="anh_dai_dien" name="anh_dai_dien">
                            <small class="form-text text-muted">Chỉ chấp nhận file ảnh (jpeg, png, jpg, gif) và kích thước tối đa 2MB</small>
                        </div>

                        <div class="form-group">
                            <label for="trang_thai">Trạng thái</label>
                            <select class="form-control" id="trang_thai" name="trang_thai" required>
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Thêm tin tức</button>
                        <a href="{{ route('tin-tuc.index') }}" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 