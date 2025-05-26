@extends('layouts.main')

@section('content')
    <div class="nk-content">
        <div class="container">
            <div class="nk-content-inner">
                <div class="nk-content-body mt-5">

                    <div class="card">
                        <div class="card-inner">
                            <h5 class="title">Thêm môn học mới</h5>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="khoa_id" value="1" />

                                <div class="row g-4">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Mã môn học</label>
                                            <input type="text" name="ma_mon_hoc" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-label">Tên môn học</label>
                                            <input type="text" name="ten_mon_hoc" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Tín chỉ</label>
                                            <input type="number" name="tin_chi" class="form-control" required min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Loại môn</label>
                                            <input type="text" name="loai_mon" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Chuyên ngành</label>
                                            <select name="chuyen_nganh_id" class="form-control" required>
                                                <option value="">-- Chọn chuyên ngành --</option>
                                                @foreach($chuyenNganhs as $cn)
                                                    <option value="{{ $cn->id }}">{{ $cn->ten_chuyen_nganh }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Trạng thái</label>
                                            <select name="trang_thai" class="form-control" required>
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Ẩn</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Tài liệu (PDF, DOC, DOCX)</label>
                                            <input type="file" name="document" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Số tiết lý thuyết</label>
                                            <input type="number" name="so_tiet_ly_thuyet" class="form-control" required min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Số tiết thực hành</label>
                                            <input type="number" name="so_tiet_thuc_hanh" class="form-control" required min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Số tiết tự học</label>
                                            <input type="number" name="so_tiet_tu_hoc" class="form-control" required min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Ghi chú</label>
                                            <textarea name="ghi_chu" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Giáo viên giảng dạy</label>
                                    <div id="giao-vien-wrapper">
                                        <div class="row mb-2 giao-vien-item">
                                            <div class="col-md-10">
                                                <select name="giao_viens[]" class="form-control" required>
                                                    <option value="">-- Chọn giáo viên --</option>
                                                    @foreach($giaoViens as $gv)
                                                        <option value="{{ $gv->id }}">{{ $gv->ten }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-remove-gv d-none">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="btn-add-gv" class="btn btn-secondary mt-2">+ Thêm giáo viên</button>
                                </div>

                                <div class="mt-4 mb-3">
                                    <button type="submit" class="btn btn-primary">Thêm môn học</button>
                                    <a href="{{ route('danh-sach-mon-hoc') }}" class="btn btn-light">Quay lại</a>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('giao-vien-wrapper');
            const btnAdd = document.getElementById('btn-add-gv');

            btnAdd.addEventListener('click', function () {
                const item = document.createElement('div');
                item.classList.add('row', 'mb-2', 'giao-vien-item');

                item.innerHTML = `
                <div class="col-md-10">
                    <select name="giao_viens[]" class="form-control" required>
                        <option value="">-- Chọn giáo viên --</option>
                        @foreach($giaoViens as $gv)
                <option value="{{ $gv->id }}">{{ $gv->ten }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-remove-gv">Xóa</button>
            </div>
`;

                wrapper.appendChild(item);
            });

            wrapper.addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-remove-gv')) {
                    e.target.closest('.giao-vien-item').remove();
                }
            });
        });
    </script>
@endsection
