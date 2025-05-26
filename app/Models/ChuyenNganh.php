<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChuyenNganh extends Model
{
    use HasFactory;

    protected $table = 'chuyen_nganh';
    protected $guarded = [];

    public function nganh(): BelongsTo
    {
        return $this->belongsTo(Nganh::class, 'nganh_id', 'id');
    }

    public function monHoc()
    {
        return $this->hasMany(MonHoc::class, 'chuyen_nganh_id', 'id');
    }
}
