@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h2 class="my-4">Kích hoạt thông báo</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('thongbao.send') }}" method="POST" class="shadow p-4 rounded bg-light">
                @csrf
                <div class="form-group">
                    <label for="users">Chọn người nhận:</label>
                    <select name="users[]" id="users" class="form-control border-0 shadow-sm" multiple>
                        <option value="all">Chọn tất cả</option>
                        @foreach($allUsers as $user)
                            <option value="{{ $user->id }}">{{ $user->ten_dang_nhap }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="loai_thong_bao">Loại thông báo:</label>
                    <select name="loai_thong_bao" id="loai_thong_bao" class="form-control border-0 shadow-sm" required>
                        <option value="Thông báo">Thông báo</option>
                        <option value="Cảnh báo khẩn cấp">Cảnh báo khẩn cấp</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tieu_de">Tiêu đề:</label>
                    <input type="text" class="form-control border-0 shadow-sm" id="tieu_de" name="tieu_de" required placeholder="Nhập tiêu đề thông báo">
                    @if ($errors->has('tieu_de'))
                        <div class="text-danger mt-1">{{ $errors->first('tieu_de') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="noi_dung">Nội dung thông báo:</label>
                    <textarea class="form-control border-0 shadow-sm" id="noi_dung" name="noi_dung" rows="3" required placeholder="Nhập nội dung thông báo"></textarea>
                    @if ($errors->has('noi_dung'))
                        <div class="text-danger mt-1">{{ $errors->first('noi_dung') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-danger btn-block shadow-sm">Gửi thông báo</button>
            </form>
        </div>
    </div>

    <!-- Thêm jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Thêm Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Thêm Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Khởi tạo Select2
            $('#users').select2({
                placeholder: 'Chọn người nhận',
                allowClear: true,
                width: '100%'
            });

            // Khi chọn "Chọn tất cả"
            $('#users').on('change', function() {
                let selectedValues = $(this).val() || []; // Lấy các giá trị được chọn hiện tại (nếu có)
                let allSelected = selectedValues.includes('all'); // Kiểm tra xem "Chọn tất cả" có được chọn không

                if (allSelected) {
                    // Chọn tất cả các option ngoại trừ "all"
                    let allOptions = [];
                    $('#users > option').each(function() {
                        if ($(this).val() !== 'all') {
                            allOptions.push($(this).val()); // Thêm tất cả các giá trị ngoại trừ "all"
                        }
                    });

                    $('#users').val(allOptions); // Gán tất cả các giá trị vào Select2
                    $('#users').trigger('change'); // Gọi sự kiện thay đổi để cập nhật giao diện
                }
            });
        });
    </script>
@endsection
