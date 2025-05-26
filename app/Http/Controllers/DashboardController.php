<?php

namespace App\Http\Controllers;

use App\Models\Nganh;
use App\Models\Notification;
use App\Models\TinTuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->vai_tro_id === 1 || $user->vai_tro_id === 3) { // admin hoặc lecturer
            return redirect()->route('admin.dashboard');
        }

        $tinTuc = TinTuc::where('trang_thai', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $notifications = Notification::where('nguoi_dung_id', auth()->id())
            ->orWhere('nguoi_dung_id', null) // Thông báo chung cho tất cả
            ->latest()
            ->take(5)
            ->get();

        $nganhs = Nganh::all();

        return view('pages.dashboard.index', compact('tinTuc', 'notifications', 'nganhs'));
    }
}
