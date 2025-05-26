<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trường Đại học SPKT Hưng Yên</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f2f2;
        }

        header {
            background: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid red;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 80px;
            margin-right: 10px;
        }

        .logo .title h1 {
            color: red;
            font-size: 20px;
            margin: 0;
        }

        .logo .title p {
            color: #666;
            font-size: 14px;
            margin: 0;
        }

        .user-info {
            text-align: right;
            color: white;
            background-color: #234b8b;
            padding: 10px;
            border-radius: 5px;
        }

        .navbar {
            background-color: #234b8b;
            padding: 10px 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            background-color: #2c5fcf;
            border-radius: 4px;
        }

        .navbar a:hover {
            background-color: #1a4bb8;
        }

        .content {
            padding: 20px;
        }

        .article-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .article-header {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .article-title {
            color: #333;
            margin: 0 0 10px 0;
        }

        .article-meta {
            color: #666;
            font-size: 0.9em;
        }

        .article-image {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
            border-radius: 4px;
        }

        .article-content {
            color: #333;
            line-height: 1.8;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #0066cc;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
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
        <a href="{{ route('dang-ky-mon-hoc.index') }}">ĐĂNG KÍ</a>
    <a href="{{ route('dang-ky-mon-hoc.create') }}">DANH SÁCH MÔN HỌC</a>

        <a href="{{ route('thong-tin-ca-nhan') }}">THÔNG TIN CÁ NHÂN</a>
        <a href="{{ route('diem.student') }}">KẾT QUẢ HỌC TẬP</a>
    </nav>

    <main class="content">
        <div class="article-container">
            <div class="article-header">
                <h1 class="article-title">{{ $tinTuc->tieu_de }}</h1>
                <div class="article-meta">
                    Ngày đăng: {{ $tinTuc->created_at->format('d/m/Y H:i') }}
                </div>
            </div>

            @if($tinTuc->anh_dai_dien)
                <img src="{{ asset('storage/' . $tinTuc->anh_dai_dien) }}" alt="Ảnh đại diện" class="article-image">
            @endif

            <div class="article-content">
                {!! nl2br(e($tinTuc->noi_dung)) !!}
            </div>

            <a href="javascript:window.close()" class="back-link">← Quay lại</a>
        </div>
    </main>
</body>
</html>
