<?php

namespace App\Http\Controllers\AuthStaff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Redirect;  
use App\Staff;
use Log;
use Illuminate\Support\Facades\Validator;
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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:staff')->except('logout');
    }
    public function showLoginForm(){
         $guestt = "staff";
        return view('authStaff.login',compact('guestt'));
    }
    public function showRegisterForm(){
        return view('authStaff.register');
    }
    public function register(Request $request){
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];
        $validated = Validator::make($request->all(), $rules);
        if($validated->fails()){
            return redirect()->back()->with('failed', 'Isi semua inputan');
        }
        if($request->password != $request->password_confirmation){
            return redirect()->back()->withInput($request->only('email', 'name'))->with('message', 'Confirm password tidak sama');
        }
        $isEmail = Staff::where('email',$request->email)->count();
        if($isEmail > 0){
           return redirect()->back()->withInput($request->only('name'))->with('message', 'Email sudah ada'); 
        }
        $staff = new Staff;
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->password = bcrypt($request->password);
        $staff->save();
        if($staff){
            $credential = [
                'email' => $request->email,
                'password' => $request->password
             ];
            if(Auth::guard('staff')->attempt($credential, $request->remember)){
                return redirect()->intended(route('staff.home'));        
            }
        }
        return redirect()->back()->withInput($request->only('email', 'name'))->with('message', 'Gagal mendaftar');
    }
    public function login(Request $request){    
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::guard('staff')->attempt($credential, $request->member)){
            Log::info("LOGIN STAFF");
            return redirect()->intended(route('staff.home'));        
        }
         return redirect()->back()->withInput($request->only('email', 'remember'))->with('message', 'Username atau password salah');
    }
    public function logout()
    {
        Auth::guard('staff')->logout();
        return redirect('/');
    }

}
