@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title mb-0">
                                <i class="mdi mdi-calendar-clock text-primary"></i> 
                                Thời khóa biểu giảng dạy
                            </h4>
                            <div class="schedule-info">
                                <span class="badge badge-primary p-2">
                                    <i class="mdi mdi-account-multiple"></i> 
                                    Tổng số lớp: {{ $lichHocMonHoc->count() }}
                                </span>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-check-circle"></i> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-alert-circle"></i> {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if($lichHocMonHoc->isEmpty())
                            <div class="text-center py-5">
                                <i class="mdi mdi-calendar-remove text-muted" style="font-size: 5rem;"></i>
                                <h5 class="mt-3 text-muted">Bạn chưa có lịch giảng dạy nào</h5>
                            </div>
                        @else
                            <div class="timetable-container">
                                <div class="timetable">
                                    <div class="timetable-header">
                                        <div class="time-slot">Tiết</div>
                                        <div class="day">Thứ 2</div>
                                        <div class="day">Thứ 3</div>
                                        <div class="day">Thứ 4</div>
                                        <div class="day">Thứ 5</div>
                                        <div class="day">Thứ 6</div>
                                        <div class="day">Thứ 7</div>
                                    </div>
                                    <div class="timetable-body">
                                        @php
                                            $timeSlots = [
                                                '1-4' => ['7:00', '10:00'],
                                                '5-8' => ['10:30', '13:30'],
                                                '9-12' => ['14:00', '17:00'],
                                                '13-16' => ['17:30', '20:30']
                                            ];
                                        @endphp

                                        @foreach($timeSlots as $slot => $time)
                                            <div class="timetable-row">
                                                <div class="time-slot">
                                                    <div class="slot-number">Tiết {{ $slot }}</div>
                                                    <div class="slot-time">{{ $time[0] }} - {{ $time[1] }}</div>
                                                </div>
                                                @for($i = 2; $i <= 7; $i++)
                                                    <div class="day-cell">
                                                        @php
                                                            $slotRange = explode('-', $slot);
                                                            $currentClasses = $lichHocMonHoc->filter(function($lichHoc) use ($i, $slotRange) {
                                                                // Chuẩn hóa cách so sánh thứ
                                                                $dayNumber = (int)str_replace(['Thứ ', 'thứ '], '', $lichHoc->thu);
                                                                return $dayNumber === $i && 
                                                                       $lichHoc->tiet_bat_dau <= $slotRange[1] && 
                                                                       $lichHoc->tiet_ket_thuc >= $slotRange[0];
                                                            });
                                                        @endphp
                                                        
                                                        @foreach($currentClasses as $lichHoc)
                                                            <div class="course-card">
                                                                <div class="course-header">
                                                                    <span class="course-code">{{ $lichHoc->monHoc->ma_mon_hoc }}</span>
                                                                    <span class="course-room">
                                                                        <i class="mdi mdi-door"></i> {{ $lichHoc->phong_hoc }}
                                                                    </span>
                                                                </div>
                                                                <div class="course-title">{{ $lichHoc->monHoc->ten_mon_hoc }}</div>
                                                                <div class="course-info">
                                                                    <span class="student-count">
                                                                        <i class="mdi mdi-account-multiple"></i>
                                                                        {{ $lichHoc->so_luong_sv_da_dang_ky }}/{{ $lichHoc->so_luong_sv_toi_da }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endfor
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border: none;
            border-radius: 10px;
        }

        .timetable-container {
            overflow-x: auto;
            margin-top: 20px;
        }

        .timetable {
            min-width: 800px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }

        .timetable-header {
            display: grid;
            grid-template-columns: 100px repeat(6, 1fr);
            background-color: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
        }

        .timetable-body {
            display: grid;
            grid-template-rows: repeat(4, 1fr);
        }

        .timetable-row {
            display: grid;
            grid-template-columns: 100px repeat(6, 1fr);
            min-height: 120px;
            border-bottom: 1px solid #e0e0e0;
        }

        .time-slot {
            padding: 10px;
            background-color: #f8f9fa;
            border-right: 1px solid #e0e0e0;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .slot-number {
            font-weight: 600;
            color: #333;
        }

        .slot-time {
            font-size: 0.8rem;
            color: #666;
        }

        .day {
            padding: 10px;
            text-align: center;
            font-weight: 600;
            color: #333;
            border-right: 1px solid #e0e0e0;
        }

        .day-cell {
            padding: 5px;
            border-right: 1px solid #e0e0e0;
            min-height: 120px;
        }

        .course-card {
            background-color: #fff;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            min-height: 100px;
            display: flex;
            flex-direction: column;
        }

        .course-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .course-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
            flex-wrap: wrap;
            gap: 5px;
        }

        .course-code {
            font-weight: 600;
            color: #1976d2;
            font-size: 0.85rem;
            word-break: break-word;
            max-width: 100%;
            line-height: 1.2;
        }

        .course-room {
            font-size: 0.8rem;
            color: #666;
            white-space: nowrap;
        }

        .course-title {
            font-size: 0.9rem;
            color: #333;
            margin-bottom: 5px;
            font-weight: 500;
            word-break: break-word;
            line-height: 1.2;
        }

        .course-info {
            font-size: 0.8rem;
            color: #666;
            margin-top: auto;
        }

        .student-count {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        @media (max-width: 768px) {
            .timetable-container {
                margin: 0 -15px;
            }
            
            .course-card {
                padding: 8px;
            }
            
            .course-title {
                font-size: 0.8rem;
            }
        }
    </style>
@endsection 