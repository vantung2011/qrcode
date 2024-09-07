<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserScan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class TimeSheetController extends Controller
{
    public function index(Request $request)
    {
        // lấy ra toàn bộ user
        Paginator::useBootstrapFive();
        $userScans = UserScan::with('user')->get();
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Bắt đầu truy vấn từ model UserScan với eager loading của relationship 'user'
        $query = UserScan::with('user');
    
        // Áp dụng điều kiện tìm kiếm theo tên người dùng (user's name)
        if ($search) {
            $query->whereHas('user', function ($subquery) use ($search) {
                $subquery->where('name', 'like', '%' . $search . '%');
            });
        }
    
        if ($startDate) {
            $query->whereDate('user_scans.created_at', '>=', $startDate);
        }
    
        if ($endDate) {
            $query->whereDate('user_scans.created_at', '<=', $endDate);
        }
        $userScans = $query->get();
    
        // Trả về view với kết quả tìm kiếm
        return view('admin.timesheet', compact('userScans'));
    }
}
