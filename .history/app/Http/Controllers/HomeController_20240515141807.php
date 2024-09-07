<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserScan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Salary;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.qrcode');
    }
    // public function store(Request $request)
    // {
    //     $email = $request->input('qrcodeData');
    //     $user = User::where('email', $request->input('qrcodeData'))->first();
    //     if (!$user) {
    //         return response()->json(['error' => 'Không tồn tại user'], 404);
    //     }
    //     $todayDate = Carbon::today()->toDateString();
    //     $checkIn = UserScan::where('user_id', $user->id)->whereDate('check_in', $todayDate)->first();
    //     if ($checkIn) {
    //         $timeDifferenceMinutes = Carbon::now()->diffInSeconds($checkIn->check_in);
    //         $minimumScanInterval = 10;
    //         if(!$checkIn->check_out && $timeDifferenceMinutes > $minimumScanInterval) {
    //             $checkIn->update(['check_out' => Carbon::now()]);
    //             if(Salary::where('user_id', $user->id)){
    //                 $currentMonth = Carbon::now()->format('Y-m');
    //                 $startTime = Carbon::parse($checkIn->check_in); 
    //              $endTime = Carbon::parse($checkIn->check_out);
    //              $diffInMinutes = $endTime->diffInMinutes($startTime);
    //              $diffInHours = round($diffInMinutes / 60, 2);
    //              $salary_amount = round($user->salary*$diffInHours,-3);
    //                 Salary::where('user_id', $user->id)->where('month',$currentMonth)->increment('work_hours', $diffInHours);
    //                 Salary::where('user_id', $user->id)->where('month',$currentMonth)->increment('salary_amount', $salary_amount);
    //             }
    //             return response()->json(['success' => 'Checked out successfully'], 200);
    //         }
    //         else {
    //             return response()->json(['error' => 'Đã có check-in và check-out cho ngày hôm nay'], 400);
    //         }
    //     }
    //     if (!Salary::where('user_id', $user->id)->where('month', Carbon::now()->format('Y-m'))->exists()) {
    //         Salary::create([
    //             'user_id' => $user->id,
    //             'month' => Carbon::now()->format('Y-m'),
    //             'work_hours' => 0,
    //             'salary_amount' => 0
    //         ]);
    //     }
    //     UserScan::create([
    //         'user_id' => $user->id,
    //         'check_in' => Carbon::now(),
    //     ]);
    //     return response()->json(['success' => true]);
    // }
}
