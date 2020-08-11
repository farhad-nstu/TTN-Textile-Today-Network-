<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\UserType;
use Illuminate\Http\Request;

class UserTypesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $userTypes = UserType::orderBy('id', 'desc')->get();
        return $userTypes;
    }


    public function store(Request $request)
    {
        $userType = new UserType;

        $userType->title = request('title');
        $userType->descr = request('descr');

        $userType->save();

    }

    public function update(Request $request, UserType $userType)
    {
        $userType->title = request('title');
        $userType->descr = request('descr');
        
        $userType->save();

    }


    public function destroy(UserType $userType)
    {
        $userType->delete();
    }
}
