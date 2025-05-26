<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin chuyên ngành</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .container {
            width: 90%;
            margin: auto;
        }
        .text-center {
            text-align: center;
        }
        .logo {
            width: 100px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }
    </style>
</head>
<body onload="window.print()">
<div class="container">
    <div class="text-center">
        <img src="{{ asset('assets/images/logoQLCT.jpg') }}" alt="Logo Trường" class="logo">
        <h2>Thông Tin Chi Tiết Chuyên Ngành</h2>
    </div>

    <h3>Tên chuyên ngành: {{ $chuyenNganh->ten_chuyen_nganh }}</h3>

    <table>
        <thead>
        <tr>
            <th>Mã môn</th>
            <th>Tên môn</th>
            <th>Tín chỉ</th>
            <th>Giáo viên giảng dạy</th>
        </tr>
        </thead>
        <tbody>
        @foreach($chuyenNganh->monHoc as $mon)
            <tr>
                <td>{{ $mon->ma_mon_hoc }}</td>
                <td>{{ $mon->ten_mon_hoc }}</td>
                <td>{{ $mon->tin_chi }}</td>
                <td>
                    @if($mon->giangViens->count())
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach($mon->giangViens as $gv)
                                <li>{{ $gv->ten }}</li>
                            @endforeach
                        </ul>
                    @else
                        Không có
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <table style="width: 100%; margin-top: 60px;">
        <tr>
            <td style="text-align: center;">
                Người lập bảng<br><br><br>
                (Ký và ghi rõ họ tên)
            </td>
            <td></td>
            <td style="text-align: center;">
                Trưởng Khoa<br><br><br>
                (Ký và đóng dấu)
            </td>
        </tr>
    </table>
</div>
</body>
<footer style="margin-top: 40px; text-align: center; font-size: 13px; color: #555;">
    <hr>
    <p>
        Trường Đại học SPKT Hưng  - Khoa Công nghệ Thông tin<br>
        Website: www.utehy.edu.vn | Email: info@utehy.edu.vn | ĐT: 0123 456 789
    </p>
    <p>
        Tài liệu được in từ hệ thống quản lý chuyên ngành. Ngày in: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
    </p>
</footer>

</html>
