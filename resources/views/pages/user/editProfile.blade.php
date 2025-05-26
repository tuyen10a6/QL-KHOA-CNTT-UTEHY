<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trường Đại học SPKT Hưng Yên</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5fcf;
            --secondary-color: #234b8b;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --text-color: #333;
            --light-gray: #f8f9fa;
            --border-color: #dee2e6;
            --card-bg: #ffffff;
            --card-shadow: 0 4px 6px rgba(0,0,0,0.1);
            --input-bg: #f8f9fa;
            --input-border: #ced4da;
            --input-focus: #80bdff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: #f2f2f2;
            color: var(--text-color);
            line-height: 1.6;
        }

        header {
            background: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #e74c3c;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo img {
            width: 90px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .logo .title h1 {
            color: #e74c3c;
            font-size: 24px;
            margin: 0;
            font-weight: 700;
        }

        .logo .title p {
            color: #666;
            font-size: 16px;
            margin: 5px 0 0;
        }

        .user-info {
            text-align: right;
            color: white;
            background-color: var(--secondary-color);
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .user-info:hover {
            transform: translateY(-2px);
        }

        .user-info span {
            font-weight: 500;
            font-size: 16px;
        }

        .user-info small {
            font-size: 14px;
            opacity: 0.9;
        }

        .navbar {
            background-color: var(--secondary-color);
            padding: 12px 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            background-color: var(--primary-color);
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar a:hover {
            background-color: #1a4bb8;
            transform: translateY(-2px);
        }

        .content {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .container {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-2px);
        }

        .header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--light-gray);
        }

        .title {
            color: var(--text-color);
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            font-size: 16px;
            line-height: 1.5;
            color: var(--text-color);
            background-color: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 6px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: var(--input-focus);
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        }

        .form-control.is-invalid {
            border-color: var(--danger-color);
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 8px;
            font-size: 14px;
            color: var(--danger-color);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            white-space: nowrap;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            color: white;
            background-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #1a4bb8;
            transform: translateY(-2px);
        }

        .btn-secondary {
            color: white;
            background-color: var(--secondary-color);
        }

        .btn-secondary:hover {
            background-color: #1a3a6b;
            transform: translateY(-2px);
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .avatar-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--primary-color);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-upload {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .avatar-upload input[type="file"] {
            display: none;
        }

        .avatar-upload label {
            padding: 8px 16px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .avatar-upload label:hover {
            background-color: #1a4bb8;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .content {
                padding: 15px;
            }

            .container {
                padding: 20px;
            }

            .form-control {
                font-size: 14px;
                padding: 10px 12px;
            }

            .btn {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('assets/images/logoQLCT.jpg') }}" alt="Logo">
            <div class="title">
                <h1>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT HƯNG YÊN</h1>
                <p>Hung Yen University of Technology and Education</p>
            </div>
        </div>
        <div class="user-info">
            <span>{{ auth()->user()->ten }}</span><br>
            <small>{{ auth()->user()->vaiTro->ten_vai_tro }}</small>
        </div>
    </header>

    <nav class="navbar">
        <a href="/dashboard">TRANG CHỦ</a>
        <a href="{{ route('dang-ky-mon-hoc.index') }}">LỊCH SỬ ĐĂNG KÍ HỌC PHẦN</a>
    <a href="{{ route('dang-ky-mon-hoc.create') }}">ĐĂNG KÝ HỌC PHẦN</a>

        <a href="{{ route('thong-tin-ca-nhan') }}">THÔNG TIN CÁ NHÂN</a>
        <a href="{{ route('diem.student') }}">KẾT QUẢ HỌC TẬP</a>
    </nav>

    <main class="content">
        <div class="container">
            <div class="header">
                <h1 class="title">Chỉnh sửa thông tin cá nhân</h1>
            </div>

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('thong-tin-ca-nhan.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                <div class="avatar-container">
                    <div class="avatar-preview">
                        <img src="{{ $user->avatar ? asset('assets/images/avatars/' . $user->avatar) : asset('assets/images/default-avatar.png') }}" alt="Avatar">
                    </div>
                    <div class="avatar-upload">
                        <input type="file" name="avatar" id="avatar" accept="image/*">
                        <label for="avatar">Chọn ảnh đại diện</label>
                    </div>
                </div>

                            <div class="form-group">
                                <label for="ten">Họ và tên</label>
                    <input type="text" class="form-control @error('ten') is-invalid @enderror" id="ten" name="ten" value="{{ old('ten', $user->ten) }}" required>
                    @error('ten')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sdt">Số điện thoại</label>
                    <input type="text" class="form-control @error('sdt') is-invalid @enderror" id="sdt" name="sdt" value="{{ old('sdt', $user->sdt) }}">
                    @error('sdt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                            </div>

                            <div class="form-group">
                    <label for="cccd">CCCD</label>
                    <input type="text" class="form-control @error('cccd') is-invalid @enderror" id="cccd" name="cccd" value="{{ old('cccd', $user->cccd) }}">
                    @error('cccd')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="ngay_sinh">Ngày sinh</label>
                    <input type="date" class="form-control @error('ngay_sinh') is-invalid @enderror" id="ngay_sinh" name="ngay_sinh" value="{{ old('ngay_sinh', $user->ngay_sinh) }}">
                    @error('ngay_sinh')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="gioi_tinh">Giới tính</label>
                    <select class="form-control @error('gioi_tinh') is-invalid @enderror" id="gioi_tinh" name="gioi_tinh">
                                    <option value="">Chọn giới tính</option>
                        <option value="nam" {{ old('gioi_tinh', $user->gioi_tinh) == 'nam' ? 'selected' : '' }}>Nam</option>
                        <option value="nu" {{ old('gioi_tinh', $user->gioi_tinh) == 'nu' ? 'selected' : '' }}>Nữ</option>
                                </select>
                    @error('gioi_tinh')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="khoa_id">Khoa</label>
                    <select class="form-control @error('khoa_id') is-invalid @enderror" id="khoa_id" name="khoa_id">
                                    <option value="">Chọn khoa</option>
                                    @foreach($khoaList as $khoa)
                                        <option value="{{ $khoa->id }}" {{ old('khoa_id', $user->khoa_id) == $khoa->id ? 'selected' : '' }}>
                                            {{ $khoa->ten_khoa }}
                                        </option>
                                    @endforeach
                                </select>
                    @error('khoa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                            </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('thong-tin-ca-nhan') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Preview avatar when selected
        document.getElementById('avatar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.avatar-preview img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
