@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title">Chỉnh sửa môn học</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('monhoc.update', $monHoc->id) }}" class="pt-3" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="ma_mon_hoc">Mã môn học</label>
                                <input type="text" class="form-control border-0 shadow-sm" id="ma_mon_hoc" name="ma_mon_hoc" 
                                    value="{{ old('ma_mon_hoc', $monHoc->ma_mon_hoc) }}" required placeholder="Nhập mã môn học">
                            </div>

                            <div class="form-group">
                                <label for="ten_mon_hoc">Tên môn học</label>
                                <input type="text" class="form-control border-0 shadow-sm" id="ten_mon_hoc" name="ten_mon_hoc" 
                                    value="{{ old('ten_mon_hoc', $monHoc->ten_mon_hoc) }}" required placeholder="Nhập tên môn học">
                            </div>

                            <div class="form-group">
                                <label for="tin_chi">Số tín chỉ</label>
                                <input type="number" class="form-control border-0 shadow-sm" id="tin_chi" name="tin_chi" 
                                    value="{{ old('tin_chi', $monHoc->tin_chi) }}" required placeholder="Nhập số tín chỉ">
                            </div>

                            <div class="form-group">
                                <label for="khoa_id">Khoa</label>
                                <select name="khoa_id" id="khoa_id" class="form-control @error('khoa_id') is-invalid @enderror">
                                    <option value="">Chọn khoa</option>
                                    @foreach($khoaList as $khoa)
                                        <option value="{{ $khoa->id }}" {{ $monHoc->khoa_id == $khoa->id ? 'selected' : '' }}>
                                            {{ $khoa->ten_khoa }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('khoa_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="hidden" name="trang_thai" value="0">
                                    <input type="checkbox" class="form-check-input" id="trang_thai" name="trang_thai" value="1"
                                        {{ old('trang_thai', $monHoc->trang_thai) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="trang_thai">Môn học đang hoạt động</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="document">Tài liệu môn học</label>
                                @if($monHoc->document)
                                    <div class="mb-2">
                                        <a href="{{ Storage::url($monHoc->document) }}" class="btn btn-sm btn-info" target="_blank">
                                            <i class="mdi mdi-file-document"></i> Xem tài liệu hiện tại
                                        </a>
                                    </div>
                                @endif
                                <input type="file" class="form-control-file" id="document" name="document">
                                <small class="form-text text-muted">Chỉ chấp nhận file PDF, DOC, DOCX (tối đa 10MB)</small>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                    <i class="mdi mdi-content-save"></i> Lưu thay đổi
                                </button>
                                <a href="{{ route('danh-sach-mon-hoc') }}" class="btn btn-secondary btn-lg shadow-sm">
                                    <i class="mdi mdi-arrow-left"></i> Quay lại
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 