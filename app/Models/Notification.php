<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'thong_bao';

    protected $fillable = [
        'nguoi_dung_id',
        'loai_thong_bao',
        'tieu_de',
        'noi_dung',
        'da_xem'
    ];

    // Quan hệ với bảng nguoi_dung
    public function nguoiDung()
    {
        return $this->belongsTo(User::class, 'nguoi_dung_id');
    }
}
