@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="container">
                <h1 class="mb-4">Danh Sách Lịch Kiểm Tra Định Kỳ</h1>

                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Tên Thiết Bị</th>
                        <th>Ngày Thực Hiện</th>
                        <th>Người Thực Hiện</th>
                        <th>Ghi Chú</th>
                        <th>Tình Trạng Trước</th>
                        <th>Tình Trạng Sau</th>
                        @if(auth()->user()->vaiTro->ten_vai_tro == 'admin' || auth()->user()->canEditSchedule() || auth()->user()->canDeleteSchedule())
                            <th>Hành Động</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lichKiemTras as $lich)
                        <tr>
                            <td>{{ $lich->id }}</td>
                            <td>{{ $lich->thietBi->ten_thiet_bi }}</td>
                            <td>{{ $lich->ngay_thuc_hien }}</td>
                            <td>
                                <a href="{{ route('nguoi-dung-chi-tiet.profile', $lich->nguoiThucHien->id) }}">{{ $lich->nguoiThucHien->ten }}</a>
                            </td>
                            <td>{{ $lich->ghi_chu ?? 'Không có ghi chú' }}</td>
                            <td>
                                <span class="badge badge-pill badge-info">{{ $lich->tinh_trang_truoc_khi_kiem_tra ?? 'Chưa cập nhật' }}</span>
                            </td>
                            <td>
                                <span class="badge badge-pill badge-success">{{ $lich->tinh_trang_sau_khi_kiem_tra ?? 'Chưa cập nhật' }}</span>
                            </td>
                            @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
                                <td>
                                    <a href="{{ route('lich-kiem-tra.edit', $lich->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $lich->id }})">Xóa</button>
                                    <form id="delete-form-{{ $lich->id }}" action="{{ route('lich-kiem-tra.destroy', $lich->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            @else
                                <td>
                                    @if(auth()->user()->canEditSchedule())
                                        <a href="{{ route('lich-kiem-tra.edit', $lich->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    @endif
                                    @if(auth()->user()->canDeleteSchedule())
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $lich->id }})">Xóa</button>
                                            <form id="delete-form-{{ $lich->id }}" action="{{ route('lich-kiem-tra.destroy', $lich->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Kiểm tra nếu không có lịch kiểm tra -->
                @if($lichKiemTras->isEmpty())
                    <p class="text-center">Chưa có lịch kiểm tra nào.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

<!-- Thêm các thư viện UI và hiệu ứng -->
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
