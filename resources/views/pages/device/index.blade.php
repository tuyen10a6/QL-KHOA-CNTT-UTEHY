@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1 class="mb-4">Danh Sách Thiết Bị PCCC</h1>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên Thiết Bị</th>
                        <th>Nhà Cung Cấp</th>
                        <th>Số Lượng</th>
                        <th>Hình Ảnh</th>
                        <th>Vị Trí</th>
                        <th>Ngày Lắp Đặt</th>
                        <th>Tình Trạng</th>
                        @if(auth()->user()->vaiTro->ten_vai_tro == 'admin' || auth()->user()->canEditDevice() || auth()->user()->canDeleteDevice())
                            <th>Hành Động</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($thietBiList as $thietBi)
                        <tr>
                            <td>{{ $thietBi->id }}</td>
                            <td>{{ $thietBi->ten_thiet_bi }}</td>
                            <td>{{ $thietBi->nha_cung_cap }}</td>
                            <td>{{ $thietBi->so_luong }}</td>
                            <td>
                                @if ($thietBi->hinh_anh)
                                    <img src="{{ asset('assets/images/Device/' . $thietBi->hinh_anh) }}" alt="{{ $thietBi->ten_thiet_bi }}" class="img-thumbnail" style="width: 120px; height: 90px;">
                                @else
                                    Không có hình ảnh
                                @endif
                            </td>
                            <td>{{ $thietBi->vi_tri }}</td>
                            <td>{{ \Carbon\Carbon::parse($thietBi->ngay_lap_dat)->format('d/m/Y') }}</td>
                            <td>{{ $thietBi->tinh_trang }}</td>
                            <td>
                                @if(auth()->user()->vaiTro->ten_vai_tro == 'admin')
                                    <a href="{{ url('/thiet-bi-pccc/sua/' . $thietBi->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    <form id="delete-form-{{ $thietBi->id }}" action="{{ route('thiet-bi.destroy', $thietBi->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $thietBi->id }})">Xóa</button>
                                    </form>
                                @else
                                    @if(auth()->user()->canEditDevice())
                                        <a href="{{ url('/thiet-bi-pccc/sua/' . $thietBi->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    @endif
                                    @if(auth()->user()->canDeleteDevice())
                                        <form id="delete-form-{{ $thietBi->id }}" action="{{ route('thiet-bi.destroy', $thietBi->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $thietBi->id }})">Xóa</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
