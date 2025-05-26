<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách môn học - Trường Đại học SPKT Hưng Yên</title>
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

        .search-filter {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .search-box, .filter-box {
            margin-bottom: 15px;
        }

        .search-box input, .filter-box select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .course-card {
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .course-card.registered {
            border: 2px solid #28a745;
        }

        .course-header {
            background: #234b8b;
            color: white;
            padding: 15px;
        }

        .course-header h3 {
            margin: 0;
            font-size: 18px;
        }

        .course-body {
            padding: 15px;
        }

        .course-info {
            margin-bottom: 10px;
        }

        .course-info p {
            margin: 5px 0;
            display: flex;
            align-items: center;
        }

        .course-info i {
            margin-right: 10px;
            color: #234b8b;
            width: 20px;
        }

        .course-footer {
            padding: 15px;
            background: #f8f9fa;
            text-align: center;
        }

        .btn-register {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .btn-register:disabled {
            background: #6c757d;
            cursor: not-allowed;
        }

        .btn-registered {
            background: #6c757d;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: not-allowed;
            width: 100%;
        }

        @media (max-width: 768px) {
            .course-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

    <div class="content">
        <div class="search-filter">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Tìm kiếm môn học...">
            </div>
            <div class="filter-box">
                <select id="khoaFilter">
                    <option value="">Tất cả khoa</option>
                    @php
                        $uniqueKhoa = collect($lichHocMonHoc)->pluck('monHoc.khoa')->unique('id');
                    @endphp
                    @foreach($uniqueKhoa as $k)
                        <option value="{{ $k->id }}">{{ $k->ten_khoa }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if(session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <div class="course-grid" id="courseCards">
            @foreach($lichHocMonHoc as $lichHoc)
                @php
                    $daDangKy = $dangKyMonHoc->contains(function($item) use ($lichHoc) {
                        return $item->lich_hoc_mon_hoc_id == $lichHoc->id;
                    });
                @endphp
                <div class="course-card {{ $daDangKy ? 'registered' : '' }}" data-khoa-id="{{ $lichHoc->monHoc->khoa_id }}">
                    <div class="course-header">
                        <h3>{{ $lichHoc->monHoc->ten_mon_hoc }}</h3>
                    </div>
                    <div class="course-body">
                        <div class="course-info">
                            <p><i class="fas fa-book"></i> Mã môn: {{ $lichHoc->monHoc->ma_mon_hoc }}</p>
                            <p><i class="fas fa-university"></i> Khoa: {{ $lichHoc->monHoc->khoa->ten_khoa }}</p>
                            <p><i class="fas fa-clock"></i> Thứ: {{ $lichHoc->thu }}</p>
                            <p><i class="fas fa-calendar-alt"></i> Tiết: {{ $lichHoc->tiet_bat_dau }} - {{ $lichHoc->tiet_ket_thuc }}</p>
                            <p><i class="fas fa-building"></i> Phòng: {{ $lichHoc->phong_hoc }}</p>
                            <p><i class="fas fa-chalkboard-teacher"></i> GV: {{ $lichHoc->giangVien->ten }}</p>
                            <p><i class="fas fa-users"></i> Đã đăng ký: {{ $lichHoc->so_luong_sv_da_dang_ky }}/{{ $lichHoc->so_luong_sv_toi_da }}</p>
                        </div>
                    </div>
                    <div class="course-footer">
                        @if($daDangKy)
                            <button class="btn-registered" disabled>
                                <i class="fas fa-check-circle"></i> Đã đăng ký
                            </button>
                        @else
                            <form action="{{ route('dang-ky-mon-hoc.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="lich_hoc_mon_hoc_id" value="{{ $lichHoc->id }}">
                                <button type="submit" class="btn-register"
                                    {{ $lichHoc->so_luong_sv_da_dang_ky >= $lichHoc->so_luong_sv_toi_da ? 'disabled' : '' }}>
                                    <i class="fas fa-plus-circle"></i> Đăng ký
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const khoaFilter = document.getElementById('khoaFilter');
            const courseCards = document.querySelectorAll('.course-card');

            function filterCourses() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedKhoa = khoaFilter.value;

                courseCards.forEach(card => {
                    const courseTitle = card.querySelector('.course-header h3').textContent.toLowerCase();
                    const courseCode = card.querySelector('.course-info p:nth-child(1)').textContent.toLowerCase();
                    const lecturer = card.querySelector('.course-info p:nth-child(6)').textContent.toLowerCase();
                    const khoaId = card.getAttribute('data-khoa-id');

                    const matchesSearch = courseTitle.includes(searchTerm) ||
                                        courseCode.includes(searchTerm) ||
                                        lecturer.includes(searchTerm);
                    const matchesKhoa = !selectedKhoa || khoaId === selectedKhoa;

                    if (matchesSearch && matchesKhoa) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterCourses);
            khoaFilter.addEventListener('change', filterCourses);
        });
    </script>
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
