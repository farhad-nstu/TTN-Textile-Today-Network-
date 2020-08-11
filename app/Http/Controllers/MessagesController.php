<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MessagesController extends Controller
{
    public function get_users(){
        $users = User::all();
        return response()->json($users,200);
    }
}
