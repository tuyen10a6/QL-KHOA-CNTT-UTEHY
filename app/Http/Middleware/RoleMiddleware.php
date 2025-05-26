<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->vaiTro->ten_vai_tro;
        
        // Kiểm tra quyền truy cập dựa trên role
        switch ($userRole) {
            case 'admin':
                // Admin có quyền truy cập tất cả
                return $next($request);
            
            case 'subAdmin':
                // SubAdmin có quyền truy cập các route dành cho subAdmin, lecturer và student
                if (in_array($role, ['subAdmin', 'lecturer', 'student'])) {
                    return $next($request);
                }
                break;
            
            case 'lecturer':
                // Lecturer có quyền truy cập các route dành cho lecturer và admin
                if (in_array($role, ['lecturer', 'admin'])) {
                    return $next($request);
                }
                break;
            
            case 'student':
                // Student có quyền truy cập các route dành cho student và các route chung với lecturer
                if ($role === 'student' || strpos($role, 'student') !== false) {
                    return $next($request);
                }
                break;
        }

        return redirect()->route('dashboard')->with('error', 'Bạn không có quyền truy cập!');
    }
}
