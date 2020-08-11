<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\JobType;
use Illuminate\Http\Request;

class JobTypesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        $jobTypes = JobType::orderBy('id', 'desc')->get();
        return compact('jobTypes', 'status');
    }


    public function store(Request $request)
    {
        $jobType = new JobType;

        $jobType->title = request('title');
        $jobType->descr = request('descr');
        $jobType->status = request('status');

        $jobType->save();

    }

    public function update(Request $request, JobType $jobType)
    {
        $jobType->title = request('title');
        $jobType->descr = request('descr');
        $jobType->status = request('status');
        
        $jobType->save();

    }


    public function destroy(JobType $jobType)
    {
        $jobType->delete();
    }
}
