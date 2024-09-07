<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // lấy ra toàn bộ user
        Paginator::useBootstrapFive();
        $users = User::paginate(5)->withQueryString();
        if($request->search){
            $search = $request->search;
            $users = User::where('name', 'like', "%$search%")->orWhere('email','like',"%$search%")->paginate(5)->withQueryString();
            if($users->count() >=1){
                return view('admin.search',compact('users'))->render();
            }
            return view('admin.search',compact('users'))->with('searchError', 'Không tìm thấy kết quả nào!');
        }
        return view('admin.employees',compact('users'));
    }
    public function paginate()
    {
            Paginator::useBootstrapFive();
            $users = User::paginate(5)->withQueryString();
            return view('admin.pagination',compact('users'))->render();
    }
    public function store(Request $request){
        
        $validator =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'username' => ['required', 'string', 'max:100', 'unique:users'],
            'salary' => ['required', 'decimal:0,10000']
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make('123456')
        ]);
    
        return response()->json(['success' => true]);
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'editName' => ['required', 'string', 'max:255','unique:users,name,' . $id],
            'editEmail' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            // 'editUsername' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail($id);

        // Update user's data
        $user->name = $request->editName;
        $user->email = $request->editEmail;
        // $user->username = $request->editUsername;
        $user->save();

        // Return success response
        return response()->json(['success' => true]);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['success' => true]);
    }
    public function search(Request $request)
    {
        Paginator::useBootstrapFive();
    }
}
