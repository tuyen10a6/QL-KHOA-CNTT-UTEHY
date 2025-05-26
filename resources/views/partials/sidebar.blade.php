<style>
    /* Override all default sidebar styles */
    .sidebar,
    .sidebar-offcanvas,
    .sidebar .nav,
    .sidebar .nav-item,
    .sidebar .nav-link,
    .sidebar .sub-menu,
    .sidebar .sub-menu .nav-link {
        background-color: var(--secondary-color) !important;
    }

    .sidebar .nav-link,
    .sidebar .sub-menu .nav-link {
        color: #ffffff !important;
        transition: color 0.3s ease, background-color 0.3s ease;
        padding: 10px 15px;
    }

    .sidebar .nav-link:hover,
    .sidebar .sub-menu .nav-link:hover,
    .sidebar .nav-link:focus,
    .sidebar .sub-menu .nav-link:focus,
    .sidebar .nav-item:hover .nav-link,
    .sidebar .nav-item:focus .nav-link {
        color: var(--warning-color) !important;
        background-color: var(--primary-color) !important;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .sidebar .menu-title {
        color: #ffffff !important;
        font-size: 1.1em;
        font-weight: 600;
    }

    .sidebar .nav-link i {
        color: #ffffff !important;
        font-size: 1.2em;
        margin-right: 10px;
        transition: color 0.3s ease;
    }

    .sidebar .nav-link:hover i,
    .sidebar .nav-link:focus i,
    .sidebar .nav-item:hover .nav-link i,
    .sidebar .nav-item:focus .nav-link i {
        color: var(--warning-color) !important;
    }

    .sidebar .collapse {
        background-color: var(--primary-color) !important;
    }

    .sidebar .sub-menu .nav-link {
        color: #ffffff !important;
    }

    .sidebar .sub-menu .nav-link:hover,
    .sidebar .sub-menu .nav-link:focus {
        color: var(--warning-color) !important;
    }

    .sidebar .nav-link.active {
        background-color: var(--warning-color) !important;
        color: #000 !important;
        font-weight: bold;
    }

    .sidebar .nav-link.active i {
        color: #000 !important;
    }

    .sidebar-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .sidebar-header img {
        max-width: 100px;
    }

    /* Override default template styles */
    .sidebar .nav-item .nav-link:hover,
    .sidebar .nav-item .nav-link:focus {
        background: var(--primary-color) !important;
        color: var(--warning-color) !important;
    }

    .sidebar .nav-item .nav-link:hover i,
    .sidebar .nav-item .nav-link:focus i {
        color: var(--warning-color) !important;
    }

    .sidebar .nav-item .nav-link:hover .menu-title,
    .sidebar .nav-item .nav-link:focus .menu-title {
        color: var(--warning-color) !important;
    }

    .sidebar .nav-item .nav-link.active {
        background: var(--warning-color) !important;
        color: #000 !important;
    }

    .sidebar .nav-item .nav-link.active i,
    .sidebar .nav-item .nav-link.active .menu-title {
        color: #000 !important;
    }

    /* Additional overrides for submenu */
    .sidebar .collapse.show {
        background-color: var(--primary-color) !important;
    }

    .sidebar .sub-menu .nav-link:hover,
    .sidebar .sub-menu .nav-link:focus {
        background-color: var(--primary-color) !important;
    }
</style>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
          <a class="nav-link" href="http://127.0.0.1:8000/">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
          </a>
      </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#thiet-bi" aria-expanded="false" aria-controls="thiet-bi">
                <i class="fa-solid fa-fire-extinguisher" style="padding-right: 15px"></i>
                <span class="menu-title" style="padding-right:20px">Thiết bị PCCC</span>
                <i class="fa-solid fa-caret-down"></i>
            </a>
            <div class="collapse" id="thiet-bi">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('danh-sach-thiet-bi') }}">Danh sách</a></li>
                    @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
                    <li class="nav-item"> <a class="nav-link" href="{{ route('thiet-bi.create') }}">Thêm</a></li>
                    @endif
                    @if(auth()->user()->canCreateDevice())
                        <li class="nav-item"> <a class="nav-link" href="{{ route('thiet-bi.create') }}">Thêm</a></li>
                    @endif
                </ul>
            </div>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#thong-bao" aria-expanded="false" aria-controls="thong-bao">
                <i class="fa-solid fa-bell" style="padding-right: 15px"></i>
                <span class="menu-title" style="padding-right:20px">Thông báo</span>
                <i class="fa-solid fa-caret-down"></i>
            </a>
            <div class="collapse" id="thong-bao">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('thongbao.index') }}">Danh sách</a></li>
                    @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
                    <li class="nav-item"> <a class="nav-link" href="{{ route('thongbao.create') }}">Thêm</a></li>
                    @endif
                    @if(auth()->user()->canCreateNotification())
                        <li class="nav-item"> <a class="nav-link" href="{{ route('thongbao.create') }}">Thêm</a></li>
                    @endif
                </ul>
            </div>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#lich-bao-tri" aria-expanded="false" aria-controls="lich-bao-tri">
                <i class="fa-solid fa-calendar-days" style="padding-right:20px"></i>
                <span class="menu-title" style="padding-right:20px">Lịch bảo trì</span>
                <i class="fa-solid fa-caret-down"></i>
            </a>
            <div class="collapse" id="lich-bao-tri">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('lich-kiem-tra') }}">Danh sách</a></li>
                    @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
                    <li class="nav-item"> <a class="nav-link" href="{{ route('lich-kiem-tra.create') }}">Thêm</a></li>
                    @endif
                    @if(auth()->user()->canCreateSchedule())
                        <li class="nav-item"> <a class="nav-link" href="{{ route('lich-kiem-tra.create') }}">Thêm</a></li>
                    @endif
                </ul>
            </div>
        </li> -->
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#nguoi-dung" aria-expanded="false" aria-controls="nguoi-dung">
            <i class="fa-solid fa-user" style="padding-right:20px"></i>
            <span class="menu-title" style="padding-right:20px">Người dùng</span>
            <i class="fa-solid fa-caret-down" ></i>
        </a>
        <div class="collapse" id="nguoi-dung">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/admin/danh-sach-nguoi-dung">Danh sách</a></li>
              @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
                  <li class="nav-item"> <a class="nav-link" href="{{ route('nguoi-dung.create') }}"> Thêm </a></li>
              @endif
              @if(auth()->user()->canCreateUser())
                  <li class="nav-item"> <a class="nav-link" href="{{ route('nguoi-dung.create') }}"> Thêm </a></li>
              @endif
          </ul>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#bao-cao" aria-expanded="false" aria-controls="bao-cao">
            <i class="fa-solid fa-file-lines" style="padding-right:20px"></i>
            <span class="menu-title " style="padding-right:20px">Báo cáo</span>
            <i class="fa-solid fa-caret-down"></i>
        </a>
        <div class="collapse" id="bao-cao">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('baocao.index') }}"> Danh sách </a></li>
              @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
                <li class="nav-item"> <a class="nav-link" href="{{ route('baocao.create') }}"> Thêm </a></li>
              @endif
              @if(auth()->user()->canCreateReport())
                  <li class="nav-item"> <a class="nav-link" href="{{ route('baocao.create') }}"> Thêm </a></li>
              @endif
          </ul>
        </div>
      </li> -->

      @if(auth()->user()->vaiTro->ten_vai_tro == 'admin' || auth()->user()->vaiTro->ten_vai_tro == 'lecturer')
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#khoa" aria-expanded="false" aria-controls="khoa">
            <i class="fa-solid fa-building-columns" style="padding-right:20px"></i>
            <span class="menu-title" style="padding-right:20px">Quản lý khoa</span>
            <i class="fa-solid fa-caret-down"></i>
        </a>
        <div class="collapse" id="khoa">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/admin/danh-sach-khoa"> Danh sách khoa </a></li>
            @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
            <li class="nav-item"> <a class="nav-link" href="/admin/khoa/them"> Thêm khoa </a></li>
            @endif
          </ul>
        </div>
      </li>

      @endif

