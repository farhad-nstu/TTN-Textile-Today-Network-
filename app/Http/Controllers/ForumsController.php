<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;

class ForumsController extends Controller
{
    public function store(Request $request)
    {
        
        $question = Forum::create($request->all());
        //return $question;
    }

    public function update(Request $request, Forum $forum)
    {
        $forum->update($request->all());
        return $forum;
    }
}
