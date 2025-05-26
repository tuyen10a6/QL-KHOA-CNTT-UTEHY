<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo mr-5" href="http://127.0.0.1:8000/"><img src="{{ asset('assets/images/logoQLCT.jpg') }}" class="mr-2" alt="logo"/></a>
      <a class="navbar-brand brand-logo-mini" href="http://127.0.0.1:8000/"><img src="{{ asset('assets/images/logoQLCT.jpg') }}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="icon-bell mx-0 bell-icon"></i>
                  <span class="notification-count">{{ $unreadCount }}</span> <!-- Hiển thị số thông báo chưa đọc -->
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                  @if ($notifications->isEmpty())
                      <p class="text-muted text-center">No notifications</p>
                  @else
                      @foreach ($notifications as $notification)
                          <a class="dropdown-item preview-item" href="#" onclick="handleNotificationClick('{{ $notification->noi_dung }}')">
                              <div class="preview-thumbnail">
                                  <div class="preview-icon bg-info">
                                      <i class="ti-bell mx-0"></i>
                                  </div>
                              </div>
                              <div class="preview-item-content">
                                  <h6 class="preview-subject font-weight-normal">{{ $notification->tieu_de }}</h6>
                                  <p class="font-weight-light small-text mb-0 text-muted">
                                      {{ $notification->noi_dung }}
                                  </p>
                              </div>
                          </a>
                      @endforeach
                  @endif
              </div>
          </li>
          <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{ auth()->user()->avatar ? asset('assets/images/avatars/' . auth()->user()->avatar) : asset('assets/images/faces/face28.jpg') }}" alt="profile"/>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{ url('/danh-sach-nguoi-dung/sua/' . auth()->user()->id) }}">
                  <i class="ti-settings text-primary"></i>
                  Profile
              </a>
              <form id="logout-form" action="{{ route('dang-xuat') }}" method="POST" style="display: none;">
                  @csrf
              </form>

              <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="ti-power-off text-primary"></i>
                  Logout
              </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
<style>
    .notification-count {
        background-color: red;
        color: white;
        padding: 0px 4px;
        border-radius: 50%;
        font-size: 12px;
        position: absolute;
        top: -5px;
        right: -8px;
    }

    @keyframes bell-shake {
        0% { transform: rotate(0); }
        25% { transform: rotate(15deg); }
        50% { transform: rotate(-15deg); }
        75% { transform: rotate(10deg); }
        100% { transform: rotate(0); }
    }

    .bell-shake {
        animation: bell-shake 0.5s ease-in-out infinite;
    }
</style>
<script>
    function handleNotificationClick(content) {
        // Tìm email trong phần nội dung thông báo
        const emailPattern = /email: ([^ ]+)/;
        const matches = content.match(emailPattern);

        if (matches) {
            const email = matches[1]; // Lấy email từ nội dung
            console.log("Email found: ", email); // Kiểm tra xem email có chính xác không

            // Gửi yêu cầu đến server để tìm người dùng dựa theo email
            fetch(`/find-user-by-email?email=${email}`)
                .then(response => response.json())
                .then(data => {
                    if (data.user_id) {
                        // Điều hướng đến trang chỉnh sửa người dùng
                        window.location.href = `/danh-sach-nguoi-dung/sua/${data.user_id}`;
                    } else {
                        console.error('User not found');
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            console.error('Email not found in notification content');
        }
    }

</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const notificationCountElement = document.querySelector('.notification-count');
        const bellIcon = document.querySelector('.bell-icon');
        const unreadCount = parseInt(notificationCountElement.textContent);

        // Nếu có thông báo chưa đọc, làm chuông rung
        if (unreadCount > 0) {
            bellIcon.classList.add('bell-shake');
        }

        // Khi người dùng click vào chuông
        document.querySelector('#notificationDropdown').addEventListener('click', function() {
            // Ẩn số lượng thông báo
            notificationCountElement.style.display = 'none';

            // Ngừng chuông rung
            bellIcon.classList.remove('bell-shake');

            // Gửi yêu cầu AJAX để đánh dấu tất cả thông báo đã xem
            fetch("{{ route('thong-bao.markAsRead') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data.status); // Log trạng thái thành công
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>


