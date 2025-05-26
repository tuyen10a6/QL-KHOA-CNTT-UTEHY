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
            max-width: 1400px;
            margin: 0 auto;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-info {
            background-color: var(--info-color);
            color: white;
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: #212529;
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 14px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .card-header {
            background-color: var(--light-gray);
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .card-header h2 {
            margin: 0;
            color: var(--text-color);
            font-size: 20px;
            font-weight: 600;
        }

        .card-body {
            padding: 20px;
        }

        .info-item {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-item i {
            color: var(--primary-color);
            font-size: 20px;
        }

        .info-item span {
            font-weight: 500;
        }

        .info-item .value {
            color: var(--text-color);
        }

        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .badge:hover {
            transform: scale(1.05);
        }

        .bg-success {
            background-color: var(--success-color);
            color: white;
        }

        .bg-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .document-list {
            list-style: none;
            padding: 0;
        }

        .document-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.3s ease;
        }

        .document-item:last-child {
            border-bottom: none;
        }

        .document-item:hover {
            background-color: var(--light-gray);
        }

        .document-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .document-info i {
            color: var(--primary-color);
            font-size: 24px;
        }

        .document-details {
            display: flex;
            flex-direction: column;
        }

        .document-name {
            font-weight: 500;
            color: var(--text-color);
        }

        .document-date {
            font-size: 13px;
            color: #666;
        }

        .document-actions {
            display: flex;
            gap: 10px;
        }

        .btn-group {
            display: flex;
            gap: 8px;
        }

        .btn-group .btn {
            margin: 0;
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-group .btn i {
            font-size: 18px;
            line-height: 1;
        }

        .btn-group .btn:hover {
            transform: scale(1.1);
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
        <a href="{{ route('dang-ky-mon-hoc.create') }}">ĐĂNG KÍ HỌC PHẦN</a>
        <a href="{{ route('thong-tin-ca-nhan') }}">THÔNG TIN CÁ NHÂN</a>
        <a href="{{ route('diem.student') }}">KẾT QUẢ HỌC TẬP</a>
    </nav>

    <main class="content">
        <div class="container">
            <div class="header">
                <h1 class="title">Chi tiết học phần</h1>
                <div>
                    <a href="{{ route('dang-ky-mon-hoc.index') }}" class="btn btn-primary">
                        <i class="mdi mdi-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Thông tin học phần</h2>
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <i class="mdi mdi-book"></i>
                        <span>Mã môn học:</span>
                        <span class="value">{{ $dangKyMonHoc->monHoc->ma_mon_hoc }}</span>
                    </div>
                    <div class="info-item">
                        <i class="mdi mdi-book-open-page-variant"></i>
                        <span>Tên môn học:</span>
                        <span class="value">{{ $dangKyMonHoc->monHoc->ten_mon_hoc }}</span>
                    </div>
                    <div class="info-item">
                        <i class="mdi mdi-counter"></i>
                        <span>Tín chỉ:</span>
                        <span class="value">{{ $dangKyMonHoc->monHoc->tin_chi }}</span>
                    </div>
                    <div class="info-item">
                        <i class="mdi mdi-calendar"></i>
                        <span>Thứ:</span>
                        <span class="value">{{ $dangKyMonHoc->thu }}</span>
                    </div>
                    <div class="info-item">
                        <i class="mdi mdi-clock"></i>
                        <span>Tiết học:</span>
                        <span class="value">{{ $dangKyMonHoc->tiet_bat_dau }}-{{ $dangKyMonHoc->tiet_ket_thuc }}</span>
                    </div>
                    <div class="info-item">
                        <i class="mdi mdi-office-building"></i>
                        <span>Phòng học:</span>
                        <span class="value">{{ $dangKyMonHoc->phong_hoc }}</span>
                    </div>
                    <div class="info-item">
                        <i class="mdi mdi-account"></i>
                        <span>Giảng viên:</span>
                        <span class="value">{{ $dangKyMonHoc->giang_vien }}</span>
                    </div>
                    <div class="info-item">
                        <i class="mdi mdi-check-circle"></i>
                        <span>Trạng thái:</span>
                        @if($dangKyMonHoc->trang_thai == 1)
                            <span class="badge bg-success">Đã đăng ký</span>
                        @else
                            <span class="badge bg-danger">Đã hủy</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Tài liệu học phần</h2>
                </div>
                <div class="card-body">
                    @if($dangKyMonHoc->monHoc->document)
                        <ul class="document-list">
                            <li class="document-item">
                                <div class="document-info">
                                    <i class="mdi mdi-file-document"></i>
                                    <div class="document-details">
                                        <span class="document-name">{{ basename($dangKyMonHoc->monHoc->document) }}</span>
                                        <span class="document-date">Cập nhật: {{ date('d/m/Y', strtotime($dangKyMonHoc->monHoc->updated_at)) }}</span>
                                    </div>
                                </div>
                                <div class="document-actions">
                                    <a href="{{ asset('storage/' . $dangKyMonHoc->monHoc->document) }}" class="btn btn-primary btn-sm" target="_blank">
                                        <i class="mdi mdi-eye"></i> Xem
                                    </a>
                                    <a href="{{ asset('storage/' . $dangKyMonHoc->monHoc->document) }}" class="btn btn-info btn-sm" download>
                                        <i class="mdi mdi-download"></i> Tải xuống
                                    </a>
                                </div>
                            </li>
                        </ul>
                    @else
                        <p>Chưa có tài liệu học phần.</p>
                    @endif
                </div>
            </div>
        </div>
    </main>
</body>
</html>
