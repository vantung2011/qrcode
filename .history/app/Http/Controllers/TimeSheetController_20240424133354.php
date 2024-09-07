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
            $userScans = UserScan::whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")->get();
            });
            if ($userScans->count() >= 1) {
                return view('admin.timesheet', compact('userScans'));
            }
            return view('admin.timesheet', compact('userScans'));
        }
        return view('admin.timesheet', compact('userScans'));
    }
}
