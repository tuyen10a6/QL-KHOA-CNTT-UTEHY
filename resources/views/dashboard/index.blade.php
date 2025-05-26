@extends('layouts.main')

@section('content')
<div class="content-wrapper">

    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome,  {{ Auth::user()->ten_dang_nhap }}</h3>
          </div>
          <div class="col-12 col-xl-4">
           <div class="justify-content-end d-flex">
            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                <a class="dropdown-item" href="#">January - March</a>
                <a class="dropdown-item" href="#">March - June</a>
                <a class="dropdown-item" href="#">June - August</a>
                <a class="dropdown-item" href="#">August - November</a>
              </div>
            </div>
           </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
                <div class="card-people mt-auto">
                    <img src="{{ asset('assets/images/dashboard/people.svg') }}" alt="people">
                    <div class="weather-info">
                        <div class="d-flex">
                            <div>
                                <h2 class="mb-0 font-weight-normal" id="temp"><i class="icon-sun mr-2"></i>--<sup>C</sup></h2>
                            </div>
                            <div class="ml-2">
                                <h4 class="location font-weight-normal" id="location">Ho Chi Minh</h4>
                                <h6 class="font-weight-normal" id="country">Vietnam</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin transparent">
        <div class="row">
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-tale">
              <div class="card-body">
                  <p class="mb-4">Tổng số thành viên:</p>
                  <p class="fs-30 mb-2"> {{ \App\Models\User::count() }}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
              <div class="card-body">
                <p class="mb-4">Tổng số khoa</p>
                <p class="fs-30 mb-2">{{ \App\Models\Khoa::count() }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
            <div class="card card-light-blue">
              <div class="card-body">
                <p class="mb-4">Tổng số thông báo</p>
                <p class="fs-30 mb-2">{{ \App\Models\Notification::count() }}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 stretch-card transparent">
            <div class="card card-light-danger">
              <div class="card-body">
                <p class="mb-4">Tổng số tin tức</p>
                <p class="fs-30 mb-2">{{ \App\Models\TinTuc::count() }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script>
        const apiKey = '3b64943c407695318a770353708ddcd6'; // API key của bạn
        const city = 'Ho Chi Minh';
        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                // Cập nhật nhiệt độ
                document.getElementById('temp').innerHTML = `${Math.round(data.main.temp)}<sup>C</sup>`;

                // Cập nhật tên thành phố
                document.getElementById('location').innerHTML = data.name;

                // Cập nhật quốc gia
                document.getElementById('country').innerHTML = data.sys.country;

                // Lấy biểu tượng thời tiết
                const icon = data.weather[0].icon;
                const iconUrl = `https://openweathermap.org/img/wn/${icon}@2x.png`;

                // Hiển thị biểu tượng thời tiết
                document.getElementById('weather-icon').src = iconUrl;
            })
            .catch(error => console.error('Error fetching the weather data:', error));
    </script>
@endsection

