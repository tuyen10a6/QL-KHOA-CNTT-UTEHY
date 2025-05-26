<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('nguoi_dung')->insert(
            [
                'ten'           => 'Nguyễn Hữu Đông',
                'ten_dang_nhap' => 'dong.nh',
                'email'         => 'nguyenhuudong@gmail.com',
                'mat_khau'      => Hash::make('12345678'),
                'vai_tro_id'    => 3,
                'trang_thai'    => 1,
                'gioi_tinh'     => 'nam',
                'sdt'           => '0392849222'
            ],
            [
                'ten'           => 'Vũ Xuân Thắng',
                'ten_dang_nhap' => 'thang.vx',
                'email'         => 'vuxuanthang@gmail.com',
                'mat_khau'      => Hash::make('12345678'),
                'vai_tro_id'    => 3,
                'trang_thai'    => 1,
                'gioi_tinh'     => 'nam',
                'sdt'           => '0392849222'
            ]);
    }
}
