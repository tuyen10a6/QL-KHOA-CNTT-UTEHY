@extends('layouts.main')

@section('content')
    <div class="nk-content">
        <div class="container">
            <div class="nk-content-inner">
                <div class="nk-content-body mt-5">

                    <div class="card">
                        <div class="card-inner">
                            <h4 class="card-title">Cập nhật chuyên ngành</h4>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('chuyen-nganh.update', $chuyenNganh->id) }}">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label">Tên chuyên ngành</label>
                                    <div class="form-control-wrap">
                                        <textarea name="ten_chuyen_nganh" class="form-control" required>{{ old('ten_chuyen_nganh', $chuyenNganh->ten_chuyen_nganh) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="form-label">Thuộc ngành</label>
                                    <div class="form-control-wrap">
                                        <select name="nganh_id" class="form-control" required>
                                            <option value="">-- Chọn ngành --</option>
                                            @foreach($nganhs as $nganh)
                                                <option value="{{ $nganh->id }}"
                                                    {{ $chuyenNganh->nganh_id == $nganh->id ? 'selected' : '' }}>
                                                    {{ $nganh->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Chuẩn đầu ra</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="chuan_dau_ra" class="form-control"
                                               value="{{ old('chuan_dau_ra', $chuyenNganh->chuan_dau_ra) }}" required>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-primary">Cập nhật</button>
                                    <a href="{{ route('chuyen-nganh.index') }}" class="btn btn-secondary">Quay lại</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
