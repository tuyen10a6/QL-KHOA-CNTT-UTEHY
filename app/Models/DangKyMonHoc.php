<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DangKyMonHoc extends Model
{
    protected $table = 'dang_ky_mon_hoc';

    protected $fillable = [
        'sinh_vien_id',
        'mon_hoc_id',
        'lich_hoc_mon_hoc_id',
        'ma_lop',
        'phong_hoc',
        'thu',
        'tiet_bat_dau',
        'tiet_ket_thuc',
        'giang_vien',
        'trang_thai'
    ];

    public function sinhVien()
    {
        return $this->belongsTo(User::class, 'sinh_vien_id');
    }

    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'mon_hoc_id');
    }

    // Thêm quan hệ với LichHocMonHoc
    public function lichHoc()
    {
        return $this->belongsTo(LichHocMonHoc::class, 'lich_hoc_mon_hoc_id');
    }

    public function diem()
    {
        return $this->hasOne(Diem::class, 'dang_ky_mon_hoc_id');
    }
}