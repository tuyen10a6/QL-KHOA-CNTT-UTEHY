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
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --table-header-bg: #f8f9fa;
            --table-row-hover: #f1f3f5;
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        .table-container {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .score-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .score-table th {
            background-color: var(--table-header-bg);
            color: var(--text-color);
            font-weight: 600;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid var(--border-color);
            font-size: 14px;
            text-transform: uppercase;
        }

        .score-table td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
            transition: background-color 0.3s ease;
        }

        .score-table tr:hover td {
            background-color: var(--table-row-hover);
        }

        .score-table tr:last-child td {
            border-bottom: none;
        }

        .score-value {
            font-weight: 500;
            color: var(--text-color);
        }

        .score-value.empty {
            color: #999;
            font-style: italic;
        }

        .score-value.passed {
            color: var(--success-color);
        }

        .score-value.failed {
            color: var(--danger-color);
        }

        @media (max-width: 768px) {
            .content {
                padding: 15px;
            }

            .container {
                padding: 20px;
            }

            .score-table th,
            .score-table td {
                padding: 10px;
                font-size: 13px;
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

<nav class="navbar" style="position: relative;">
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
<div class="content">
    <h2 style="font-size: 24px; margin-bottom: 20px;">Danh sách môn học theo chuyên ngành</h2>

    <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
        <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="border: 1px solid #ddd; padding: 10px;">STT</th>
            <th style="border: 1px solid #ddd; padding: 10px;">Tên môn học</th>
            <th style="border: 1px solid #ddd; padding: 10px;">Mã môn</th>
            <th style="border: 1px solid #ddd; padding: 10px;">Số tín chỉ</th>
            <th style="border: 1px solid #ddd; padding: 10px;">GV giảng dậy</th>
            <th style="border: 1px solid #ddd; padding: 10px;">Mô tả</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($monHoc as $index => $mh)
            <tr>
                <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #ddd; padding: 10px;">{{ $mh->ten_mon_hoc }}</td>
                <td style="border: 1px solid #ddd; padding: 10px;">{{ $mh->ma_mon_hoc }}</td>
                <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">{{ $mh->tin_chi }}</td>
                <td style="border: 1px solid #ddd; padding: 10px;">
                    @if ($mh->giangViens->isNotEmpty())
                        <ul style="margin: 0; padding-left: 18px;">
                            @foreach($mh->giangViens as $gv)
                                <li>{{ $gv->ten }}</li>
                            @endforeach
                        </ul>
                    @else
                        <span>Chưa có giảng viên</span>
                    @endif
                </td>
                <td style="border: 1px solid #ddd; padding: 10px; max-width: 400px; overflow-wrap: break-word; word-break: break-word;">
                    {{ $mh->ghi_chu }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 15px;">Không có môn học nào.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
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
