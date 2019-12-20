<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Redirect;  
use App\Admin;
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
        $this->middleware('guest:admin')->except('logout');
    }
    public function showLoginForm(){
        $guestt = "admin";
        return view('authAdmin.login',compact('guestt'));
    }
    public function showRegisterForm(){
        return view('authAdmin.register');
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
        $isEmail = Admin::where('email',$request->email)->count();
        if($isEmail > 0){
           return redirect()->back()->withInput($request->only('name'))->with('message', 'Email sudah ada'); 
        } 
        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();
        if($admin){
            $credential = [
                'email' => $request->email,
                'password' => $request->password
             ];
            if(Auth::guard('admin')->attempt($credential, $request->remember)){
                return redirect()->intended(route('admin.home'));        
            }
        }
        return redirect()->back()->withInput($request->only('email', 'name'))->with('message', 'Gagal mendaftar');
    }
    public function login(Request $request){   
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];
        Log::info("remember: ".$request->remember);
        if(Auth::guard('admin')->attempt($credential, $request->remember)){
            return redirect()->intended(route('admin.home'));        
        }
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('message', 'Username atau password salah');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }

}
