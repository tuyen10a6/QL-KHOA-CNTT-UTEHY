<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MonHoc;

class MonHocSeeder extends Seeder
{
    public function run()
    {
        $monHocs = [
            [
                'ten_mon_hoc' => 'Lập trình Web',
                'ma_mon_hoc' => 'IT001',
                'so_tin_chi' => 3,
                'mo_ta' => 'Môn học về lập trình web sử dụng PHP và Laravel',
                'khoa_id' => 1,
                'trang_thai' => true,
            ],
            [
                'ten_mon_hoc' => 'Lập trình di động',
                'ma_mon_hoc' => 'IT002',
                'so_tin_chi' => 3,
                'mo_ta' => 'Môn học về lập trình ứng dụng di động',
                'khoa_id' => 1,
                'trang_thai' => true,
            ],
            [
                'ten_mon_hoc' => 'Mạch điện tử',
                'ma_mon_hoc' => 'EE001',
                'so_tin_chi' => 4,
                'mo_ta' => 'Môn học về mạch điện tử cơ bản',
                'khoa_id' => 2,
                'trang_thai' => true,
            ],
            [
                'ten_mon_hoc' => 'Cơ học kỹ thuật',
                'ma_mon_hoc' => 'ME001',
                'so_tin_chi' => 4,
                'mo_ta' => 'Môn học về cơ học kỹ thuật cơ bản',
                'khoa_id' => 3,
                'trang_thai' => true,
            ],
            [
                'ten_mon_hoc' => 'Kế toán tài chính',
                'ma_mon_hoc' => 'AC001',
                'so_tin_chi' => 3,
                'mo_ta' => 'Môn học về kế toán tài chính doanh nghiệp',
                'khoa_id' => 5,
                'trang_thai' => true,
            ],
        ];

        foreach ($monHocs as $monHoc) {
            MonHoc::create($monHoc);
        }
    }
}	