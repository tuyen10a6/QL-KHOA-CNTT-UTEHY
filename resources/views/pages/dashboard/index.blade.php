<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Trường Đại học SPKT Hưng Yên</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
      padding: 8px 40px 8px 12px;
      border-radius: 6px;
      position: relative;
    }

    .user-info span {
      display: block;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 2px;
    }

    .user-info small {
      font-size: 11px;
      opacity: 0.9;
    }

    .logout-btn {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
      text-decoration: none;
      width: 24px;
      height: 24px;
      border-radius: 4px;
      transition: all 0.3s ease;
    }

    .logout-btn:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }

    .logout-btn i {
      font-size: 14px;
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
      display: grid;
      grid-template-columns: 2fr 2fr 1fr;
      gap: 20px;
      padding: 20px;
    }

    .news, .announcements, .video {
      background-color: white;
      padding: 15px;
      border: 1px solid #ccc;
      border-top: 4px solid #f39c12;
    }

    h2 {
      margin-top: 0;
    }

    ul {
      list-style: none;
      padding-left: 0;
    }

    li {
      padding: 8px 0;
      border-bottom: 1px dotted #ccc;
      font-size: 14px;
    }

    .date {
      float: right;
      color: gray;
      font-size: 12px;
    }

    .highlight {
      float: right;
      color: red;
      font-weight: bold;
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
        <span>{{ auth()->user()->ten }}</span>
        <small>{{ auth()->user()->vaiTro->ten_vai_tro }}</small>
        <form id="logout-form" action="{{ route('dang-xuat') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="logout-btn" title="Đăng xuất">
            <i class="fa-solid fa-right-from-bracket"></i>
        </a>
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
    <section class="news">
      <h2>📰 TIN TỨC MỚI NHẤT</h2>
      <ul>
        @foreach($tinTuc as $tin)
            <li>
                <a href="{{ route('tin-tuc.view', $tin->id) }}" class="text-dark" target="_blank">
                    {{ $tin->tieu_de }}
                </a>
                <span class="date">{{ $tin->created_at->format('d/m/Y') }}</span>
            </li>
        @endforeach
      </ul>
    </section>

    <section class="announcements">
      <h2>📣 THÔNG BÁO</h2>
      <ul>
        @forelse($notifications as $notification)
          <li>
            <a href="{{ route('thongbao.view', $notification->id) }}" class="text-dark" target="_blank">
              {{ $notification->tieu_de }}
            </a>
            <span class="{{ $notification->loai_thong_bao === 'Cảnh báo khẩn cấp' ? 'highlight' : 'date' }}">
              {{ $notification->created_at->format('d/m/Y') }}
            </span>
          </li>
        @empty
          <li>Không có thông báo nào</li>
        @endforelse
      </ul>
    </section>

    <section class="video">
      <h2>🎬 VIDEO HƯỚNG DẪN</h2>
      <iframe width="100%" height="240"
  src="https://www.youtube.com/embed/NZ03vaNSCLI?start=8"
  frameborder="0"
  allowfullscreen></iframe>
    </section>
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
