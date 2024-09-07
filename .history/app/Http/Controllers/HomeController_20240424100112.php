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
$user = User::where('email', $email)->first();

if (!$user) {
    return response()->json(['error' => 'User not found'], 404);
}

$todayDate = Carbon::today()->toDateString();

// Kiểm tra nếu đã có bản ghi check-out cho ngày hôm nay
$existingCheckOut = UserScan::where('user_id', $user->id)
    ->whereDate('check_out', $todayDate)
    ->first();

if ($existingCheckOut) {
    return response()->json(['error' => 'User already checked out today'], 400);
}

// Kiểm tra nếu đã có bản ghi check-in cho ngày hôm nay
$existingCheckIn = UserScan::where('user_id', $user->id)
    ->whereDate('check_in', $todayDate)
    ->first();

if ($existingCheckIn) {
    // Nếu đã có check-in, thực hiện check-out
    $existingCheckIn->update(['check_out' => Carbon::now()]);
    return response()->json(['success' => 'Checked out successfully'], 200);
}

// Nếu chưa có check-in cho ngày hôm nay, thực hiện check-in mới
$userScan = new UserScan();
$userScan->user_id = $user->id;
$userScan->check_in = now(); // Sử dụng Carbon để lấy thời gian hiện tại
$userScan->save();

return response()->json(['success' => 'Checked in successfully'], 200);
        
    }
}
