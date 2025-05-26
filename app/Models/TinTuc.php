<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    protected $table = 'tin_tuc';

    protected $fillable = [
        'tieu_de',
        'noi_dung',
        'trang_thai',
        'anh_dai_dien'
    ];

    public function nguoiDang()
    {
        return $this->belongsTo(User::class, 'nguoi_dang_id');
    }
} 