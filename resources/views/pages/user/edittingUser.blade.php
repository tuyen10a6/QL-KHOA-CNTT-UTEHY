@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Cập nhật thông tin người dùng</h4>
                        <p class="card-description">
                            Sửa Người Dùng
                        </p>
                        <form class="forms-sample" action="{{ url('/danh-sach-nguoi-dung/sua/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="ten">Tên</label>
                                <input type="text" class="form-control" id="ten" name="ten" placeholder="Tên" value="{{ old('ten', $user->ten) }}">
                            </div>

                            <div class="form-group">
                                <label for="ten_dang_nhap">Tên Đăng Nhập (Username)</label>
                                <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap" placeholder="Username" value="{{ old('ten_dang_nhap', $user->ten_dang_nhap) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="vai_tro_id">Vai Trò</label>
                                <select name="vai_tro_id" class="form-control" required>
                                    @foreach($vaiTroList as $vaiTro)
                                        <option value="{{ $vaiTro->id }}" {{ $user->vaiTro->id == $vaiTro->id ? 'selected' : '' }}>{{ $vaiTro->ten_vai_tro }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="khoa_id">Khoa</label>
                                <select name="khoa_id" class="form-control">
                                    <option value="">Chọn khoa</option>
                                    @foreach($khoaList as $khoa)
                                        <option value="{{ $khoa->id }}" {{ $user->khoa_id == $khoa->id ? 'selected' : '' }}>
                                            {{ $khoa->ten_khoa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="trang_thai">Trạng Thái</label>
                                <input type="checkbox" name="trang_thai" value="1" {{ $user->trang_thai ? 'checked' : '' }}> Hoạt động
                            </div>

                            <div class="form-group">
                                <label for="gioi_tinh">Giới Tính</label>
                                <select name="gioi_tinh" class="form-control">
                                    <option value="" {{ is_null($user->gioi_tinh) ? 'selected' : '' }}>Chọn Giới Tính</option>
                                    <option value="nam" {{ $user->gioi_tinh == 'nam' ? 'selected' : '' }}>Nam</option>
                                    <option value="nu" {{ $user->gioi_tinh == 'nu' ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sdt">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="sdt" name="sdt" placeholder="Số Điện Thoại" value="{{ old('sdt', $user->sdt) }}">
                            </div>

                            <div class="form-group">
                                <label for="cccd">CCCD</label>
                                <input type="text" class="form-control" id="cccd" name="cccd" placeholder="CCCD" value="{{ old('cccd', $user->cccd) }}">
                            </div>

                            {{-- Phần mới: Trường mật khẩu --}}
                            <div class="form-group">
                                <label for="mat_khau">Mật Khẩu Mới (nếu có)</label>
                                <input type="password" class="form-control" id="mat_khau" name="mat_khau" placeholder="Mật Khẩu Mới">
                            </div>

                            <div class="form-group">
                                <label for="mat_khau_confirmation">Xác Nhận Mật Khẩu Mới</label>
                                <input type="password" class="form-control" id="mat_khau_confirmation" name="mat_khau_confirmation" placeholder="Xác Nhận Mật Khẩu Mới">
                            </div>

                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar">
                                @if ($user->avatar)
                                    <p>Hình hiện tại:</p>
                                    <img src="{{ asset('assets/images/avatars/' . $user->avatar) }}" alt="Avatar" width="100">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Cập Nhật</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
