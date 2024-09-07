<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
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
        if (!$user) {
            return response()->json(['error' => 'Không tồn tại user'], 404);
        }
        $todayDate = Carbon::today()->toDateString();
        $checkIn = UserScan::where('user_id', $user->id)->whereDate('check_in', $todayDate)->first();
        //Nếu đã checkin
        if ($checkIn) {
            if(!$checkIn->check_out){
                $timeDifferenceMinutes = Carbon::now()->diffInMinutes($user->check_in);
                $minimumScanInterval = 1;
                if ($timeDifferenceMinutes < 0) {
                    return response()->json(['error' => 'Too soon to scan again'], 400);
                }
                $checkIn->update(['check_out' => Carbon::now()]);
                return response()->json(['success' => 'Checked out successfully'], 200);
            }
            else {
                return response()->json(['error' => 'Đã có check-in và check-out cho ngày hôm nay'], 400);
            }
        }
        UserScan::create([
            'user_id' => $user->id,
            'check_in' => Carbon::now(),
        ]);
        return response()->json(['success' => true]);
    }
}
