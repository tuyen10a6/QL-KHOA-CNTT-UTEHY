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

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 30px;
            border-radius: 8px;
            overflow: hidden;
        }

        .table th, .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table th {
            background-color: var(--light-gray);
            font-weight: 600;
            color: var(--text-color);
            text-transform: uppercase;
            font-size: 14px;
        }

        .table tr {
            transition: background-color 0.3s ease;
        }

        .table tr:hover {
            background-color: var(--light-gray);
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

        .alert {
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-10px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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

        .btn-group .btn-warning {
            background-color: var(--warning-color);
            color: #212529;
        }

        .btn-group .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-group .btn:hover {
            transform: scale(1.1);
        }

        .table-responsive {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: var(--light-gray);
            border-radius: 4px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #1a4bb8;
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
                <h1 class="title">Danh sách đăng ký môn học</h1>
                <div>
                    @if($dangKyMonHoc->isEmpty())
                        <a href="{{ route('dang-ky-mon-hoc.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Đăng ký môn học mới
                        </a>
                    @endif
                    <a href="{{ route('dang-ky-mon-hoc.lich-hoc') }}" class="btn btn-info">
                        <i class="mdi mdi-calendar"></i> Xem lịch học
                    </a>
                </div>
            </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                <table class="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã môn học</th>
                                        <th>Tên môn học</th>
                                        <th>Thứ</th>
                                        <th>Tiết học</th>
                                        <th>Phòng học</th>
                                        <th>Giảng viên</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dangKyMonHoc as $key => $dk)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dk->monHoc->ma_mon_hoc }}</td>
                                            <td>
                                                <a href="{{ route('dang-ky-mon-hoc.show', $dk->id) }}" class="text-primary">
                                                    {{ $dk->monHoc->ten_mon_hoc }}
                                                </a>
                                            </td>
                                            <td>{{ $dk->thu }}</td>
                                            <td>{{ $dk->tiet_bat_dau }}-{{ $dk->tiet_ket_thuc }}</td>
                                            <td>{{ $dk->phong_hoc }}</td>
                                            <td>{{ $dk->giang_vien }}</td>
                                            <td>
                                                @if($dk->trang_thai == 1)
                                                    <span class="badge bg-success">Đã đăng ký</span>
                                                @else
                                                    <span class="badge bg-danger">Đã hủy</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <form action="{{ route('dang-ky-mon-hoc.destroy', $dk->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn hủy đăng ký môn học này?')" title="Xóa">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
