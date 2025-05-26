@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Chi tiết yêu cầu đăng ký</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="text-primary">Thông tin người đăng ký</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        @php
                                            $content = $notification->noi_dung;
                                            $lines = explode("\n", $content);
                                            foreach ($lines as $line) {
                                                $parts = explode(": ", $line);
                                                if (count($parts) === 2) {
                                                    echo "<tr>";
                                                    echo "<th style='width: 30%'>" . $parts[0] . "</th>";
                                                    echo "<td>" . $parts[1] . "</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        @endphp
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-primary">Thời gian yêu cầu</h5>
                            <p class="mb-0">{{ $notification->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <form action="{{ route('thongbao.approve', $notification->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i> Phê duyệt
                                </button>
                            </form>
                            <form action="{{ route('thongbao.reject', $notification->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-times"></i> Từ chối
                                </button>
                            </form>
                            <a href="{{ route('thongbao.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 