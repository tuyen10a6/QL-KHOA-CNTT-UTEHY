<!DOCTYPE html>
<html>
<head>
    <title>Yêu cầu đăng ký đã được phê duyệt</title>
</head>
<body>
    <h2>Yêu cầu đăng ký đã được phê duyệt</h2>
    <p>Yêu cầu đăng ký tài khoản của bạn đã được phê duyệt. Dưới đây là thông tin tài khoản của bạn:</p>
    
    <ul>
        <li>Tên đăng nhập: {{ $userData['tên_đăng_nhập'] }}</li>
        <li>Email: {{ $userData['email'] }}</li>
        <li>Mật khẩu: {{ $userData['mật_khẩu'] }}</li>
    </ul>

    <p>Bạn có thể đăng nhập vào hệ thống bằng thông tin trên.</p>
    <p>Trân trọng,</p>
    <p>Ban quản trị hệ thống</p>
</body>
</html> 