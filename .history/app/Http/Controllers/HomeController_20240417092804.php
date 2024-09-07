<?php

namespace App\Http\Controllers;

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
    public function store(Request $request){
        
        $user = User::find($request->qrcodeData);
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return response()->json(['error' => 'Không thành công, user không tồn tại'], 404);
        }
        UserScan::create([
            'name' => $request->input('qrcodeData')
            's'
        ]);
    
        return response()->json(['success' => true]);
    }
}
