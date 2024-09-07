<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Salary;
use App\Models\UserScan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SalaryController extends Controller
{
    public function show(){
        $userScans = User::join('salaries', 'salaries.user_id', '=', 'users.id')
        ->select('users.name', 'users.email', 'salaries.*') 
        ->get();
        return view('admin.salary', compact('userScans'));
    }
    public function showId(User $user)
    {
        if (Auth::check() && Auth::id() == $user->id) {
            $salaries = Salary::where('user_id', $user->id)->get();
        return view('user.salary', compact('user','salaries'));
    }
    else {
        abort(403);
    }
    }
    public function update(Request $request,$id){
        $user = Salary::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'status' => ['required', Rule::in([0, 1])],
        ]); 
        if ($user->status == 1) {
            return response()->json(['error' => ''], 403);
        }
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => true]);
    }
}
