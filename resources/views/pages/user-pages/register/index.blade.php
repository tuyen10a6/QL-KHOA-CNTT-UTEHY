<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Regrister - Page</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-device/css/themify-device.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <style>
        .container-fluid {
            background-image: url('{{ asset("assets/images/backgroundQLCT.jpg") }}') !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-attachment: fixed !important;
        }
        .content-wrapper{
            background-image: url(http://127.0.0.1:8000/assets/images/backgroundQLCT.jpg) !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
        }

        .auth-form-light {
            background-color: rgba(255, 255, 255, 0.85); /* Màu nền trắng với độ trong suốt */
            border-radius: 10px; /* Bo tròn góc cho form */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng cho form */
        }

        .brand-logo img {
            max-width: 150px; /* Điều chỉnh kích thước logo */
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-group {
            margin-bottom: 1rem;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
  </head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{ asset('assets/images/logoQLCT.jpg') }}" alt="logo">
              </div>
              <h4>Đăng ký tài khoản</h4>
              <h6 class="font-weight-light">Vui lòng điền đầy đủ thông tin bên dưới</h6>
              @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
              <form class="pt-3" action="{{ route('dang-ky') }}" method="POST">
                  @csrf
                  <div class="form-group">
                      <input type="text" class="form-control form-control-lg @error('ten') is-invalid @enderror" 
                             id="ten" name="ten" placeholder="Họ và tên" value="{{ old('ten') }}">
                      @error('ten')
                          <div class="error-message">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control form-control-lg @error('ten_dang_nhap') is-invalid @enderror" 
                             id="ten_dang_nhap" name="ten_dang_nhap" placeholder="Tên đăng nhập" value="{{ old('ten_dang_nhap') }}">
                      @error('ten_dang_nhap')
                          <div class="error-message">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                             id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                      @error('email')
                          <div class="error-message">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control form-control-lg @error('sdt') is-invalid @enderror" 
                             id="sdt" name="sdt" placeholder="Số điện thoại" value="{{ old('sdt') }}">
                      @error('sdt')
                          <div class="error-message">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <select class="form-control form-control-lg @error('gioi_tinh') is-invalid @enderror" 
                              id="gioi_tinh" name="gioi_tinh">
                          <option value="">Chọn giới tính</option>
                          <option value="Nam" {{ old('gioi_tinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                          <option value="Nữ" {{ old('gioi_tinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                      </select>
                      @error('gioi_tinh')
                          <div class="error-message">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <select class="form-control form-control-lg @error('khoa_id') is-invalid @enderror" 
                              id="khoa_id" name="khoa_id">
                          <option value="">Chọn khoa</option>
                          @foreach($khoas as $khoa)
                              <option value="{{ $khoa->id }}" {{ old('khoa_id') == $khoa->id ? 'selected' : '' }}>
                                  {{ $khoa->ten_khoa }}
                              </option>
                          @endforeach
                      </select>
                      @error('khoa_id')
                          <div class="error-message">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control form-control-lg @error('mat_khau') is-invalid @enderror" 
                             id="mat_khau" name="mat_khau" placeholder="Mật khẩu">
                      @error('mat_khau')
                          <div class="error-message">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control form-control-lg @error('mat_khau_confirmation') is-invalid @enderror" 
                             id="mat_khau_confirmation" name="mat_khau_confirmation" placeholder="Xác nhận mật khẩu">
                      @error('mat_khau_confirmation')
                          <div class="error-message">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mt-3">
                      <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">ĐĂNG KÝ</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light">
                      Đã có tài khoản? <a href="{{ route('login') }}" class="text-primary">Đăng nhập</a>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
   <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>
