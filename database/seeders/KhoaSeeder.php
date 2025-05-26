<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Khoa;

class KhoaSeeder extends Seeder
{
    public function run()
    {
        $khoas = [
            [
                'ten_khoa' => 'Công nghệ thông tin',
                'mo_ta' => 'Khoa Công nghệ thông tin đào tạo các chuyên ngành về CNTT',
            ],
            [
                'ten_khoa' => 'Điện - Điện tử',
                'mo_ta' => 'Khoa Điện - Điện tử đào tạo các chuyên ngành về điện và điện tử',
            ],
            [
                'ten_khoa' => 'Cơ khí',
                'mo_ta' => 'Khoa Cơ khí đào tạo các chuyên ngành về cơ khí và chế tạo máy',
            ],
            [
                'ten_khoa' => 'Xây dựng',
                'mo_ta' => 'Khoa Xây dựng đào tạo các chuyên ngành về xây dựng dân dụng và công nghiệp',
            ],
            [
                'ten_khoa' => 'Kinh tế',
                'mo_ta' => 'Khoa Kinh tế đào tạo các chuyên ngành về quản trị kinh doanh và kế toán',
            ],
        ];

        foreach ($khoas as $khoa) {
            Khoa::create($khoa);
        }
    }
}