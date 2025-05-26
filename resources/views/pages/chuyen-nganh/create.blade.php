@extends('layouts.main')
@section('content')
    <div class="nk-content">
        <div class="container">
            <div class="nk-content-inner">
                <div class="nk-content-body mt-5">

                    <div class="card">
                        <div class="card-inner">
                            <h5 class="card-title">Thêm chuyên ngành</h5>
                            <form action="{{ route('chuyen-nganh.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Tên chuyên ngành</label>
                                    <input type="text" name="ten_chuyen_nganh" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Thuộc ngành</label>
                                    <select name="nganh_id" class="form-control" required>
                                        <option value="">-- Chọn ngành --</option>
                                        @foreach($nganhs as $nganh)
                                            <option value="{{ $nganh->id }}">{{ $nganh->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Chuẩn đầu ra</label>
                                    <textarea type="text" name="chuan_dau_ra" class="form-control" required>
                                    </textarea>
                                </div>
                                <div class="mb-5">
                                    <button type="submit" class="btn btn-primary mt-3">Lưu</button>
                                    <a href="{{ route('chuyen-nganh.index') }}" class="btn btn-light mt-3">Huỷ</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
