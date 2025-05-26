@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title">Danh sách người dùng</h4>
                            <div>
                                @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
                                    <a href="{{ route('nguoi-dung.create') }}" class="btn btn-primary">
                                        <i class="mdi mdi-account-plus"></i> Thêm người dùng
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <form action="{{ route('danh-sach-nguoi-dung') }}" method="GET" class="row align-items-center">
                                <div class="col-md-3">
                                    <label for="vai_tro" class="form-label">Lọc theo vai trò:</label>
                                    <select name="vai_tro" id="vai_tro" class="form-control" onchange="this.form.submit()">
                                        <option value="">Tất cả vai trò</option>
                                        @foreach($vaiTroList as $vaiTro)
                                            <option value="{{ $vaiTro->ten_vai_tro }}" 
                                                {{ request('vai_tro') === $vaiTro->ten_vai_tro ? 'selected' : '' }}>
                                                {{ $vaiTro->ten_vai_tro }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    @if(request()->has('vai_tro') && !empty(request('vai_tro')))
                                        <a href="{{ route('danh-sach-nguoi-dung') }}" class="btn btn-secondary mt-4">
                                            <i class="mdi mdi-refresh"></i> Đặt lại
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>

                        @if(request('vai_tro') && !empty(request('vai_tro')))
                            <div class="alert alert-info">
                                Đang hiển thị danh sách: <strong>{{ request('vai_tro') }}</strong>
                                <span class="badge bg-secondary">{{ $nguoiDung->count() }} người dùng</span>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Vai trò</th>
                                        <th>Khoa</th>
                                        <th>Trạng thái</th>
                                        @if(auth()->user()->vaiTro->ten_vai_tro == 'admin' || 
                                            auth()->user()->canEditUser() || 
                                            auth()->user()->canDeleteUser())
                                            <th>Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nguoiDung as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->ten }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($user->vaiTro->ten_vai_tro == 'admin') 
                                                        bg-danger
                                                    @elseif($user->vaiTro->ten_vai_tro == 'Giảng viên')
                                                        bg-success
                                                    @elseif($user->vaiTro->ten_vai_tro == 'Sinh viên')
                                                        bg-primary
                                                    @else
                                                        bg-secondary
                                                    @endif">
                                                    {{ $user->vaiTro->ten_vai_tro }}
                                                </span>
                                            </td>
                                            <td>{{ $user->khoa ? $user->khoa->ten_khoa : 'Chưa có khoa' }}</td>
                                            <td>
                                                <span class="badge {{ $user->trang_thai ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $user->trang_thai ? 'Hoạt động' : 'Vô hiệu' }}
                                                </span>
                                            </td>
                                            @if(auth()->user()->vaiTro->ten_vai_tro == 'admin' || 
                                                auth()->user()->canEditUser() || 
                                                auth()->user()->canDeleteUser())
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        @if(auth()->user()->canEditUser())
                                                            <a href="{{ url('/danh-sach-nguoi-dung/sua/' . $user->id) }}" 
                                                               class="btn btn-warning btn-sm">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                        @endif
                                                        @if(auth()->user()->canDeleteUser())
                                                            <form id="delete-form-{{ $user->id }}" 
                                                                  action="{{ url('/danh-sach-nguoi-dung/xoa/' . $user->id) }}" 
                                                                  method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="button" class="btn btn-danger btn-sm" 
                                                                        onclick="confirmDelete({{ $user->id }})">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
                                                            <a href="{{ route('assignUserPermissionsForm', $user->id) }}" 
                                                               class="btn btn-info btn-sm">
                                                                <i class="mdi mdi-key"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: "Hành động này sẽ không thể khôi phục lại!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có, xóa nó!',
            cancelButtonText: 'Không, quay lại!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
