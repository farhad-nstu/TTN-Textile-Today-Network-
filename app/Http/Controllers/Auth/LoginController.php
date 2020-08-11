<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
//use App\Models\Admin\Admin;

class LoginController extends Controller {

    use AuthenticatesUsers;
    
    protected $redirectTo = '/home';
    
    public function __construct() {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }
    
    public function show_admin_login_form(){
        return view('auth.login', ['url' => 'admin']);
    }
    
    public function admin_login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        
        if(Auth::guard('admin')->attempt(
                ['email' => $request->email, 'password' => $request->password,
                'status' => 10],
                $request->get('remember'))){
            
            return redirect()->intended('/admin/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
}
