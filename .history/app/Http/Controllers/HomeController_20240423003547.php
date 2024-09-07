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
    public function qrcode(Request $request,User $user)
    {
        if($request->qrcodeData){
            $data = $request->qrcodeData;
            return view('admin.qrcode', compact('data'));
        }
    }
    public function store(Request $request)
    {
        $qrcodeData = $request->input('qrcodeData');
        $user = User::where('email', $qrcodeData)->first();
        $todayDate = Carbon::today()->toDateString();
    
        if (!$user) {
            // User not found, redirect back with an error message
            return redirect()->route('qrcode.index')->with('error', 'User not found');
        }
    
        $scanCount = UserScan::where('user_id', $user->id)->whereDate('scan_time', $todayDate)->count();
    
        // Assuming you want to limit to 1 scan per day
        if ($scanCount >= 1) {
            // Redirect back with an error message if scan count is exceeded
            return redirect()->route('qrcode.index')->with('error', 'Scan limit exceeded for today');
        }
    
        $scanType = ($scanCount % 2 == 0) ? 'check-in' : 'check-out';
    
        // Create new scan record
        UserScan::create([
            'user_id' => $user->id,
            'scan_time' => Carbon::now(),
            'scan_type' => $scanType
        ]);
    
        // Redirect back with success message
        return redirect()->route('qrcode.index')->with('success', 'Scan recorded successfully');
    }
}
