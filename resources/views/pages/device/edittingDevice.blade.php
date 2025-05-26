@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center text-primary mb-4">Sửa Thiết Bị PCCC</h2>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Đã có lỗi xảy ra!</strong> Vui lòng kiểm tra lại thông tin bên dưới:
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('thiet-bi.update', $thietBi->id) }}" method="POST" enctype="multipart/form-data" class="p-4 shadow-sm rounded bg-light">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="ten_thiet_bi" class="form-label">Tên Thiết Bị</label>
                <input type="text" class="form-control" name="ten_thiet_bi" value="{{ old('ten_thiet_bi', $thietBi->ten_thiet_bi) }}" required>
                @if ($errors->has('ten_thiet_bi'))
                    <div class="text-danger mt-1">{{ $errors->first('ten_thiet_bi') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="nha_cung_cap" class="form-label">Nhà Cung Cấp</label>
                <input type="text" class="form-control" name="nha_cung_cap" value="{{ old('nha_cung_cap', $thietBi->nha_cung_cap) }}" required>
                @if ($errors->has('nha_cung_cap'))
                    <div class="text-danger mt-1">{{ $errors->first('nha_cung_cap') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="so_luong" class="form-label">Số Lượng</label>
                <input type="number" class="form-control" name="so_luong" value="{{ old('so_luong', $thietBi->so_luong) }}" required>
                @if ($errors->has('so_luong'))
                    <div class="text-danger mt-1">{{ $errors->first('so_luong') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="vi_tri" class="form-label">Vị Trí</label>
                <input type="text" class="form-control" name="vi_tri" value="{{ old('vi_tri', $thietBi->vi_tri) }}" required>
                @if ($errors->has('vi_tri'))
                    <div class="text-danger mt-1">{{ $errors->first('vi_tri') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="ngay_lap_dat" class="form-label">Ngày Lắp Đặt</label>
                <input type="date" class="form-control" name="ngay_lap_dat" value="{{ old('ngay_lap_dat', $thietBi->ngay_lap_dat) }}" required>
                @if ($errors->has('ngay_lap_dat'))
                    <div class="text-danger mt-1">{{ $errors->first('ngay_lap_dat') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="ngay_kiem_tra_gan_nhat" class="form-label">Ngày Kiểm Tra Gần Nhất</label>
                <input type="date" class="form-control" name="ngay_kiem_tra_gan_nhat" value="{{ old('ngay_kiem_tra_gan_nhat', $thietBi->ngay_kiem_tra_gan_nhat) }}">
                @if ($errors->has('ngay_kiem_tra_gan_nhat'))
                    <div class="text-danger mt-1">{{ $errors->first('ngay_kiem_tra_gan_nhat') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="tinh_trang" class="form-label">Tình Trạng</label>
                <input type="text" class="form-control" name="tinh_trang" value="{{ old('tinh_trang', $thietBi->tinh_trang) }}" required>
                @if ($errors->has('tinh_trang'))
                    <div class="text-danger mt-1">{{ $errors->first('tinh_trang') }}</div>
                @endif
            </div>

            <div class="form-group mb-4">
                <label for="hinh_anh" class="form-label">Hình Ảnh Thiết Bị</label>
                <input type="file" class="form-control" name="hinh_anh" accept="image/*" onchange="previewImage(event)">
                @if ($errors->has('hinh_anh'))
                    <div class="text-danger mt-1">{{ $errors->first('hinh_anh') }}</div>
                @endif
                <div class="mt-2">
                    <img id="imagePreview" src="{{ asset('assets/images/Device/' . $thietBi->hinh_anh) }}" alt="{{ $thietBi->ten_thiet_bi }}" style="max-width: 200px; display: block;" />
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">
                <i class="fas fa-save"></i> Cập Nhật
            </button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const image = document.getElementById('imagePreview');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.style.display = 'block';
        }
    </script>
@endsection
