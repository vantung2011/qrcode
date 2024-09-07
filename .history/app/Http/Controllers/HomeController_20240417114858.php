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
        $user = User::find($request->input('qrcodeData'));

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $scanCount = UserScan::where('user_id', $user->id)->count();
        $scanType = ($scanCount % 2 !== 0) ? 'check-in' : 'check-out';
        UserScan::create([
            'user_id' => $user->id,
            'scan_time' => Carbon::now(),
            'scan_type' => $scanType
        ]);

        return response()->json(['success' => true]);
    }
}
