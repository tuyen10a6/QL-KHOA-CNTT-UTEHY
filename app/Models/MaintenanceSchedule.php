<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceSchedule extends Model
{
    use HasFactory;

    protected $table = 'lich_su_thiet_bi';

    protected $fillable = [
        'thiet_bi_id',
        'hoat_dong',
        'ngay_thuc_hien',
        'nguoi_thuc_hien_id',
        'ghi_chu',
        'tinh_trang_truoc_khi_kiem_tra',
        'tinh_trang_sau_khi_kiem_tra'
    ];

    // Mối quan hệ với bảng thiet_bi_pccc
    public function thietBi()
    {
        return $this->belongsTo(Device::class, 'thiet_bi_id');
    }

    // Mối quan hệ với bảng nguoi_dung
    public function nguoiThucHien()
    {
        return $this->belongsTo(User::class, 'nguoi_thuc_hien_id');
    }
}

