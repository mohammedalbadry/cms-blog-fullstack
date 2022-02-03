<?php

namespace App\Http\Controllers\CPanal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use Mail;
use Auth;
use DB;

class AdminAuthController extends Controller
{
    public $model_name = "App\Models\Admin";
    public $view_routh = "cpanal.auth";
    public $url_prefix = 'admin';

    //show login view
    public function Login(){
        
         if (Auth::guard('admin')->check()){
            return redirect($this->url_prefix);
        } else {
            return view($this->view_routh . '.login');
        }  
    }
    
    //validate and check admin with admin guard
    public function doLogin(Request $request){

        $data = $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);
        $remember = $request->remember == 'on' ? true : false;

        if (Auth::guard('admin')->attempt($data ,$remember)) {
            return redirect($this->url_prefix);
        } else {
            session()->flash('erorr', 'بيانات الاتصال غير صحيحة');
            return redirect($this->url_prefix . '/login');
        }

    }

    //logout and redirect
    public function Logout(){
        Auth::guard('admin')->logout();
        
        return redirect($this->url_prefix . '/login');
    }

    //show forgot password view
    public function ForgotPassword(){
        return view($this->view_routh . '.forgot_password');
    }
    
    //create token and send email
    public function DoForgotPassword(Request $request){
        //get admin
        $admin = $this->model_name::where('email', $request->email)->first();

        if(!empty($admin)){
            //create token
            $token = app('auth.password.broker')->createToken($admin);
            //insert data
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token'=> $token,
                'created_at'=>Carbon::now()    
            ]);
            mail::to($admin->email)->send(new AdminResetPassword(['data'=>$admin,'token'=>$token]));
            session()->flash('success', 'تم الارسال بنجاح');
            return back();
        } else {
            session()->flash('erorr', 'البيانات غير صحيحة');
            return back();
        }

    }

    //check token and show reset password view
    public function ResetPassword($token){
        $token = DB::table('password_resets')->where('token', $token)
        ->where('created_at', '>' ,Carbon::now()->subHours(2))->first();

        if(! empty($token)) {
            return view($this->view_routh . '.reset_password', ['data'=>$token]);
        } else {
            session()->flash('erorr', 'البيانات غير صحيحة');
            return view($this->view_routh . '.forgot_password');
        }
    }

    //validate and reset password
    public function DoResetPassword(Request $request, $token) {

        $this->validate(request(),[
            'email'     => 'required',
            'password'  => 'required|confirmed|min:6',
        ]);
        $token = DB::table('password_resets')->where('token', $token)
                                             ->where('email', $request->email)
                                             ->where('created_at', '>' ,Carbon::now()->subHours(2))->first();

        if(! empty($token)) {
            $admin = $this->model_name::where('email', $token->email)
            ->update([
                'email' => $token->email,
                'password' => bcrypt(request('password'))
            ]);

            DB::table('password_resets')->where('email', request('email'))->delete();
            return redirect(aurl('login'));
        } else {
            session()->flash('erorr', 'البيانات غير صحيحة');
            return back();
        }

    }
}
