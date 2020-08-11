<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\Invitation;
use App\Models\Comment;
use App\Models\Share;
use App\Models\Like;
use App\Models\UserConnection;
use App\Models\Admin\EventType;
use App\Models\Admin\InterestGroup;
use App\Models\Image;
use Validator;
use DB;
use Auth;
class EventsController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth:api');
    // }
    public function get_event_comments($eventId,$userId){
        //  $eventComments = Comment::with('likes','user:id,name,profile_picture')
        $eventComments = Comment::with(['user:id,name,profile_picture','likes' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])
        ->where('commentable_id',$eventId)->where('commentable_type','App\Models\Event')
        ->orderBy('created_at','DESC')->get();
        return compact("eventComments");
    }
    public function get_event_details($eventId,$userId){
        // $eventDetails = Event::with('user:users.id,users.name,users.about_yourself,users.profile_picture,'.
        // 'is_mentor,is_creator','interestGroups:interest_groups.id,interest_groups.title','likes')
        // ->find($eventId);
        
        $eventDetails = Event::with('user:users.id,users.name,users.about_yourself,users.profile_picture,'.
            'is_mentor,is_creator','interestGroups:interest_groups.id,interest_groups.title')
            ->with(['likes' => function ($query) use ($eventId,$userId){
                    $query->where('likeable_id','=',$eventId)
                        ->where('likeable_type','=','App\Models\Event')
                        ->where('likes.user_id', $userId);
                }])
            ->find($eventId);
        if(count($eventDetails->likes) > 0){
            $eventDetails->like_user_id = 1;
        }else{
            $eventDetails->like_user_id = 0;
        }
        return compact("eventDetails");
    }
    public function get_edit_event($eventId, $userId){
        $event = User::find($userId)->events()->where('event_id',$eventId)->where('is_creator', '=', 1)->first();
        return compact("event");
    }
    public function delete_event_comment($commentId){
        $result['response'] = 'success';
        $comment = Comment::find($commentId);
        if(!$comment->delete()){
            $result['response'] = 'error';
            $result['message'] = 'Comment delete failed! Please try again';
        }
        return response()->json($result);
    }
    public function delete_event($id){
        $event = Event::find($id);
        $event->user()->detach();
        $event->delete();
        return response()->json(['response' => 'success', 'message' => 'Event deleted successfull'], 200);
    }
    public function get_interest_groups(){
        $interestGroups = InterestGroup::all();
        return $interestGroups;
    }
    public function get_mentor($mentor_email){
        $mentor = User::where('email',$mentor_email)->first();
        return compact("mentor");
    }
    public function get_connected_users($userId, $eventId){
        $connectedUsers = DB::table('user_connections')->where('user_id', '=', $userId)->where('is_accepted', '=', 1)->where('blocked', '=', 0)
            ->join('users', 'users.id', '=', 'user_connections.connection_id')
            ->select('users.id','users.name','users.profile_picture')
            ->get();
        $invitedUsers =  Invitation::where('invited_by', $userId)->where('invitationable_id', $eventId)->where('invitationable_type', 'App\Models\Event')->pluck('invited_to');
        return compact("connectedUsers", "invitedUsers");
    }
    public function event_invitation_accept_or_not(Request $request){
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'joinOrNot' => 'required',
            'invitationId' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $invitation = Invitation::find($request->invitationId);
        if($request->joinOrNot == 'not_interest'){
            $invitation->status = 30;
        }else if($request->joinOrNot == 'join'){
            $invitation->status = 20;
        }
        if(!$invitation->update()){
            $result['response'] = 'error';
            $result['message'] = 'Invitation status update failed!';
        }
        $result['status'] =  $invitation->status;
        $result['message'] = 'Invitation status updated successfully!';
        return response()->json($result);
    }
    public function send_event_invitation(Request $request){
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'invited_by' => 'required',
            'invited_to' => 'required',
            'invitationable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
         /////// $request->invited_to is an array ///////////////////
        $invitationResponse = Invitation::generic_method_for_invitation($request->invited_by, $request->invited_to, 'App\Models\Event', $request->invitationable_id);
        if($invitationResponse['response'] == 'error'){
            return response()->json($invitationResponse);
        }else{
            $result['message'] = 'Invitation has been successful!';
        }
        return response()->json($result);
    }
    public function update_event_comment(Request $request){
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'commentId' => 'required',
            'comment' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $comment = Comment::find($request->commentId);
        if(!empty($comment)){
            $comment->comment = $request->comment;
            if(!$comment->update()){
                $result['response'] = 'error';
                $result['message'] = 'Comment update failed! Please try again';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Comment update failed! Please try again';
        }
       return response()->json($result);
    }
    public function add_event_comment(Request $request){
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'commentable_id' => 'required',
            'comment' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $commentResponse = Comment::generic_method_for_comment($request->user_id, $request->commentable_id, 'App\Models\Event',$request->comment);
       if($commentResponse['response'] == 'success'){
           $event = Event::find($request->commentable_id);
           if(!empty($event)){
                $event->total_comments++;
                if(!$event->update()){
                    $result['response'] = 'error';
                    $result['message'] = 'Comment Failed!';
                }
           }else{
                Comment::where('user_id',$request->user_id)->where('commentable_id',$request->commentable_id)->where('commentable_type','App\Models\Event')->orderBy('id',"DESC")->first()->delete();
                $result['response'] = 'error';
                $result['message'] = 'Comment Failed!';
           }
       }else{
            $result['response'] = 'error';
            $result['message'] = 'Comment Failed!';
       }
       return response()->json($result);
    }
    public function share_event(Request $request){
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
        $description = $request->comment."http://ttnweb.test/event-details/".$request->shareable_id;
        $shareResponse =  Share::generic_method_for_share($request->user_id, $request->shareable_id, 'App\Models\Event',$description);
        if($shareResponse['response'] == 'error'){
            return response()->json($shareResponse);
        }else{
            $result['message'] ="Shared success!";
        }
        return response()->json($result);
    }
    public function unlike_event_comment(Request $request){
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
                $result['message'] = "unlike has been successfull!";
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Sorry, unlike failed! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, unlike failed! Please try again.';
        }
        return response()->json($result);
    }
    public function like_event_comment(Request $request){
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
            $comment= Comment::find($request->likeable_id);
            $comment->total_likes++;
            if($comment->update()){
                $result['response'] = 'success';
                $result['message'] = "Liked has been successfull!";
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Sorry, Liked failed! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, Liked failed! Please try again.';
        }
        return response()->json($result);
    }
    public function unlike_event(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'likeable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $likeResponse =  Like::unlike_for_all($request->user_id, $request->likeable_id, 'App\Models\Event');
        if($likeResponse['response'] = 'success'){
            $event = Event::find($request->likeable_id);
            $event->total_likes--;
            if($event->update()){
                $result['response'] = 'success';
                $result['message'] = "unlike has been successfull!";
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Sorry, unlike failed! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, unlike failed! Please try again.';
        }
        return response()->json($result);
    }
    public function like_event(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'likeable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $likeResponse =  Like::like_for_all($request->user_id, $request->likeable_id, 'App\Models\Event');
        if($likeResponse['response'] = 'success'){
            $event = Event::find($request->likeable_id);
            $event->total_likes++;
            if($event->update()){
                $result['response'] = 'success';
                $result['message'] = "Liked has been successfull!";
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Sorry, Liked failed! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, Liked failed! Please try again.';
        }
        return response()->json($result);
    }
    public function get_event_types(){
        $eventTypes = EventType::pluck('title', 'id');
        $eventTypes[0] = '-- Select Type --';
        return $eventTypes;
    }
    public function get_events($eventCategory,$eventTypeId, $userId, $eventTag){
        $conditions = [];
        $orderBy = 'start_date DESC';
        if($eventTypeId){
            $conditions[] = ['event_type_id', $eventTypeId];
        }

        if($eventCategory == 'up-coming'){
            $conditions[] = ['start_date', '>', now()];
            $orderBy = 'start_date ASC';
        }else if($eventCategory=='archived'){
            $conditions[] = ['end_date', '<', now()];
        }
        
        if($eventTag == "my_event"){
            $conditions[] = ['user_id', $userId];
        }
        else if($eventTag == "invitation_received"){
            $conditions[] = ['invited_to', $userId];
            $conditions[] = ['invitationable_type', 'App\Models\Event'];
        }

        if($eventTag == "invitation_received"){
            $events = $events = DB::table('events')->orderByRaw($orderBy)
                    ->join('invitations', function($join) use($conditions) {
                        $join->on('events.id', '=', 'invitations.invitationable_id')
                            ->where( $conditions)
                            ->join('users', function($join) {
                                $join->on('invitations.invited_by', '=', 'users.id');                                 
                            });
                    })
                    ->leftJoin('likes', function($join) use($userId){
                        $join->on('events.id','=','likes.likeable_id')
                            ->where('likeable_type','=','App\Models\Event')
                            ->where('likes.user_id', $userId);
                    })
                    ->select('events.*','likes.user_id as like_user_id','invitations.id as invitation_id','invitations.status','users.id as invited_by','users.name as invitor_name','users.profile_picture as invitor_profile_picture')
                    ->groupBy('events.id')
                    ->get();
        }else{
            $events = DB::table('events')->orderByRaw($orderBy)
                ->join('event_user', function($join) use($conditions) {
                    $join->on('events.id', '=', 'event_user.event_id')
                        ->where($conditions)
                        ->where('is_creator','=',1);
                })
                ->leftJoin('invitations', function($join) use ($userId) {
                    $join->on('events.id', '=', 'invitations.invitationable_id')
                        ->where( 'invitationable_type','App\Models\Event')
                        ->where( 'invited_to',$userId)
                        ->join('users', function($join) {
                            $join->on('invitations.invited_by', '=', 'users.id');                                 
                        });
                })
                ->leftJoin('likes', function($join) use($userId){
                    $join->on('events.id','=','likes.likeable_id')
                        ->where('likeable_type','=','App\Models\Event')
                        ->where('likes.user_id', $userId);
                })
                ->select('events.*','likes.user_id as like_user_id','event_user.user_id as creator_id','invitations.id as invitation_id','invitations.status','users.id as invited_by','users.name as invitor_name','users.profile_picture as invitor_profile_picture')
                ->groupBy('events.id')
                ->get();
        }




        // $events = Event::with(['likes' => function ($query) use ($userId){
        //     $query->select('likes.user_id as like_user_id')
        //         ->where('likeable_type','=','App\Models\Event')
        //         ->where('likes.user_id', $userId);
        // }])
        // ->with(['user' => function ($query) {
        //     $query->select('users.id as creator_id')->where('is_creator', '=', 1);
        // }])
        // ->where($conditions)->orderByRaw($orderBy)->get()->toArray();

                //dd($events->toArray());
        //         $object = (object) $events;
        //         dd($object);
        // $likes = new stdClass();
        // foreach ($events as $key => $value)
        // {
        //     $likes->$key = $value;
        // }
        // dd($events->toArray());

        foreach($events as $k => $q) {
            $events[$k]->details = substr($events[$k]->details, 0, 150);
            // if(isset($events[$k]['user']) && !empty($events[$k]['user'])){
            //     $events[$k]['user_id'] = $events[$k]['user'][0]['id'];
            //     unset($events[$k]['user']);
            // }
         }
        return compact('events');
    }
    public function create_event(Request $request,$id) {
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'event_type_id' => 'required',
            'details' => 'required',
            'venue' => 'required',
            'start_date' => 'required',
            'contact_email' => 'required|email',
            'contact_phone_no' => 'required|regex:/(01)[0-9]{9}/',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $event = new Event();
        $logoName = '';
        if(!empty($request->logo)){
            $fileUploadResponse = Image::upload_file($request->logo, $id, $request->title, 'Events', true);
            if($fileUploadResponse['response']=='success'){
                $logoName = $fileUploadResponse['file_name'];
            } else{
                $result['response'] = 'error';
                $result['message'] = $fileUploadResponse['message'];
                return response()->json($result);
            }
        }
        $bannerName = '';
        if(!empty($request->banner)){
            $fileUploadResponse = Image::upload_file($request->banner, $id, $request->title, 'Events', true);
            if($fileUploadResponse['response']=='success'){
                $bannerName = $fileUploadResponse['file_name'];
            }else{
                $result['response'] = 'error';
                $result['message'] = $fileUploadResponse['message'];
                return response()->json($result);
            }
        }
        $event->event_type_id = $request->event_type_id;
        $event->title = $request->title;
        $event->contact_phone_no = $request->contact_phone_no;
        $event->logo = $logoName;
        $event->banner = $bannerName;
        $event->contact_email = $request->contact_email;
        $event->start_date = $request->start_date;
        if(!empty($request->end_date)){
            $event->end_date = $request->end_date;
        }else{
            $event->end_date = $request->start_date;
        }
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->venue = $request->venue;
        $event->details = $request->details;
        $event->total_flag = 0;
        $event->is_featured = 0;
        $event->status = 1;
        $event->total_views = 1;
        if($event->save()){
            if(!empty($request->mentorList)){
                $mentorListResponse = Event::add_mentor_list($request->mentorList, $id, $event);
            }else{
                $event->user()->attach($id, ['is_mentor' => 0,'is_creator'=> 1 ]);
            }
            if(!empty($request->interest_group_id)){
                $interestGroupResponse = Event::add_interest_group($request->interest_group_id, $event);
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, new event creation failed! Please try again.';
        }
        return response()->json($result);
    }
    public function update_event(Request $request,$id) {
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required',
            'event_type_id' => 'required',
            'details' => 'required',
            'venue' => 'required',
            'start_date' => 'required',
            'contact_email' => 'required|email',
            'contact_phone_no' => 'required|regex:/(01)[0-9]{9}/',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $event = Event::find($request->id);
        $logoName = '';
        if(!empty($request->logo)){
            $fileUploadResponse = Image::upload_file($request->logo, $id, $request->title, 'Events', true);
            if($fileUploadResponse['response']=='success'){
                $logoName = $fileUploadResponse['file_name'];
            } else{
                $result['response'] = 'error';
                $result['message'] = $fileUploadResponse['message'];
                return response()->json($result);
            }
        }
         $bannerName = '';
        if(!empty($request->banner)){
            $fileUploadResponse = Image::upload_file($request->banner, $id, $request->title, 'Events', true);
            if($fileUploadResponse['response']=='success'){
                $bannerName = $fileUploadResponse['file_name'];
            }else{
                $result['response'] = 'error';
                $result['message'] = $fileUploadResponse['message'];
                return response()->json($result);
            }
        }
        $event->event_type_id = $request->event_type_id;
        $event->title = $request->title;
        $event->contact_phone_no = $request->contact_phone_no;
        $event->logo = $logoName;
        $event->banner = $bannerName;
        $event->contact_email = $request->contact_email;
        $event->start_date = $request->start_date;
        if(!empty($request->end_date)){
            $event->end_date = $request->end_date;
        }else{
            $event->end_date = $request->start_date;
        }
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->venue = $request->venue;
        $event->details = $request->details;
        if($event->update()){
            if(!empty($request->mentorList)){
                $mentorListResponse = Event::add_mentor_list($request->mentorList, $id, $event);
            }else{
                $event->user()->attach($id, ['is_mentor' => 0,'is_creator'=> 1 ]);
            }
            if(!empty($request->interest_group_id)){
                $interestGroupResponse = Event::add_interest_group($request->interest_group_id, $event);
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry,event update failed! Please try again.';
        }
        return response()->json($result);
    }
}
