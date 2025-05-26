<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    protected $table = 'mon_hoc';

    protected $guarded = [];

    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'khoa_id');
    }

    public function chuyenNganh(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ChuyenNganh::class, 'chuyen_nganh_id');
    }

    public function giangViens()
    {
        return $this->belongsToMany(User::class, 'giang_vien_mon_hoc', 'mon_hoc_id', 'giang_vien_id');
    }
}
