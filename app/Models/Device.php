<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    // Khai báo tên bảng trong cơ sở dữ liệu
    protected $table = 'thiet_bi_pccc';

    protected $fillable = [
        'ten_thiet_bi',
        'nha_cung_cap',
        'so_luong',
        'hinh_anh',
        'vi_tri',
        'ngay_lap_dat',
        'ngay_kiem_tra_gan_nhat',
        'tinh_trang',
    ];
}
