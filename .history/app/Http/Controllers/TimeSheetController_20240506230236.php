<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserScan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $query = UserScan::with('user');
        $today = Carbon::today();
        if (!$startDate && !$endDate) {
            $query->where('timesheets.created_at', $today);
        }
        if ($search) {
            $query->whereHas('user', function ($subquery) use ($search) {
                $subquery->where('name', 'like', '%' . $search . '%');
            });
        }
        if ($startDate) {
            $query->whereDate('timesheets.created_at', '>=', $startDate);
        }
    
        if ($endDate) {
            $query->whereDate('timesheets.created_at', '<=', $endDate);
        }
        $userScans = $query->get();
        return view('admin.timesheet', compact('userScans'));
    }
}
