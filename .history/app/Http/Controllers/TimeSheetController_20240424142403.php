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
        if ($search || $startDate || $endDate) {
            $userScansQuery = UserScan::with('user');
        
            // Áp dụng điều kiện tìm kiếm theo tên người dùng (user's name)
            if ($search) {
                $userScansQuery->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            }
            if ($startDate) {
                $userScansQuery->whereDate('created_at', '>=', $startDate);
            }
            if ($endDate) {
                $userScansQuery->whereDate('created_at', '<=', $endDate);
            }
            $userScans = $userScansQuery->get();
            return view('admin.timesheet', compact('userScans'));
        }
        return view('admin.timesheet', compact('userScans'));
    }
}
