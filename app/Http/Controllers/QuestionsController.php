<?php
namespace App\Http\Controllers;
use App\Models\Admin\QuestionCategory;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;


class QuestionsController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth:api');
    // }
     protected $maxAttempts = 3;
     protected $decayMinutes = 2;

	public function view() {
        return view('questions.index');
    }

    public function index() {
    	$statuses = $this->get_status_list('answer');
        $questionCategories = QuestionCategory::pluck('title', 'id');
        // $questions =  Question::with('question_category')->with('user')->orderBy('id', 'DESC')->paginate(10);
        // foreach($questions as $k => $q){
        //     $questions[$k]->details = substr($questions[$k]->details, 0, 200);
        //     $questions[$k]->details = strip_tags($questions[$k]->details);
        //     $question_details = $questions[$k]->details;
        // }
        return compact('questionCategories', 'statuses');
    }

    public function store(Request $request) {
        // dd($request->details);
        $question = new Question;
        $question->title = request('title');
        $question->details = request('details');
        $question->question_category_id = request('question_category_id');
        $question->created_by = request('created_by');
        $question->status = request('status');
        $question->save();
        $user = User::find($request->created_by);
        $user->total_questions += 1;
        $user->update();
        $result['response'] = "success";						
        $result['message'] = "successfully added";
        return response()->json($result);
    }

    public function show(Question $question) {
        $statuses = $this->get_status_list('answer');
        $questionCategories = QuestionCategory::pluck('title', 'id');
        return compact('questionCategories', 'statuses');
    }

    public function update(Request $request, Question $question) {
        $question->title = request('title');
        $question->details = request('details');
        $question->question_category_id = request('category');
        $question->status = request('status');
        $question->update();
        $result['response'] = "success";						
        $result['message'] = "successfully updated";
        return response()->json($result);
    }

    public function destroy(Question $question){
        $question->delete();
    }

    public function up_vote(Request $request, $id) {
        $question = Question::find($id);
        if($request->up_vote == true){
            $question->up_vote =  $question->up_vote+1;
        }else if($request->up_vote == false){
            $question->up_vote =  $question->up_vote-1;
        }
        $question->update();
    }

    public function down_vote(Request $request, $id) {
        $question = Question::find($id);
        $question->down_vote = $request->down_vote;
        $question->update();
    }

    public function get_question_details(Request $request, $questionId) {
        // $question = DB::table('questions')
        //         ->join('answers', function($join) use($questionId) {
        //             $join->on('questions.id', '=', 'answers.question_id')->where('question_id', $questionId);
        //         })
        //         ->select('answers.*','questions.title')
        //         ->where('user_id',$userId)
        //         ->orderBy('answers.up_vote','DESC')
        //         ->orderBy('answers.down_vote','ASC')
        //         ->paginate($limit);


        $statuses = $this->get_status_list('answer');
        $questionDetails = Question::with('question_category')->with('user')->find($questionId);
        $answers = Answer::where('question_id', $questionId)->with('user')->orderby('id', 'DESC')->get();
        $source_ip = $request->ip();
        $views = $this->increase_view_count($source_ip, $questionId, 'questions', $questionDetails);
        return compact('questionDetails', 'answers', 'statuses');
    }

    public function get_popular_question(){
        $popularQuestions =  Question::with('user')->orderBy('up_vote', 'DESC')->orderby('down_vote', 'ASC')->limit(10)->get();
        foreach($popularQuestions as $k => $q){
            $popularQuestions[$k]->title = substr($popularQuestions[$k]->title, 0, 30);
        }
        return compact('popularQuestions');
    }

    public function get_question_categories(){
        $questionCategories = QuestionCategory::pluck('title', 'id');
        $questionCategories[0] = '-- Select Type --';
        return $questionCategories;
    }

    public function get_questions($userId,$categoryId,$limit,$page){
        // var_dump($page); exit();       
        if($userId == 0){
            switch($categoryId){
                case 0:
                    $questions =  Question::with('question_category')
                            ->with('user')
                            ->orderBy('id', 'DESC')
                            ->orderBy('up_vote', 'DESC')
                            ->paginate($limit);
                break;
                default:
                    $questions =  Question::with('question_category')
                        ->with('user')
                        ->where('question_category_id', $categoryId)
                        ->orderBy('id', 'DESC')
                        ->orderBy('up_vote', 'DESC')
                        ->orderBy('down_vote', 'ASC')
                        ->paginate($limit);
            }  
        } else{
            switch($categoryId){
                case 0:
                    $questions =  Question::with('question_category')
                    ->where('created_by', $userId)
                    ->orderBy('up_vote', 'DESC')
                    ->orderby('down_vote', 'ASC')
                    ->paginate($limit);
                break;
                default: 
                $questions =  Question::with('question_category')
                    ->where('created_by', $userId)
                    ->where('question_category_id', $categoryId)
                    ->orderBy('up_vote', 'DESC')
                    ->orderby('down_vote', 'ASC')
                    ->paginate($limit);
            }
        } 
        foreach($questions as $k => $q){
            $questions[$k]->details = substr($questions[$k]->details, 0, 200);
            $questions[$k]->details = strip_tags($questions[$k]->details);
        }
        // return compact("questions");
        return response()->json(['questions' => $questions]);
    }  

}
