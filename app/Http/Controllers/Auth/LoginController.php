<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect($this->redirectTo);
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ],
        [
            $this->username().'.required' => 'Chưa nhập tên đăng nhập',
            $this->username().'.string' => 'Tên đăng nhập hoặc mật khẩu không hợp lệ',
            $this->username().'.email' => 'Tên đăng nhập không hợp lệ',
            'password'.'.required' => 'Chưa nhập mật khẩu',
            'password'.'.string' => 'Mật khẩu không hợp lệ'
        ]
    );
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Tên đăng nhập hoặc mật khẩu không hợp lệ'],
        ]);
    }
    public function username()
    {
        return 'username';
    }
    protected function credentials(Request $request)
    {
        $username = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $arr =[
            $username => $request->username,
            'password' => $request->password
        ];
        return $arr;
    }

    
}
