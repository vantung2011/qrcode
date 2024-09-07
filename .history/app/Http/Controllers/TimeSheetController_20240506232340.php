<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserScan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;

class TimeSheetController extends Controller
{
    public function index(Request $request)
    {
        // lấy ra toàn bộ user
        Paginator::useBootstrapFive();
        $userScans = UserScan::with('user')->get();
        $search = $request->input('search') ?? Session::get('search');
        $startDate = $request->input('start_date') ?? Session::get('start_date');
        $endDate = $request->input('end_date') ?? Session::get('end_date');
        $query = UserScan::with('user');
        $today = Carbon::today();
        Session::put('search', $search);
        Session::put('start_date', $startDate);
        Session::put('end_date', $endDate);
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
