<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'ten' => 'Admin',
                'ten_dang_nhap' => 'admin',
                'email' => 'admin@example.com',
                'mat_khau' => Hash::make('123456'),
                'sdt' => '0123456789',
                'gioi_tinh' => 'Nam',
                'khoa_id' => 1,
                'vai_tro_id' => 1, // admin
            ],
            [
                'ten' => 'Giảng viên 1',
                'ten_dang_nhap' => 'lecturer1',
                'email' => 'lecturer1@example.com',
                'mat_khau' => Hash::make('123456'),
                'sdt' => '0123456788',
                'gioi_tinh' => 'Nam',
                'khoa_id' => 1,
                'vai_tro_id' => 3, // lecturer
            ],
            [
                'ten' => 'Sinh viên 1',
                'ten_dang_nhap' => 'student1',
                'email' => 'student1@example.com',
                'mat_khau' => Hash::make('123456'),
                'sdt' => '0123456787',
                'gioi_tinh' => 'Nam',
                'khoa_id' => 1,
                'vai_tro_id' => 4, // student
            ],
            [
                'ten' => 'Sinh viên 2',
                'ten_dang_nhap' => 'student2',
                'email' => 'student2@example.com',
                'mat_khau' => Hash::make('123456'),
                'sdt' => '0123456786',
                'gioi_tinh' => 'Nữ',
                'khoa_id' => 2,
                'vai_tro_id' => 4, // student
            ],
            [
                'ten' => 'Sinh viên 3',
                'ten_dang_nhap' => 'student3',
                'email' => 'student3@example.com',
                'mat_khau' => Hash::make('123456'),
                'sdt' => '0123456785',
                'gioi_tinh' => 'Nam',
                'khoa_id' => 3,
                'vai_tro_id' => 4, // student
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
} 