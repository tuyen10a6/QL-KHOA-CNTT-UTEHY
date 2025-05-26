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
            --course-bg: #e3f2fd;
            --course-code: #1976d2;
            --course-room-bg: #bbdefb;
            --course-room-text: #0d47a1;
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
        }

        .title {
            color: var(--text-color);
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        .schedule-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .schedule-table th {
            background-color: var(--light-gray);
            color: var(--text-color);
            font-weight: 600;
            padding: 15px;
            text-align: center;
            text-transform: uppercase;
            font-size: 14px;
            border: 1px solid var(--border-color);
        }

        .schedule-table td {
            padding: 12px;
            border: 1px solid var(--border-color);
            vertical-align: top;
            min-height: 120px;
        }

        .time-cell {
            background-color: var(--light-gray);
            font-weight: 600;
            text-align: center;
            width: 10%;
        }

        .time-cell small {
            display: block;
            color: #666;
            font-size: 12px;
            margin-top: 5px;
        }

        .time-slot {
            min-height: 120px;
        }

        .course-card {
            background-color: var(--course-bg);
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .course-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .course-code {
            font-weight: 600;
            color: var(--course-code);
            font-size: 14px;
        }

        .course-room {
            background-color: var(--course-room-bg);
            color: var(--course-room-text);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .course-title {
            font-weight: 500;
            margin: 8px 0;
            color: var(--text-color);
            font-size: 14px;
        }

        .course-instructor {
            font-size: 13px;
            color: #666;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .course-instructor i {
            color: var(--course-code);
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

        @media (max-width: 768px) {
            .content {
                padding: 15px;
            }

            .container {
                padding: 20px;
            }

            .schedule-table {
                font-size: 13px;
            }

            .course-card {
                padding: 10px;
            }

            .course-title {
                font-size: 13px;
            }

            .course-instructor {
                font-size: 12px;
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
    <a href="{{ route('dang-ky-mon-hoc.create') }}">ĐĂNG KÍ HỌC PHẦN</a>

        <a href="{{ route('thong-tin-ca-nhan') }}">THÔNG TIN CÁ NHÂN</a>
        <a href="{{ route('diem.student') }}">KẾT QUẢ HỌC TẬP</a>
    </nav>

    <main class="content">
        <div class="container">
            <div class="header">
                <h1 class="title">Lịch học</h1>
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
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%">Tiết</th>
                            <th class="text-center" style="width: 15%">Thứ 2</th>
                            <th class="text-center" style="width: 15%">Thứ 3</th>
                            <th class="text-center" style="width: 15%">Thứ 4</th>
                            <th class="text-center" style="width: 15%">Thứ 5</th>
                            <th class="text-center" style="width: 15%">Thứ 6</th>
                            <th class="text-center" style="width: 15%">Thứ 7</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $thu = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
                            $tiet = [
                                '1-4' => [1, 4],
                                '5-8' => [5, 8],
                                '9-12' => [9, 12],
                                '13-16' => [13, 16]
                            ];
                        @endphp

                        @foreach($tiet as $tietHoc => $tietRange)
                            <tr>
                                <td class="time-cell">
                                    Tiết {{ $tietHoc }}<br>
                                    <small>
                                        @if($tietHoc === '1-4')
                                            7:00 - 10:00
                                        @elseif($tietHoc === '5-8')
                                            10:30 - 13:30
                                        @elseif($tietHoc === '9-12')
                                            14:00 - 17:00
                                        @else
                                            17:30 - 20:30
                                        @endif
                                    </small>
                                </td>
                                @foreach($thu as $t)
                                    <td class="time-slot">
                                        @foreach($dangKyMonHoc as $dk)
                                            @php
                                                $dkThu = (int)str_replace('Thứ ', '', $dk->thu);
                                                $currentThu = (int)str_replace('Thứ ', '', $t);
                                                $isSameDay = $dkThu === $currentThu;
                                                $isInTimeRange = $dk->tiet_bat_dau <= $tietRange[1] && $dk->tiet_ket_thuc >= $tietRange[0];
                                            @endphp
                                            @if($isSameDay && $isInTimeRange)
                                                <div class="course-card">
                                                    <div class="course-header">
                                                        <span class="course-code">{{ $dk->monHoc->ma_mon_hoc }}</span>
                                                        <span class="course-room">{{ $dk->phong_hoc }}</span>
                                                    </div>
                                                    <div class="course-title">{{ $dk->monHoc->ten_mon_hoc }}</div>
                                                    <div class="course-instructor">
                                                        <i class="mdi mdi-account"></i>
                                                        {{ $dk->lichHoc->giangVien->ten }}
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
