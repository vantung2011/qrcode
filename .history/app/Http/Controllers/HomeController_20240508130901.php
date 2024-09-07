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
    public function qrcode(Request $request, User $user)
    {
        if ($request->qrcodeData) {
            $data = $request->qrcodeData;
            return view('admin.qrcode', compact('data'));
        }
    }
    public function store(Request $request)
    {
        $email = $request->input('qrcodeData');
        $user = User::where('email', $request->input('qrcodeData'))->first();
        if (!$user) {
            return response()->json(['error' => 'Không tồn tại user'], 404);
        }
        $todayDate = Carbon::today()->toDateString();
        $checkIn = UserScan::where('user_id', $user->id)->whereDate('check_in', $todayDate)->first();
        //Nếu đã checkin
        if ($checkIn) {
            if(!$checkIn->check_out){
                $checkIn->update(['check_out' => Carbon::now()]);
                return response()->json(['success' => 'Checked out successfully'], 200);
            }
            else {
                if(Salary::where('user_id', $user->id)){
                $salary = Salary::where('user_id', $user->id)->first();
                $workHours = intval($checkIn->check_in->diffInHours($checkIn->check_out));
                $work = intval($workHours);
                // $totalSalary = $workHours * $user->salary;
                // $salary->salary_amount += $totalSalary;
                // $salary->work_hours += $workHours;
                // $salary->save();
                    Salary::where('user_id',  $user->id)->update([
                        'work_hours' => $workHours,
                        'salary_amount' => $workHours * $user->salary
                    ]);
                }
                return response()->json(['error' => 'Đã có check-in và check-out cho ngày hôm nay'], 400);
            }
        }
        if (!Salary::where('user_id', $user->id)->exists()) {
            Salary::create([
                'user_id' => $user->id,
                'month' => Carbon::now()->format('Y-m'),
                'work_hours' => 0,
                'salary_amount' => 0
            ]);
        }
        UserScan::create([
            'user_id' => $user->id,
            'check_in' => Carbon::now(),
        ]);
        return response()->json(['success' => true]);
    }
}
