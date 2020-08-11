<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\InterestGroup;
use Illuminate\Http\Request;

class InterestGroupsController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        $interestGroups = InterestGroup::orderBy('id', 'desc')->get();
        return compact('interestGroups', 'status');
    }


    public function store(Request $request)
    {
        $interestGroup = new InterestGroup;

        $interestGroup->title = request('title');
        $interestGroup->group_code = request('group_code');
        $interestGroup->descr = request('descr');
        $interestGroup->status = request('status');

        $interestGroup->save();

    }

    public function update(Request $request, InterestGroup $interestGroup)
    {
        $interestGroup->title = request('title');
        $interestGroup->group_code = request('group_code');
        $interestGroup->descr = request('descr');
        $interestGroup->status = request('status');
        
        $interestGroup->save();

    }


    public function destroy(InterestGroup $interestGroup)
    {
        $interestGroup->delete();
    }
}
