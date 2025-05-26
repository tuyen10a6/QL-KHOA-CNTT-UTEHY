<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'vai_tro'; // Sử dụng bảng 'vai_tro'

    protected $fillable = [
        'ten_vai_tro', 'quyen'
    ];

    public function nguoiDungs()
    {
        return $this->hasMany(User::class, 'vai_tro_id');
    }
}
