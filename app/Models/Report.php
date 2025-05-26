<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'bao_cao';

    protected $fillable = [
        'thiet_bi_id',
        'ngay_bao_cao',
        'chi_tiet_bao_cao',
    ];

    // Mối quan hệ với thiết bị
    public function thietBi()
    {
        return $this->belongsTo(Device::class, 'thiet_bi_id');
    }
}
