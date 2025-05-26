<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TinTuc;

class TinTucSeeder extends Seeder
{
    public function run()
    {
        $tinTucs = [
            [
                'tieu_de' => 'Thông báo về lịch thi học kỳ 1 năm học 2023-2024',
                'noi_dung' => 'Nhà trường thông báo lịch thi học kỳ 1 năm học 2023-2024 sẽ bắt đầu từ ngày 15/12/2023. Sinh viên vui lòng theo dõi lịch thi trên hệ thống.',
                'trang_thai' => true,
            ],
            [
                'tieu_de' => 'Thông báo về việc đăng ký môn học học kỳ 2',
                'noi_dung' => 'Thời gian đăng ký môn học học kỳ 2 năm học 2023-2024 sẽ bắt đầu từ ngày 01/01/2024. Sinh viên vui lòng đăng ký đúng thời hạn.',
                'trang_thai' => true,
            ],
            [
                'tieu_de' => 'Thông báo về lễ tốt nghiệp',
                'noi_dung' => 'Lễ tốt nghiệp cho sinh viên khóa 2020 sẽ được tổ chức vào ngày 15/01/2024. Sinh viên vui lòng chuẩn bị đầy đủ hồ sơ.',
                'trang_thai' => true,
            ],
            [
                'tieu_de' => 'Thông báo về việc nộp học phí',
                'noi_dung' => 'Hạn nộp học phí học kỳ 2 năm học 2023-2024 là ngày 31/12/2023. Sinh viên vui lòng nộp đúng hạn để tránh bị cấm thi.',
                'trang_thai' => true,
            ],
            [
                'tieu_de' => 'Thông báo về việc bảo vệ đồ án tốt nghiệp',
                'noi_dung' => 'Lịch bảo vệ đồ án tốt nghiệp cho sinh viên khóa 2020 sẽ bắt đầu từ ngày 10/01/2024. Sinh viên vui lòng chuẩn bị đầy đủ tài liệu.',
                'trang_thai' => true,
            ],
        ];

        foreach ($tinTucs as $tinTuc) {
            TinTuc::create($tinTuc);
        }
    }
} 