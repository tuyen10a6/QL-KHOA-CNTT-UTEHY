<!DOCTYPE html>
<html>
<head>
    <title>Yêu cầu đăng ký đã bị từ chối</title>
</head>
<body>
    <h2>Yêu cầu đăng ký đã bị từ chối</h2>
    <p>Rất tiếc, yêu cầu đăng ký tài khoản của bạn đã bị từ chối. Dưới đây là thông tin yêu cầu của bạn:</p>
    
    <ul>
        <li>Tên đăng nhập: {{ $userData['tên_đăng_nhập'] }}</li>
        <li>Email: {{ $userData['email'] }}</li>
    </ul>

    <p>Vui lòng liên hệ với quản trị viên để biết thêm chi tiết về lý do từ chối.</p>
    <p>Trân trọng,</p>
    <p>Ban quản trị hệ thống</p>
</body>
</html> 