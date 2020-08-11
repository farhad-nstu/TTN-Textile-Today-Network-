<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Share;
use App\Models\Admin\PostType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Notifications\LikeNotification;

class PostsController extends Controller
{
    public function __construct() {
       // $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('post');
        $posts =  Post::orderBy('id', 'desc')->with('post_type')->paginate(10);
        $postTypes =  PostType::all();
        return compact('posts', 'status', 'postTypes');
    }

    public function submit_post(Request $request){
        $post = new Post;
        $post->user_id = $request->user_id;
        $post->post_type_id = "1";
        $post->descr = $request->descr;
        $post->status = "10";
        $post->save();
        return "saved";
    }

    public function like_post(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'likeable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $likeResponse =  Like::like_for_all($request->user_id, $request->likeable_id, 'App\Models\Post');
        if($likeResponse['response'] = 'success'){
            $post = Post::find($request->likeable_id);
            $post->total_like++;
            $to = User::find($post->user_id);
            // $to->notify(new likeNotification());
            if($post->update()){
                $result['response'] = 'success';
                $result['message'] = "Liked has been successfull!";
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Sorry, Failed to like! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, Failed to like! Please try again.';
        }
        return response()->json($result);
    }

    public function unlike_post(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'likeable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $likeResponse =  Like::unlike_for_all($request->user_id, $request->likeable_id, 'App\Models\Post');
        if($likeResponse['response'] = 'success'){
            $post = Post::find($request->likeable_id);
            $post->total_like--;
            if($post->update()){
                $result['response'] = 'success';
                $result['message'] = "Successfully disliked!";
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Sorry, Failed to dislike! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, Failed to dislike! Please try again.';
        }
        return response()->json($result);
    }
    public function like_comment(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'likeable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $likeResponse =  Like::like_for_all($request->user_id, $request->likeable_id, 'App\Models\Comment');
        if($likeResponse['response'] = 'success'){
            $comment = Comment::find($request->likeable_id);
            $comment->total_likes++;
            if($comment->update()){
                $result['response'] = 'success';
                $result['message'] = "Successfully liked the comment!";
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Sorry, Failed to like! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, Failed to like! Please try again.';
        }
        return response()->json($result);
    }

    public function unlike_comment(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'likeable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $likeResponse =  Like::unlike_for_all($request->user_id, $request->likeable_id, 'App\Models\Comment');
        if($likeResponse['response'] = 'success'){
            $comment = Comment::find($request->likeable_id);
            $comment->total_likes--;
            if($comment->update()){
                $result['response'] = 'success';
                $result['message'] = "Successfully disliked!";
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Sorry, Failed to dislike! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, Failed to dislike! Please try again.';
        }
        return response()->json($result);
    }

    public function comment(Request $request){
        $comment = new Comment;
        $comment->user_id = $request->id;
        $comment->commentable_id = $request->commentable_id;
        $comment->comment = $request->comment;
        $comment->commentable_type = "App\Models\\".$request->commentable_type;

        $comment->save();

        if($comment){
            $post = Post::find($request->commentable_id);
            $post->total_comment++;
            $post->save();
        }

        return $result['commentable_id'] = $comment->commentable_id;
    }

    public function get_comments($id){
        $postComments = Post::with(array('comments' => function($query){
            $query->with(array(
                    'user' => function($query){
                    $query->select('id','name', 'profile_picture');
                    },
                    'likes' => function($query){
                    $query->select('user_id', 'likeable_type', 'likeable_id');
                    }
            ))->orderBy('id', 'DESC');
        }))->where('id', $id)->get();
        return response()->json($postComments);
    }

    public function share_post(Request $request){
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'shareable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $description = $request->shareDetails."\n".url('/')."/article/".$request->shareable_id;
        $shareResponse =  Share::generic_method_for_share($request->user_id, $request->shareable_id, 'App\Models\Post',$description);
        if($shareResponse['response'] == 'error'){
            return response()->json($shareResponse);
        }else{
            $result['message'] ="Successfully Shared!";
        }
        return response()->json($result);
    }

    public function update_comment(Request $request){
        $comment = Comment::find($request->id);
        $comment->comment = $request->comment;
        $comment->save();
        return $result['message'] = 'Success';
    }

    public function delete_comment(Request $request){

        $comment = Comment::find($request->id);
        if(!empty($comment)){
            if($comment->delete()){
                $comment->likes()->delete();
                $post = Post::find($request->commentable_id);
                $post->total_comment--;
                $post->save();
                $result['message'] = "Comment Deleted!";
            }
        }else{
            $result['message'] = "Error";
        }
        return $result;

    }

    public function store(Request $request)
    {
        $post = new Post;
        $post->user_id = "2";
        $post->post_type_id = request('post_type_id');
        $post->title = request('title');
        $post->descr = request('descr');
        $post->status = request('status');

        $post->save();
        //dd($post);
    }

    public function get_types_and_status(){
        $status = $this->get_status_list('post');
        $postTypes =  PostType::all();
        return compact('status', 'postTypes');
    }

    public function show(post $post)
    {
        $statuses = $this->get_status_list('post');
        $postTypes = PostType::all();
        return response()->json(['post' => $post, 'statuses' => $statuses, 'postTypes' => $postTypes]);
    }

    public function singleArticle($id)
    {
        $post = Post::find($id);
        return $post;
    }

    public function update(Request $request, post $post)
    {
        $post->user_id = "2";
        $post->post_type_id = request('post_type_id');
        $post->title = request('title');
        $post->descr = request('descr');
        $post->status = request('status');
        $post->save();
    }

    public function destroy(post $post)
    {
        $post->delete();
        return 204;
    }
}
