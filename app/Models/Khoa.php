<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    protected $table = 'khoa';

    protected $fillable = [
        'ten_khoa',
        'ma_khoa',
        'mo_ta',
        'trang_thai'
    ];

    public function nguoiDungs()
    {
        return $this->hasMany(User::class, 'khoa_id');
    }
} 