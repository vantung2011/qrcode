<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Salary;
use App\Models\UserScan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        if (Auth::check() && Auth::id() == $user->id) {
            $userScans = UserScan::where('user_id', $user->id)->get();
            return view('profile.index', compact('user', 'userScans'));
        } else {
            abort(403);
        }
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->save();
        return response()->json(['success' => true]);
    }
}
