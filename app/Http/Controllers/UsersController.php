<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\ProfileSettingUser;
use App\Models\Education;
use App\Models\Admin\ProfileSetting;
use App\Models\Admin\Country;
use App\Models\Admin\State;
use App\Models\Admin\City;
use App\Mail\MailtrapExample;
use App\Mail\SendEmailToResetPassword;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailActiveMessageToUser;
use App\Mail\SendEmailActiveMessageToAdmin;
use App\Models\Image;
use Validator;
class UsersController extends Controller {
    var $User;
    public function change_user_Privacy(Request $request, $id ){
        $count = ProfileSettingUser::where('user_id', $id)->count();
        $changes = ProfileSettingUser::where('user_id', $id)->get();
        foreach($changes as $change){
            if($change->profile_setting_id ==3){
                $change->status = $request->communityStatus;
                $change->update();
            }else if($change->profile_setting_id ==5){
                $change->status = $request->workingHistoryStatus;
                $change->update();
            }else if($change->profile_setting_id ==10){
                $change->status = $request->socialLinkStatus;
                $change->update();
            }else if($change->profile_setting_id ==7){
                $change->status = $request->professionStatus;
                $change->update();
            }
            
        }
        $result['response'] = 'success';
        $result['message'] = 'Privacy changed successfull.';   
         return response()->json($result);
    }
    public function get_user_privay_data($id){
        $userPrivacyStatus = ProfileSettingUser::where('user_id', $id)->get();
        return  $userPrivacyStatus;
    }
    public function active_admin_account(Request $request ){
        $user = User::where('verified_token', $request->token)->first();
        if(!empty($user)){
            $user->status = 30;
            $user->email_verified_at = now();
            $user->verified_token = null;
            $user->update();
            return compact('user');
        }else{
            $status = 401;
            $response = [
                'message' => 'Internal error. can`t active admin account',
                'success' => false,
            ];
            return response()->json($response, $status);
        }
    }
    public function active_user_account(Request $request ){
        $user = User::where('verified_token', $request->token)->first();
        if(!empty($user)){
            $user->status = 10;
            $user->email_verified_at = now();
            $user->verified_token = null;
            $user->update();
            $count = ProfileSetting::all()->count();
            for($i=1; $i<=$count; $i++){
                $privacy = new ProfileSettingUser();
                $privacy->user_id = $user->id;
                $privacy->profile_setting_id = $i;
                $privacy->status = 20;
                $privacy->save();
            }
            return compact('user');
        }else{
            $status = 401;
            $response = [
                'message' => 'Internal error. can`t active user account.',
                'success' => false,
            ];
            return response()->json($response, $status);
        }
    }
    public function reset_password(Request $request ){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user = User::where('remember_token', $request->token)->first();
        if(!empty($user)){
            $user->password = bcrypt($request->password);
            $user->remember_token = null;
            $user->update();           
            $status = 200;
            $result = [
                'message' => 'Password reset successful.',
                'response' => 'success',
            ];
        }else{
            $result = [
                'message' => 'Internal error. Password can`t reset.',
                'response' => 'error',
            ];           
        }
        return response()->json($result);
    }
    public function login(Request $request) {
        if (Auth::attempt($request->only(['email', 'password']))) {
            if(Auth::user()->role_id == 10 && Auth::user()->status == 10 ){
                $status = 200;
                $response = [
                    'user' => Auth::user(),
                    'token' => Auth::user()->createToken('TTNetwork')->accessToken,
                ];
            }else{
                $status = 401;
                $response = [
                    'message' => 'Your account does not active.Please check your email and active account.',
                    'err' => 'inActive',
                ];
            }
        }else{
            $status = 401;
            $response = [
                'message' => 'Incorrect Email and/or Password! Please enter valid email and/or password',
                'err' => 'invalidUser',
            ];
        }
        return response()->json($response, $status);
    }
    public function admin_login(Request $request){
        $status = 401;
        $response = ['error' => 'Unauthorised'];
        if (Auth::attempt($request->only(['email', 'password']))) {
            if(Auth::user()->role_id == 1  && Auth::user()->status == 10){
                $status = 200;
                $response = [
                    'user' => Auth::user(),
                    'token' => Auth::user()->createToken('TTNetwork')->accessToken,
                ];
            }else{
                $status = 401;
                $response = [
                    'message' => 'Your account does not active.Please check your email and active account.',
                    'err' => 'inActive',
                ];
            }
        }else{
            $status = 401;
            $response = [
                'message' => 'Incorrect Email and/or Password! Please enter valid email and/or password',
                'err' => 'invalidAdmin',
            ];        
        }
        return response()->json($response, $status);
    }
    public function check_email_exist($email){
        if (request()->wantsJson()){
            $emails=User::where('email', $email)->count();
            if ($emails>0){
                $result['response'] = 'error';
                $result['message'] = 'This email has already been taken.';              
            }              
           else{
            $result['response'] = 'success';
            $result['message'] = 'This email in available';   
           }
        }
        return response()->json($result);
    }
    public function forgot_password($email){
        if (request()->wantsJson()){
            $user=User::where('email', $email)->first();
            if (!empty($user)){
                $token = base64_encode($user->email);
                $user->remember_token = $token;
                $user->token_sent_at = now();
                $user->save();
                Mail::to($user->email)->send(new SendEmailToResetPassword($user, $token));
                $status = 200;
                $response = [
                    'message' => 'Send an email for reset password.',
                    'success' => true,
                ];
                return response()->json($response, $status);
            }
            else{
                $status = 401;
                $response = [
                    'message' => 'Internal error. can`t send email for reset passowrd.',
                    'success' => false,
                ];
                return response()->json($response, $status);
            }
        }
    }
    public function check_phone_exist($phone){
        if (request()->wantsJson()){
            $phones=User::where('phone', $phone)->count();
            if ($phones>0){
                $result['response'] = 'error';
                $result['message'] = 'This phone number has already been taken.';              
            }              
           else{
            $result['response'] = 'success';
            $result['message'] = 'This phone number in available';   
           }
        }
        return response()->json($result);
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $data = $request->only(['name', 'email','phone', 'password']);
        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = 10;//member
        $data['status'] = 20;
        $token = base64_encode($request->email);
        $data['verified_token'] = $token;
        $user = User::create($data);
        //send verification email
        Mail::to($request->email)->send(new SendEmailActiveMessageToUser($user, $token));
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('TTNetwork')->accessToken,
        ]);
    }
    public function admin_register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $data = $request->only(['name', 'email','phone', 'password']);
        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = 1;//member
        $data['status'] = 20;
        $token = base64_encode($request->email);
        $data['verified_token'] = $token;
        $user = User::create($data);
        Mail::to($request->email)->send(new SendEmailActiveMessageToAdmin($user, $token));
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('TTNetwork')->accessToken,
        ]);
    }
    public function update_user_basic_Info(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user = User::find($id);
        if(!empty($user)){
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->alternate_phone = $request->alternate_phone;
            $user->date_of_birth = $request->date_of_birth;
            $user->country_id = $request->country_id;
            $user->state_id = $request->state_id;
            $user->city_id = $request->city_id;
            $user->post_code = $request->post_code;
            $user->address = $request->address;
            $user->about_yourself = $request->about_yourself;
            $user->billing_address = $request->billing_address;
            $user->alternate_billing_address = $request->alternate_billing_address;
            $user->facebook_link = $request->facebook_link;
            $user->twitter_link = $request->twitter_link;
            $user->linkedin_link = $request->linkedin_link;
            $user->instagram_link = $request->instagram_link;
            $user->youtube_link = $request->youtube_link;
            $user->website = $request->website;
            $user->update();
            $result['user'] = $user;
            $result['response'] = 'success';
            $result['message'] = 'User basic info updated successfull.';            
        }else{
            $result['response'] = 'error';
            $result['message'] = 'User basic info can not updated.';   
        }
        return response()->json($result);
    }
    public function update_resume(Request $request, $id){
        $user = User::find($id);
        $fileName = time().'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(public_path('/files/resume/'), $fileName);
        $user->resume = $fileName;
        $user->save();
        return response()->json(['success'=>'You have successfully upload file.']);
    }
    public function update_cover_picture(Request $request, $id) {   
        $user = User::find($id);
        $background_banner = '';
        if(!empty($request->background_banner)){
            $response = Image::upload_file($request->background_banner, $id,'coverPicture' , 'Users', true);
            if($response['response']=='success'){
                $background_banner = $response['file_name'];
            }
        }else{
              $background_banner = $user->background_banner;
        }
        $user->background_banner = $background_banner;
        $user->update();
        $result['user'] = $user;
        $result['response'] = 'success';
        $result['message'] = 'Cover picture updated successfull.';   
        return response()->json($result);
    }
    public function update_profile_picture(Request $request, $id) {
        $user = User::find($id);
        $profile_picture = '';
        if(!empty($request->profile_picture)){
            $response = Image::upload_file($request->profile_picture, $id,'profilePicture' , 'Users', true);
            if($response['response']=='success'){
                $profile_picture = $response['file_name'];
            }
        }else{
              $profile_picture = $user->profile_picture;
        }
        $user->profile_picture = $profile_picture;
        $user->update();
        $result['user'] = $user;
        $result['response'] = 'success';
        $result['message'] = 'Profile picture updated successfull.';   
         return response()->json($result);
    }
    public function change_password(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'repeat_password' => 'required|same:new_password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user = User::find($id);
        if (Hash::check($request->input('old_password'), $user->password) && ($request->input('new_password') == $request->input('repeat_password'))) {
            $user->update([
                'password' => Hash::make($request->input('new_password'))
            ]);
            $result['response'] = 'success';
            $result['message'] = 'Password reset successfull.';   
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Password can not reset! Please try again.';           
        }
        return response()->json($result);
    }
    public function profile($id) {
        $menus = $this->get_navigation_menus();
        return view('users.profile', compact('menus'));
    }
    public function admin_list() {
        $admins = User::where('role_id', 1)->get();
        return compact('admins');
    }
    public function admin_verify($id) {
        $admin = User::find($id);
        $admin->status = 10;
        $admin->save();
        return "verified";
    }
    public function admin_disapprove($id) {
        $admin = User::find($id);
        $admin->status = 30;
        $admin->save();
    }
    public function get_countries() {
        $countries = Country::pluck('name', 'id');
        $countries[0] = '-- Select Country --';
        return  compact('countries');
    }
    public function get_states($country_id) {
        $states = State::where('country_id',$country_id)->pluck('name', 'id');
        $states[0] = '-- Select State --';
        return  $states;
    }
    public function get_cities($state_id) {
        $cities = City::where( 'state_id', $state_id)->pluck('name', 'id');
        $cities[0] = '-- Select City --';
        return  $cities;
    }
}
