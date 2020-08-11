<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Vote;
use Carbon\Carbon;
use App\Models\Admin\Setting;
use App\Models\User;

class VotesController extends Controller
{
	public function is_eligible_for_up_vote($id, $userId, $table_name){
		$result['response'] = "success";
		$vote = Vote::where([
							'user_id'=>$userId,'votable_type'=>$table_name,
							'votable_id'=>$id, 'is_upvote' => 1
							])->first();

		if($vote) {
			$result['response'] = "error";
			$result['message'] = "You have already given vote!";
			return response()->json($result);
		}	else {
			switch ($table_name) {
				case "questions":
					$question = Question::where('id', $id)->first();
					$creator_id = $question->created_by;			
					if($creator_id == $userId){	
						$result['response'] = "error";						
						$result['message'] = "You can not vote yourself!";
						return response()->json($result);
					} else {
							$question->up_vote += 1;
							$question->update();
							Setting::increase_up_vote($id, $userId, $table_name, $creator_id);
							$result['response'] = "success";						
							$result['message'] = "Your have voted successfully";
							return response()->json($result);							
					}			
				break;

				case "answers":
					$answer = Answer::where('id', $id)->first();
					$creator_id = $answer->user_id;
					if($creator_id == $userId){	
						$result['response'] = "error";						
						$result['message'] = "You can not vote yourself!";
						return response()->json($result);
					} else {
							$answer->up_vote += 1;
							$answer->update();
							Setting::increase_up_vote($id, $userId, $table_name, $creator_id);
							$result['response'] = "success";						
							$result['message'] = "Your have voted successfully";
							return response()->json($result);
					}			
				break;
			}
		}							
	}

	public function is_eligible_for_down_vote($id, $userId, $table_name){
		$result['response'] = "success";
		$vote = Vote::where([
							'user_id'=>$userId,'votable_type'=>$table_name,
							'votable_id'=>$id, 'is_upvote'=> 0
							])->first();
							// dd($vote);
		$downVoteRequiredScore = Setting::get_code_value_by_name('downvote_required_score');
		$userTotalScore = User::where('id', $userId)->first();
		
		if($vote){
			$result['response'] = "error";
			$result['message'] = "You have already given vote!";
			return response()->json($result);
		} 
		else if($userTotalScore->total_score < $downVoteRequiredScore) {
			$result['response'] = "error";
			$result['message'] = "You have not enough score to vote!";
			return response()->json($result);
		}	
		else {
			switch ($table_name) {	
				case "questions":
					$question = Question::where('id', $id)->first();
					$creator_id = $question->created_by;
					if($creator_id == $userId){	
						$result['response'] = "error";						
						$result['message'] = "You can not vote yourself!";
						return response()->json($result);
					} else {
							$question->down_vote += 1;
							$question->update();
							Setting::down_vote_count($id, $userId, $table_name, $creator_id);
							$result['response'] = "success";						
							$result['message'] = "Your have voted successfully";
							return response()->json($result);
					}			
				break;
				case "answers":
					$answer = Answer::where('id', $id)->first();
					$creator_id = $answer->user_id;
					if($creator_id == $userId){	
						$result['response'] = "error";						
						$result['message'] = "You can not vote yourself!";
						return response()->json($result);
					} else {
							$answer->down_vote += 1;
							$answer->update();
							Setting::down_vote_count($id, $userId, $table_name, $creator_id);
							$result['response'] = "success";						
							$result['message'] = "Your have voted successfully";
							return response()->json($result);
					}			
				break;
			}
		}
	}

}
