<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'nguoi_dung'; // Sử dụng bảng 'nguoi_dung'

    /**
     * Các cột có thể điền vào bằng cách sử dụng mass assignment
     */
    protected $guarded = [];

    /**
     * Các cột cần được ẩn khi trả về dữ liệu (ví dụ, ẩn mật khẩu và token)
     */
    protected $hidden = [
        'mat_khau', 'remember_token',
    ];

    public function monHocs()
    {
        return $this->belongsToMany(MonHoc::class, 'giang_vien_mon_hoc');
    }


    /**
     * Phương thức để lấy mật khẩu dùng cho authentication
     */
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }
    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'khoa_id');
    }
    public function vaiTro()
    {
        return $this->belongsTo(Role::class, 'vai_tro_id');
    }
    public function thongBao()
    {
        return $this->hasMany(Notification::class, 'nguoi_dung_id');
    }
    public function maintenanceSchedule()
    {
        return $this->hasMany(MaintenanceSchedule::class, 'nguoi_thuc_hien_id');
    }
    public function actions()
    {
        return $this->hasOne(Permission::class, 'user_id');
    }

    // Kiểm tra xem người dùng có quyền sửa không
    public function canCreateUser()
    {
        return $this->actions ? $this->actions->can_create_user : false;
    }
    public function canEditUser()
    {
        return $this->actions ? $this->actions->can_edit_user : false;
    }

    public function canDeleteUser()
    {
        return $this->actions ? $this->actions->can_delete_user : false;
    }
    public function canCreateDevice()
    {
        return $this->actions ? $this->actions->can_create_device : false;
    }
    public function canEditDevice()
    {
        return $this->actions ? $this->actions->can_edit_device : false;
    }

    public function canDeleteDevice()
    {
        return $this->actions ? $this->actions->can_delete_device : false;
    }

    public function canCreateSchedule()
    {
        return $this->actions ? $this->actions->can_create_schedule : false;
    }
    public function canEditSchedule()
    {
        return $this->actions ? $this->actions->can_edit_schedule : false;
    }

    public function canDeleteSchedule()
    {
        return $this->actions ? $this->actions->can_delete_schedule : false;
    }
    public function canCreateNotification()
    {
        return $this->actions ? $this->actions->can_create_notification : false;
    }
    public function canCreateReport()
    {
        return $this->actions ? $this->actions->can_create_report : false;
    }
}
