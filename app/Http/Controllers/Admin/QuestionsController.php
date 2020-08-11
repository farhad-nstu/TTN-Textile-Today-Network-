<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Admin\QuestionCategory;
use App\Models\User;
use App\Models\Answer;

class QuestionsController extends Controller
{
    public function index(){
        $statuses = $this->get_status_list('answer');
        $questions = Question::with('question_category')->with('user')->orderBy('id', 'DESC')->paginate(5);
        return compact('questions', 'statuses');
    }

    public function store(Request $request) {
        $question = new Question;
        $question->title = request('title');
        $question->details = request('details');
        $question->question_category_id = request('question_category_id');
        $question->created_by = request('created_by');
        $question->status = request('status');
        $question->save();
        $result['response'] = "success";						
        $result['message'] = "successfully added";
        return response()->json($result);
    }

    public function destroy(Question $question_index){
        $question_index->delete();
    }

    public function show(Question $question_index){
        $statuses = $this->get_status_list('answer');
        $questionCategories = QuestionCategory::pluck('title', 'id');
        return compact ('question_index', 'questionCategories', 'statuses');
    }

    public function update(Request $request, Question $question_index){
        $question_index->title = request('title');
        $question_index->details = request('details');
        $question_index->question_category_id = request('category');
        $question_index->status = request('status');
        $question_index->update();
        $result['response'] = "success";						
        $result['message'] = "successfully updated";
        return response()->json($result);
    }

    public function get_single_question($id){
        $statuses = $this->get_status_list('answer');
        $question = Question::with('question_category')->with('user')->find($id);
        return compact('question', 'statuses');
    }
    //Answer
    // public function get_question_with_answers($id){
    //     $question = Question::with('answers')->with('user')->find($id);
    //     return compact('question');
    // } 
    public function get_question_with_answers($id){
        $question = Question::find($id);
        $answers = Answer::with('user')->where('question_id', $id)->orderby('id', 'DESC')->get();
        return compact('question', 'answers');
    } 

    public function get_answer_details($id){
        $statuses = $this->get_status_list('answer');
        $answer = Answer::with('question')->with('user')->find($id);
        return compact('answer', 'statuses');
    } 

    public function get_answer($id){
        $statuses = $this->get_status_list('answer');
        $answer = Answer::find($id);
        return compact('answer', 'statuses');
    }

    public function update_answer($id){
        $answer = Answer::find($id);
        $answer->answer = request('answer');
        $answer->status = request('status');
        $answer->update();
    }

    public function delete_answer($id){
        $answer = Answer::find($id);
        $answer->delete();
    }
}
