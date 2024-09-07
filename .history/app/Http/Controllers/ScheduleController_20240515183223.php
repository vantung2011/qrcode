<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function show()
    {
        $schedules = Schedule::select('schedules.*', 'users.name as user_name', 'work_shifts.name as shift_name')
        ->join('users', 'users.id', '=', 'schedules.user_id')
        ->join('work_shifts', 'work_shifts.id', '=', 'schedules.shift_id')
        ->get();
        return view('admin.schedule',compact('users'));
    }
}
