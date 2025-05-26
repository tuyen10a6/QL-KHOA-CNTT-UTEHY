<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thông báo khẩn cấp</title>
</head>
<body>
<h1>Xin chào {{ $user->ten_dang_nhap }},</h1>
<p>Bạn có một cảnh báo khẩn cấp với nội dung sau:</p>
<p><strong>Tiêu đề:</strong> {{ $tieu_de }}</p>
<p><strong>Nội dung:</strong> {{ $noi_dung }}</p>
<p>Vui lòng kiểm tra và thực hiện hành động nếu cần thiết.</p>
<p>Trân trọng,</p>
<p>Đội ngũ quản trị</p>
</body>
</html>
