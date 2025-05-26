<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diem extends Model
{
    use HasFactory;

    protected $table = 'diem';

    protected $fillable = [
        'dang_ky_mon_hoc_id',
        'diem_giua_ky',
        'diem_cuoi_ky',
        'diem_tong_ket',
        'xep_loai',
        'nhan_xet'
    ];

    public function dangKyMonHoc()
    {
        return $this->belongsTo(DangKyMonHoc::class);
    }

    public function calculateDiemTongKet()
    {
        if ($this->diem_giua_ky !== null && $this->diem_cuoi_ky !== null) {
            $this->diem_tong_ket = ($this->diem_giua_ky * 0.3) + ($this->diem_cuoi_ky * 0.7);
            $this->xep_loai = $this->calculateXepLoai();
            $this->save();
        }
    }

    protected function calculateXepLoai()
    {
        if ($this->diem_tong_ket >= 9.0) return 'A+';
        if ($this->diem_tong_ket >= 8.5) return 'A';
        if ($this->diem_tong_ket >= 8.0) return 'B+';
        if ($this->diem_tong_ket >= 7.0) return 'B';
        if ($this->diem_tong_ket >= 6.5) return 'C+';
        if ($this->diem_tong_ket >= 5.5) return 'C';
        if ($this->diem_tong_ket >= 5.0) return 'D+';
        if ($this->diem_tong_ket >= 4.0) return 'D';
        return 'F';
    }
} 