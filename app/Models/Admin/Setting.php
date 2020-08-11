<?php

namespace App\Models\Admin;
use DB;
use App\Models\Vote;
use Carbon\Carbon;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {  

    public static function get_code_value_by_name($codeName){
        $codeValue   = DB::table('settings')->select('code_value')
                                  ->where('code_name', $codeName)
                                  ->where('status', 1)
                                  ->get()->toarray();
        
        if($codeValue){
            return $codeValue[0]->code_value;
        }
        return null;
    }

    public static function increase_up_vote($id, $userId, $table_name, $creator_id){
        $votes = new Vote();
        $votes->user_id = $userId;
        $votes->votable_type = $table_name;
        $votes->votable_id = $id;
        $votes->voted_at = Carbon::now();
        $votes->save();
        // $userTotalScore = User::select('total_score')->where('id', $creator_id)->get();
        // if($userTotalScore){
        //     return $userTotalScore[0]->total_score;
        // }
        $user = User::find($creator_id);	
        $user->total_score += 10;
        $user->update(); 
        $result['response'] = "success";						
        $result['message'] = "successfully voted";
        return response()->json($result);
    }

    public static function down_vote_count($id, $userId, $table_name , $creator_id){
        $votes = new Vote();
        $votes->user_id = $userId;
        $votes->votable_type = $table_name;
        $votes->votable_id = $id;
        $votes->is_upvote = 0;
        $votes->voted_at = Carbon::now();
        $votes->save();
        $user = User::find($creator_id);	
        $user->total_score -= 5;
        $user->update();   
        $result['response'] = "success";						
        $result['message'] = "successfully voted";
        return response()->json($result);
    }

}
