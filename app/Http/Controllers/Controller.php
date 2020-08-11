<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Job;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\User;
use App\Models\UserConnection;
use App\Models\Question;
use Carbon\Carbon;
use App\Models\Visitor;

use Illuminate\Support\Facades\Config;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    var $loggedinUser = [];

    public function get_status_list($statusFor = null){
        $statusList = [];
        if(!empty($statusFor)){
            $statusList = Config::get('statuses.'.$statusFor);
        }else{
            $statusList = Config::get('statuses');
        }
        return $statusList;
    }

    //be careful this method can return '0' which is valid but null/false is invalid
    public function get_status_id_by_title($statusFor = null, $title = null){
        $id = null;
        if($statusFor && $title){
            $statusList = Config::get('statuses.'.$statusFor);

            $title = ucfirst($title);
            if(!empty($statusList)){
                $id = array_search($title, $statusList);
            }
        }
        return $id;
    }

    public function get_navigation_menus(){
        return [
            ['name' => 'Home', 'url' => '/home', 'icon_path' => ''],
            ['name' => 'Job', 'url' => '/jobs', 'icon_path' => ''],
            ['name' => 'Classified', 'url' => '/classifieds', 'icon_path' => ''],
            ['name' => 'Group', 'url' => '/groups', 'icon_path' => ''],
            ['name' => 'Page', 'url' => '/pages', 'icon_path' => ''],
            ['name' => 'Event', 'url' => '/events', 'icon_path' => ''],
            ['name' => 'Message', 'url' => '/messages', 'icon_path' => ''],
            ['name' => 'Notification', 'url' => '/notifications', 'icon_path' => ''],
            ['name' => 'Forum', 'url' => '/forum', 'icon_path' => '']
            ];
    }

    public function search(Request $request){

        $stripSpecialCharacters = array("%20");
        $specialCharactersStripped = str_replace($stripSpecialCharacters, " ", $request->keyword);
        $keywordArray = preg_split ("/\ /", $specialCharactersStripped);

        $result['response'] = 'success';

        $data = [];

        switch ($request->table_name) {
            case "users":
                    foreach($keywordArray as $keyword => $value){
                        $tmpData = User::select('id','name', 'profile_picture', 'total_score')->where([
                            ['name', 'LIKE', '%' . $value . '%']
                            ])->where('status', '10')->limit(10)->get();
                        // Checking max result count and passing to array
                        if(count($tmpData) > count($data)){
                            $data = $tmpData;
                        }
                    }
                    $result[$request->table_name] = $data;
                    if(empty($data)){
                        $result['response'] = 'error';
                        $result['message'] = 'No user found!';
                        return compact('result');
                    }else{
                        $myConnections = UserConnection::where('user_id', $request->fromUserId)->get();
                        return compact('myConnections', 'result');
                    }
                break;

            case "events":
                    foreach($keywordArray as $keyword => $value){
                        $tmpData = Event::select('id','title', 'venue', 'start_date')->where([
                            ['title', 'LIKE', '%' . $value . '%']
                            ])->where('status', '0')->get();
                            // Checking max result count and passing to array
                        if(count($tmpData) > count($data)){
                            $data = $tmpData;
                        }
                        }
                    $result[$request->table_name] = $data;
                    if(empty($data)){
                        $result['response'] = 'error';
                        $result['message'] = 'No data found!';
                        return compact('result');
                    }else{
                        return compact('result');
                    }
                break;

            case "posts":
                    foreach($keywordArray as $keyword => $value){
                        $tmpData = Post::select('id','title', 'created_at')->where([
                            ['title', 'LIKE', '%' . $value . '%']
                            ])->where('status', '10')->get();
                            // Checking max result count and passing to array
                        if(count($tmpData) > count($data)){
                            $data = $tmpData;
                        }
                    }
                    $result[$request->table_name] = $data;
                    if(empty($data)){
                        $result['response'] = 'error';
                        $result['message'] = 'No data found!';
                        return compact('result');
                    }else{
                        return compact('result');
                    }
                break;
        }



    }

    public function increase_view_count($source_ip, $id, $table_name, $data) {
        switch ($table_name) {
            case "questions":
                    if(Visitor::should_increase_view_count($source_ip, $table_name, $id)){
                        $data->total_view += 1;
                        $data->update();
                        Visitor::store_view_history($source_ip, $table_name, $id);
                    }
                break;

            case "jobs":
                    if(Visitor::should_increase_view_count($client_ip, $table_name, $id)){
                        $data->total_views += 1;
                        $data->update();
                        Visitor::store_view_history($client_ip, $table_name, $id);
                    }
                break;

            case "events":
                    if(Visitor::should_increase_view_count($client_ip, $table_name, $id)){
                        $data->total_views += 1;
                        $data->update();
                        Visitor::store_view_history($client_ip, $table_name, $id);
                    }
                break;

            case "posts":
                    if(Visitor::should_increase_view_count($client_ip, $table_name, $id)){
                        $data->total_views += 1;
                        $data->update();
                        Visitor::store_view_history($client_ip, $table_name, $id);
                    }
                break;
        }
    }
}
