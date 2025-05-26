@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Inverse table</h4>
            <p class="card-description">
              Add class <code>.table-dark</code>
            </p>
            <div class="table-responsive pt-3">
              <table class="table table-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nguoiDung as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->ten }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->vaiTro->ten_vai_tro }}</td> <!-- Hiển thị vai trò -->
                            <td>{{ $user->trang_thai ? 'Hoạt động' : 'Vô hiệu' }}</td>
                            <td>
                                <form action="{{ url('/danh-sach-nguoi-dung/xoa/' . $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">Xóa</button>
                                </form>
                                <a href="{{ url('/danh-sach-nguoi-dung/sua/' . $user->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
