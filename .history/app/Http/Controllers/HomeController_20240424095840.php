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
        $checkIn = UserScan::where('user_id', $user->id)->whereDate('created_at', $todayDate)->first();
        
        if ($checkIn) {
            $timeDifferenceMinutes = Carbon::now()->diffInMinutes($checkIn->created_at);
            $minimumScanInterval = 0;
            if ($timeDifferenceMinutes > $minimumScanInterval) {
                $checkIn->update(['check_out' => Carbon::now()]);
                return response()->json(['success' => 'Checked out successfully'], 200);
            }
            else {
                return response()->json(['error' => ''], 400);
            }
        }
        UserScan::create([
            'user_id' => $user->id,
            'check_in' => '1',
        ]);

        return response()->json(['success' => true]);
    }
}
