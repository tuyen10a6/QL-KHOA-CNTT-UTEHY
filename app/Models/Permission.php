<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // Tên bảng
    protected $table = 'quyen';

    protected $fillable = [
        'user_id',
        // User permissions
        'can_view_user',
        'can_create_user',
        'can_edit_user',
        'can_delete_user',
        'can_assign_permissions',
        
        // Khoa permissions
        'can_view_khoa',
        'can_create_khoa',
        'can_edit_khoa',
        'can_delete_khoa',
        
        // Mon hoc permissions
        'can_view_monhoc',
        'can_create_monhoc',
        'can_edit_monhoc',
        'can_delete_monhoc',
        
        // Lich hoc permissions
        'can_view_lichhoc',
        'can_create_lichhoc',
        'can_edit_lichhoc',
        'can_delete_lichhoc',
        
        // Dang ky mon hoc permissions
        'can_view_dangkymonhoc',
        'can_create_dangkymonhoc',
        'can_edit_dangkymonhoc',
        'can_delete_dangkymonhoc',
    ];

    // Định nghĩa quan hệ với model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
