<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function show()
    {
        $data = User::select('users.*', 'work_shifts.name as work_shift_name', 'schedules.date as schedule_date')
        ->join('work_shifts', 'users.work_shift_id', '=', 'work_shifts.id')
        ->join('schedules', 'users.id', '=', 'schedules.user_id')
        ->get();
        dd($data);
    }
}
