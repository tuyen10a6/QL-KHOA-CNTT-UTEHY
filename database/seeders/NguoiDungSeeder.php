<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nguoi_dung')->insert([
            [
                'ten' => 'Lê Thành Trung',
                'ten_dang_nhap' => 'trungle',
                'email' => 'trungle@gmail.com',
                'mat_khau' => bcrypt('12345678'), // Mã hóa mật khẩu
                'vai_tro_id' => 1, // ID vai trò, thay đổi nếu cần
                'trang_thai' => true,
                'gioi_tinh' => 'nam',
                'sdt' => '0123456789',
                'avatar' => null,
                'cccd' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten' => 'Lê Vân An',
                'ten_dang_nhap' => 'vanan',
                'email' => 'vanan@gmail.com',
                'mat_khau' => bcrypt('12345678'), // Mã hóa mật khẩu
                'vai_tro_id' => 4, // ID vai trò, thay đổi nếu cần
                'trang_thai' => true,
                'gioi_tinh' => 'nu',
                'sdt' => '0123456789',
                'avatar' => null,
                'cccd' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten' => 'Khoa Nguyễn',
                'ten_dang_nhap' => 'khoanguyen',
                'email' => 'khoanguyen@gmail.com',
                'mat_khau' => bcrypt('12345678'), // Mã hóa mật khẩu
                'vai_tro_id' => 3, // ID vai trò, thay đổi nếu cần
                'trang_thai' => true,
                'gioi_tinh' => 'nam',
                'sdt' => '0123456789',
                'avatar' => null,
                'cccd' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
