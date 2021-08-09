<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
    protected $redirectTo = RouteServiceProvider::HOME;
        protected function redirectTo(request $request){
            if(auth()->user()->role==1){
                return route('admin.dashboard');
            }
            elseif (auth()->user()->role==2) {


                return route('tasks.index');
            }
        }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            if(auth()->user()->is_admin==1)
            {
                return redirect()->route('admin.dashboard');
            } elseif (auth()->user()->is_admin==0) {
                return redirect()->route('tasks.index');
            } 
            else {
                return redirect()->route('login')->with('error','invalid credentials');
            }
            
        }

    }
}
