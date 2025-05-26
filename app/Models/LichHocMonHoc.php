<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichHocMonHoc extends Model
{
    protected $table = 'lich_hoc_mon_hoc';

    protected $fillable = [
        'mon_hoc_id',
        'ma_lop',
        'phong_hoc',
        'thu',
        'tiet_bat_dau',
        'tiet_ket_thuc',
        'giang_vien_id',
        'so_luong_sv_toi_da',
        'so_luong_sv_da_dang_ky',
        'trang_thai'
    ];

    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'mon_hoc_id');
    }

    public function sinhViens()
    {
        return $this->belongsToMany(User::class, 'dang_ky_mon_hoc', 'lich_hoc_id', 'sinh_vien_id')
            ->withTimestamps();
    }

    public function conChoDangKy()
    {
        return $this->so_luong_sv_toi_da - $this->so_luong_sv_da_dang_ky;
    }

    public function giangVien()
    {
        return $this->belongsTo(User::class, 'giang_vien_id');
    }
} 