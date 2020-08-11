<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Education;
use App\Models\WorkingHistory;
use App\Models\Admin\Skill;
use App\Models\UserConnection;
use Validator;
class ProfilesController extends Controller {
    // public function __construct(){
    //     $this->middleware('auth:api');
    // }
    // public function show_image(Request $request, $userId, $imagePath) {
    //     echo 'here....';exit;
    //     $path = storage_public('images/' . $imagePath);
    //     if (!File::exists($path)) {
    //         abort(404);
    //     }
    //     $file = File::get($path);
    //     $type = File::mimeType($path);
    //     $response = Response::make($file, 200);
    //     $response->header("Content-Type", $type);
    //     return $response;
    // }

    public function update_Location(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'post_code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([ 'response' => 'error','error' => $validator->errors()],  401);
        }
         $user = User::find($id);
         $user->country_id = $request->country_id;
         $user->state_id = $request->state_id;
         $user->city_id = $request->city_id;
         $user->post_code = $request->post_code;
         $user->update();
        if( $user){
            $result = [
                'response' => 'success',
                'message' => 'Location updated successfull',
             ];
        }else{
            $result = [
                'response' => 'error',
                'message' => 'Location can`t updated ',
             ];
        }
        return response()->json($result);
    }
    public function add_experience(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'job_title' => 'required',
            'company_name' => 'required',
            'joined_at' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json([ 'response' => 'error','error' => $validator->errors()],  401);
        }
        $data = $request->only(['job_title', 'company_name', 'responsibilities','joined_at', 'left_at']);
        $data['user_id'] = $id;
        $experience = WorkingHistory::create($data);
        if($experience){
            $result = [
                'response' => 'Success',
                'message' => 'Education updated successfull',
             ];
        }else{
            $result = [
                'response' => 'Error',
                'message' => 'Education can`t updated ',
             ];
        }
        return response()->json($result);
    }
    public function update_experience(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'job_title' => 'required',
            'company_name' => 'required',
            'joined_at' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([ 'response' => 'error','error' => $validator->errors()],  401);
        }
        $experience = WorkingHistory::find($id);
        $experience->update($request->all());
        if($experience){
            $result = [
                'response' => 'Success',
                'message' => 'Experience updated successfull',
             ];          
        }else{
            $result = [
                'response' => 'Error',
                'message' => 'Experience can`t updated ',
             ];
        }
        return response()->json($result);
    }
    public function delete_experience($id){
        $experience = WorkingHistory::find($id);
         $experience->delete();
       $result = [
              'response' => 'Success',
              'message' => 'Experience deleted successfull',
       ];
       return response()->json($result);
    }
    public function update_education(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'institute_name' => 'required',
            'degree_name' => 'required',
            'passing_year' => 'required|numeric|digits:4',
            'cgpa' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([ 'response' => 'error','error' => $validator->errors()],  401);
        }
        $education = Education::find($id);
        $education->update($request->all());
        if($education){
            $result = [
                'response' => 'Success',
                'message' => 'Education updated successfull',
             ];          
        }else{
            $result = [
                'response' => 'Error',
                'message' => 'Education can`t updated ',
             ];
        }
        return response()->json($result);
    }
    public function add_education(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'institute_name' => 'required',
            'degree_name' => 'required',
            'passing_year' => 'required|numeric|digits:4',
            'cgpa' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([ 'response' => 'error','error' => $validator->errors()],  401);
        }
        $data = $request->only(['institute_name', 'degree_name','passing_year', 'cgpa']);
        $data['user_id'] = $id;
        $education = Education::create($data);

        if($education){
            $result = [
                'response' => 'Success',
                'message' => 'Education added successfull',
             ];           
        }else{
            $result = [
                'response' => 'Error',
                'message' => 'Education can`t added',
             ];
        }
        return response()->json($result);
    }
    public function delete_education($id){
        $education = Education::find($id);
        $education->delete();
       $result = [
              'response' => 'Success',
              'message' => 'Education deleted successfull',
       ];
       return response()->json($result);
    }
    public function update_about_your_self(Request $request, $id) {
        $user = User::find($id);
         $user->about_yourself = $request->about_yourself;
         $user->update();
        if( $user){
            return response()->json(['user' => $user,'response' => 'success', 'message' => 'About yourself added successfull'], 200);
        }else{
            return response()->json(['response' => 'error', 'message' => 'About yourself can`t  added'], 401);
        }       
    }
    public function add_skills(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'skill_id' => 'unique:skill_user,skill_id,NULL,id,user_id,' . $id,
        ]);
        if ($validator->fails()) {
            return response()->json(['response' => 'error','error' => $validator->errors()], 401);
        }
        $user = User::find($id);
         $user->skills()->attach($request->skill_id);
        if( $user){
            return response()->json(['response' => 'success', 'message' => 'Skill added successfull'], 200);

        }else{
            return response()->json(['response' => 'error', 'message' => 'Skill can`t  added'], 401);
        }       
    }
    public function get_all_skills(){
        $allSkills = Skill::pluck('title','id');
        $allSkills[0]="---Select Skill---";
        return  compact('allSkills');
    }
    public function get_user_info($id){    
        $userData = User::with('country','state','city')->find($id);
        return compact('userData');
    }
    public function get_user_educations($id){  
        $educations = Education::where('user_id',$id)->get();
        return compact('educations');
    }
    public function get_user_experiences($id) {  
        $experiences = WorkingHistory::where('user_id',$id)->get();
         return compact('experiences');
    }
    public function get_user_skills($id){  
        $userSkills = User::find($id)->skills->pluck('title', 'id');
        return compact('userSkills');
    }
}
