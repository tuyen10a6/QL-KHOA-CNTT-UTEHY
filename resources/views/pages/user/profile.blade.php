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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .title {
            color: var(--text-color);
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        .btn-edit {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #1a4bb8;
            transform: translateY(-2px);
            color: white;
        }

        .profile-content {
            display: flex;
            gap: 30px;
        }

        .profile-sidebar {
            flex: 0 0 300px;
            text-align: center;
        }

        .profile-avatar {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
        }

        .profile-name {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .profile-role {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .profile-main {
            flex: 1;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .info-item {
            background: var(--light-gray);
            padding: 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .info-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 500;
        }

        .info-value.empty {
            color: #999;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .content {
                padding: 15px;
            }

            .container {
                padding: 20px;
            }

            .profile-content {
                flex-direction: column;
            }

            .profile-sidebar {
                flex: none;
                margin-bottom: 30px;
            }

            .info-grid {
                grid-template-columns: 1fr;
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
            <span>{{ $user->ten }}</span><br>
            <small>{{ $user->vaiTro->ten_vai_tro }}</small>
        </div>
    </header>

    <nav class="navbar">
        <a href="/dashboard">TRANG CHỦ</a>
        <a href="{{ route('dang-ky-mon-hoc.index') }}">LỊCH SỬ ĐĂNG KÍ HỌC PHẦN</a>
    <a href="{{ route('dang-ky-mon-hoc.create') }}">ĐĂNG KÍ HỌC PHẦN</a>
        <a href="{{ route('thong-tin-ca-nhan') }}">THÔNG TIN CÁ NHÂN</a>
        <a href="{{ route('diem.student') }}">KẾT QUẢ HỌC TẬP</a>
        <div style="position: relative; display: inline-block; margin-top: 10px">
            <a href="#" onclick="toggleDropdown(event)" style="cursor: pointer; padding: 14px 5px">NGÀNH HỌC</a>
            <ul id="nganhDropdown"
                style="display: none; position: absolute; background: white; border: 1px solid #ccc; padding: 10px; list-style: none; z-index: 1000; width: 250px; border-radius: 20px">
                @foreach($nganhs as $nganh)
                    <li style="padding: 5px 10px;">
                        <a style="background: white; color: black" href="{{route('student.chuyen-nganh.by.nganh', $nganh->id)}}">{{ $nganh->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
    <main class="content">
        <div class="container">
            <div class="header">
                <h1 class="title">Thông tin cá nhân</h1>
                <a href="{{ route('thong-tin-ca-nhan.edit') }}" class="btn-edit">
                    <i class="mdi mdi-pencil"></i>
                    Chỉnh sửa
                </a>
            </div>

            <div class="profile-content">
                <div class="profile-sidebar">
                    @if($user->avatar)
                        <img src="{{ asset('assets/images/avatars/' . $user->avatar) }}" alt="Avatar" class="profile-avatar">
                    @else
                        <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="Avatar" class="profile-avatar">
                    @endif
                    <h3 class="profile-name">{{ $user->ten }}</h3>
                    <p class="profile-role">{{ $user->vaiTro->ten_vai_tro }}</p>
                </div>

                <div class="profile-main">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $user->email }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Số điện thoại</div>
                            <div class="info-value {{ !$user->sdt ? 'empty' : '' }}">
                                {{ $user->sdt ?? 'Chưa cập nhật' }}
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">CCCD</div>
                            <div class="info-value {{ !$user->cccd ? 'empty' : '' }}">
                                {{ $user->cccd ?? 'Chưa cập nhật' }}
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Giới tính</div>
                            <div class="info-value {{ !$user->gioi_tinh ? 'empty' : '' }}">
                                @if($user->gioi_tinh == 'nam')
                                    Nam
                                @elseif($user->gioi_tinh == 'nu')
                                    Nữ
                                @else
                                    Chưa cập nhật
                                @endif
                            </div>
                        </div>
                        <div class="info-item" style="grid-column: span 2;">
                            <div class="info-label">Khoa</div>
                            <div class="info-value {{ !$user->khoa ? 'empty' : '' }}">
                                {{ $user->khoa ? $user->khoa->ten_khoa : 'Chưa cập nhật' }}
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Ngày tạo tài khoản</div>
                            <div class="info-value">
                                {{ $user->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function toggleDropdown(event) {
            event.preventDefault();
            const dropdown = document.getElementById('nganhDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        // Đóng dropdown nếu bấm ra ngoài
        document.addEventListener('click', function (event) {
            const dropdown = document.getElementById('nganhDropdown');
            const button = event.target.closest('a[href="#"]');

            if (!dropdown.contains(event.target) && !button) {
                dropdown.style.display = 'none';
            }
        });
    </script>
</body>
</html>
