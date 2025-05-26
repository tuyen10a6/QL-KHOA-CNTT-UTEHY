@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h2 class="mb-4">Thông báo của bạn</h2>

            @if ($thongBao->isEmpty())
                <div class="alert alert-info" role="alert">
                    Không có thông báo nào.
                </div>
            @else
                <div class="list-group">
                    @foreach ($thongBao as $thongbao)
                        <div class="list-group-item list-group-item-action mb-3 shadow-sm">
                            <h5 class="mb-1">
                                <span class="badge badge-primary">{{ $thongbao->loai_thong_bao }}</span>
                                {{ $thongbao->tieu_de }}
                            </h5>
                            <p class="mb-1">{{ Str::limit($thongbao->noi_dung, 100) }}</p>
                            <small class="text-muted">
                                Thời gian: {{ $thongbao->created_at->setTimezone(config('app.timezone'))->format('d/m/Y H:i') }}
                            </small>
                            @if(auth()->user()->vaiTro->ten_vai_tro === 'admin' && str_contains($thongbao->tieu_de, 'Yêu cầu đăng ký'))
                                <div class="mt-2">
                                    <a href="{{ route('thongbao.registration-detail', $thongbao->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Xem chi tiết
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
