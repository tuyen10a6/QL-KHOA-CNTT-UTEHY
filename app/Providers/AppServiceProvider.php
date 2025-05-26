<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.main', function ($view) {
            $user = Auth::user();

            if ($user) {
                $notifications = Notification::where('nguoi_dung_id', $user->id)
                    ->where('loai_thong_bao', 'Thông báo') // Thêm điều kiện này để chỉ lấy các thông báo
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
                $unreadCount = Notification::where('nguoi_dung_id', $user->id)
                    ->where('loai_thong_bao', 'Thông báo') // Thêm điều kiện này để đếm số thông báo chưa đọc
                    ->where('da_xem', false)
                    ->count();
                $emergencyAlerts = Notification::where('nguoi_dung_id', $user->id)
                    ->where('loai_thong_bao', 'Cảnh báo khẩn cấp')
                    ->where('da_xem', false) // Chỉ lấy thông báo chưa đọc
                    ->get();
            } else {
                $notifications = collect();
                $unreadCount = 0;
                $emergencyAlerts = collect(); // Không có cảnh báo khẩn cấp
            }

            // Truyền dữ liệu sang view
            $view->with('notifications', $notifications)
                ->with('unreadCount', $unreadCount)
                ->with('emergencyAlerts', $emergencyAlerts);
        });
    }
}
