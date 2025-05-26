@extends('layouts.main')

@section('content')
    <div class="nk-content">
        <div class="container">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    <div class="card">
                        <div class="card-inner">
                            <h4 class="card-title mb-4">Chỉnh sửa ngành</h4>

                            <form action="{{ route('nganh.update', $nganh->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Tên ngành</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $nganh->name) }}" required>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    <a href="{{ route('nganh.index') }}" class="btn btn-light">Huỷ</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
