<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $notifications = [
            [
                'nguoi_dung_id' => 3,
                'tieu_de' => 'Thông báo về điểm thi',
                'noi_dung' => 'Điểm thi môn Lập trình Web đã được cập nhật. Vui lòng kiểm tra trên hệ thống.',
                'loai_thong_bao' => 'Điểm',
                'trang_thai' => true,
            ],
            [
                'nguoi_dung_id' => 4,
                'tieu_de' => 'Thông báo về lịch học',
                'noi_dung' => 'Lịch học tuần tới có thay đổi. Vui lòng kiểm tra trên hệ thống.',
                'loai_thong_bao' => 'Lịch học',
                'trang_thai' => true,
            ],
            [
                'nguoi_dung_id' => 5,
                'tieu_de' => 'Thông báo về đăng ký môn học',
                'noi_dung' => 'Bạn đã đăng ký thành công môn học Lập trình di động.',
                'loai_thong_bao' => 'Đăng ký môn học',
                'trang_thai' => true,
            ],
            [
                'nguoi_dung_id' => 3,
                'tieu_de' => 'Thông báo về học phí',
                'noi_dung' => 'Học phí học kỳ 2 đã được cập nhật. Vui lòng kiểm tra và thanh toán đúng hạn.',
                'loai_thong_bao' => 'Học phí',
                'trang_thai' => true,
            ],
            [
                'nguoi_dung_id' => 4,
                'tieu_de' => 'Thông báo về bảo vệ đồ án',
                'noi_dung' => 'Lịch bảo vệ đồ án của bạn đã được cập nhật. Vui lòng kiểm tra trên hệ thống.',
                'loai_thong_bao' => 'Đồ án',
                'trang_thai' => true,
            ],
        ];

        foreach ($notifications as $notification) {
            Notification::create($notification);
        }
    }
} 