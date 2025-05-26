@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title">Thêm khoa mới</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('khoa.store') }}" class="pt-3">
                            @csrf
                            <div class="form-group">
                                <label for="ma_khoa">Mã khoa</label>
                                <input type="text" class="form-control border-0 shadow-sm" id="ma_khoa" name="ma_khoa" required placeholder="Nhập mã khoa">
                            </div>

                            <div class="form-group">
                                <label for="ten_khoa">Tên khoa</label>
                                <input type="text" class="form-control border-0 shadow-sm" id="ten_khoa" name="ten_khoa" required placeholder="Nhập tên khoa">
                            </div>

                            <div class="form-group">
                                <label for="mo_ta">Mô tả</label>
                                <textarea class="form-control border-0 shadow-sm" id="mo_ta" name="mo_ta" rows="3" placeholder="Nhập mô tả (nếu có)"></textarea>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                    <i class="mdi mdi-plus"></i> Thêm khoa
                                </button>
                                <a href="{{ route('danh-sach-khoa') }}" class="btn btn-secondary btn-lg shadow-sm">
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