{{--      @if(auth()->user()->vaiTro->ten_vai_tro == 'admin' || auth()->user()->vaiTro->ten_vai_tro == 'subAdmin')--}}
{{--      <li class="nav-item">--}}
{{--        <a class="nav-link" data-toggle="collapse" href="#mon-hoc" aria-expanded="false" aria-controls="mon-hoc">--}}
{{--            <i class="fa-solid fa-book" style="padding-right:20px"></i>--}}
{{--            <span class="menu-title" style="padding-right:20px">Quản lý học phần</span>--}}
{{--            <i class="fa-solid fa-caret-down"></i>--}}
{{--        </a>--}}
{{--        <div class="collapse" id="mon-hoc">--}}
{{--          <ul class="nav flex-column sub-menu">--}}
{{--            <li class="nav-item"> <a class="nav-link" href="/admin/danh-sach-mon-hoc"> Danh sách môn học </a></li>--}}
{{--            <li class="nav-item"> <a class="nav-link" href="{{ route('monhoc.create') }}"> Thêm môn học </a></li>--}}
{{--          </ul>--}}
{{--        </div>--}}
{{--      </li>--}}

{{--      <li class="nav-item">--}}
{{--        <a class="nav-link" data-toggle="collapse" href="#lich-hoc" aria-expanded="false" aria-controls="lich-hoc">--}}
{{--            <i class="fa-solid fa-calendar" style="padding-right:20px"></i>--}}
{{--            <span class="menu-title" style="padding-right:20px">Quản lý lịch học</span>--}}
{{--            <i class="fa-solid fa-caret-down"></i>--}}
{{--        </a>--}}
{{--        <div class="collapse" id="lich-hoc">--}}
{{--          <ul class="nav flex-column sub-menu">--}}
{{--            <li class="nav-item"> <a class="nav-link" href="/admin/lich-hoc-mon-hoc"> Danh sách lịch học </a></li>--}}
{{--            @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')--}}
{{--            <li class="nav-item"> <a class="nav-link" href="/admin/lich-hoc-mon-hoc/create"> Thêm lịch học </a></li>--}}
{{--            @endif--}}
{{--          </ul>--}}
{{--        </div>--}}
{{--      </li>--}}

{{--      @endif--}}

      @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')

      @elseif(auth()->user()->vaiTro->ten_vai_tro == 'student')
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#dang-ky-mon-hoc" aria-expanded="false" aria-controls="dang-ky-mon-hoc">
              <i class="fa-solid fa-pen-to-square" style="padding-right:20px"></i>
              <span class="menu-title" style="padding-right:20px">Đăng ký môn học</span>
              <i class="fa-solid fa-caret-down"></i>
          </a>
          <div class="collapse" id="dang-ky-mon-hoc">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('dang-ky-mon-hoc.index') }}"> Môn học đã đăng ký </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('dang-ky-mon-hoc.create') }}"> Đăng ký môn học </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('dang-ky-mon-hoc.lich-hoc') }}"> Lịch học của tôi </a></li>
              </ul>
          </div>
      </li>
      @endif

      @if(auth()->user()->vaiTro->ten_vai_tro == 'lecturer')
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#diem" aria-expanded="false" aria-controls="diem">
              <i class="fa-solid fa-graduation-cap" style="padding-right:20px"></i>
              <span class="menu-title" style="padding-right:20px">Quản lý điểm</span>
              <i class="fa-solid fa-caret-down"></i>
          </a>
          <div class="collapse" id="diem">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="/admin/diem"> Danh sách điểm </a></li>
              </ul>
          </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('lecturer.schedule') }}">
            <i class="mdi mdi-calendar-clock menu-icon"></i>
            <span class="menu-title">Lịch giảng dạy</span>
        </a>
      </li>
      @endif

      @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#tin-tuc" aria-expanded="false" aria-controls="tin-tuc">
              <i class="fa-solid fa-newspaper" style="padding-right:20px"></i>
              <span class="menu-title" style="padding-right:20px">Quản lý tin tức</span>
              <i class="fa-solid fa-caret-down"></i>
          </a>
          <div class="collapse" id="tin-tuc">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('tin-tuc.index') }}">Danh sách tin tức</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('tin-tuc.create') }}">Thêm tin tức</a></li>
              </ul>
          </div>
      </li>
      @endif
        @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#nganh-hoc" aria-expanded="false" aria-controls="nganh-hoc">
                    <i class="fa-solid fa-newspaper" style="padding-right:20px"></i>
                    <span class="menu-title" style="padding-right:20px">QL ngành</span>
                    <i class="fa-solid fa-caret-down"></i>
                </a>
                <div class="collapse" id="nganh-hoc">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item mt-2"> <a class="nav-link" href="{{ route('nganh.index') }}">DS ngành</a></li>
                    </ul>
                </div>
            </li>
        @endif
        @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#chuyen-nganh" aria-expanded="false" aria-controls="chuyen-nganh">
                    <i class="fa-solid fa-newspaper" style="padding-right:20px"></i>
                    <span class="menu-title" style="padding-right:20px">QL chuyên ngành</span>
                    <i class="fa-solid fa-caret-down"></i>
                </a>
                <div class="collapse" id="chuyen-nganh">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item mt-2"> <a class="nav-link" href="{{ route('chuyen-nganh.index') }}">DS chuyên ngành</a></li>
                    </ul>
                </div>
            </li>
        @endif
        @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#chuong-trinh-dao-tao" aria-expanded="false" aria-controls="chuong-trinh-dao-tao">
                    <i class="fa-solid fa-newspaper" style="padding-right:20px"></i>
                    <span class="menu-title" style="padding-right:20px">QL CTĐ</span>
                    <i class="fa-solid fa-caret-down"></i>
                </a>
                <div class="collapse" id="chuong-trinh-dao-tao">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item mt-2"> <a class="nav-link" href="{{ route('chuyen-nganh.ctdt') }}">QL CTĐT</a></li>
                    </ul>
                </div>
            </li>
        @endif
    </ul>
  </nav>
