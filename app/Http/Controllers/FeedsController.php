<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\Event;

class FeedsController extends Controller
{
   public function __construct(){
     // $this->middleware('auth:api');
   }

   public function get_feeds(Request $request){
      $userId = $request->id;
      $limit = $request->limit;
      $page = $request->page;
      $articles = Post::get_posts($userId, $limit, $page);
      $events = Event::get_events($userId, $limit, $page);
      return response()->json(['articles' => $articles, 'events' => $events]);
   }
}
