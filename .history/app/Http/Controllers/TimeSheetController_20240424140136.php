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
        if ($request->search) {
            $search = $request->search;
            $userScans = UserScan::with('user');
            return view('admin.timesheet', compact('userScans'));
        }
        return view('admin.timesheet', compact('userScans'));
    }
}
