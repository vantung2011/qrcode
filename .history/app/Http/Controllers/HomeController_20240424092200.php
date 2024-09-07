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
        $scanCount = UserScan::where('user_id', $user->id)->whereDate('created_at', $todayDate)->get();
        if ($scanCount) {
            $timeDifferenceMinutes = Carbon::now()->diffInMinutes($scanCount->created_at);
            $minimumScanInterval = 0;
            if ($timeDifferenceMinutes < $minimumScanInterval) {
                return response()->json(['error' => ''], 400);
            }
        }
        if ($scanCount > 1) {
            return response()->json(['error' => 'User not found'], 404);
        }
        UserScan::create([
            'user_id' => $user->id,
            'check_in' => Carbon::now(),
        ]);

        return response()->json(['success' => true]);
    }
}
