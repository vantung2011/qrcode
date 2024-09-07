<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Salary;
use App\Models\UserScan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $salary = User::findOrFail($user->id);
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
                $workHours = $checkIn->check_in->diffInHours($checkIn->check_out);
                $totalSalary = $workHours * $user->salary;
                return response()->json(['error' => 'Đã có check-in và check-out cho ngày hôm nay'], 400);
            }
        }
        if (!Salary::where('user_id', $user->id)->exists()) {
            // Nếu không tồn tại, thêm mới
            Salary::create([
                'user_id' => $user->id,
                'month' => Carbon::now()->format('Y-m'),
                'work_hours' => 1,
                'salary_amount' => 1
            ]);
        }
        UserScan::create([
            'user_id' => $user->id,
            'check_in' => Carbon::now(),
        ]);
        return response()->json(['success' => true]);
    }
}
