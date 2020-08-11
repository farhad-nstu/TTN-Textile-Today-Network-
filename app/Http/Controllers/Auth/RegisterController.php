<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller {

    use RegistersUsers;
    
    var $User;
    var $Admin;
    
    public function __construct() {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->User = new User();
        $this->Admin = new Admin();
    }
    
    protected function validator(array $data, $tableName = 'users') {
        if($tableName == 'users'){
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'alpha_num','confirmed'],
            ]);
        }else{
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
                'password' => ['required', 'string', 'min:8', 'alpha_num','confirmed'],
            ]);
        }
    }


    protected function create(array $data) {        
        $data = $this->User->getAutoFillData($data);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 2, //General user
            'status' => $this->get_status_id_by_title('user', 'Not verified')
        ]);
    }
    
    public function show_admin_register_form(){
        return view('auth.register', ['url' => 'admin']);
    }
    
    protected function admin_register(Request $request){
        $this->validator($request->all(), 'admins')->validate();
        $data = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'status' => $this->get_status_id_by_title('admin', 'Not verified')
        ]);
        return redirect()->intended('/controller/login');
    }
}
