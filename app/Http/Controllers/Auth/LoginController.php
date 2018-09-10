<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    /**
     * Overide Login
     */
    public function login(Request $request)
    {

      if (Auth::attempt(['email' => $request->email, 'password' => $request->password],true)) {
        return response()->json(array(
          'code'      =>  200,
          'url'   =>  $this->redirectTo
        ), 200);    
      }

      return response()->json(array(
        'code'      =>  401,
        'message'   =>  "incorrect credentials"), 401);
    }
}
