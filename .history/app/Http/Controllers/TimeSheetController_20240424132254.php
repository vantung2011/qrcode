<?php

namespace App\Http\Controllers;

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
        $userScans = UserScan::paginate(5)->withQueryString();
        if ($request->search) {
            $search = $request->search;
            $userScans = DB::table('user_scans')
                ->join('users', 'user_scans.user_id', '=', 'users.id')
                ->select('user_scans.*', 'users.name')
                ->where('users.name', 'like', "%$search%")
                ->get();
            if ($users->count() >= 1) {
                return view('admin.timesheet', compact('userScans'));
            }
            return view('admin.timesheet', compact('userScans'));
        }
        return view('admin.timesheet', compact('userScans'));
    }
}
