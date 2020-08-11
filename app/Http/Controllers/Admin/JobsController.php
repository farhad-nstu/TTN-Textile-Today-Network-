<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\Admin\JobType;
// use App\Models\Admin\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobsController extends Controller
{
    public function __construct() {
       $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('job');
        $jobs =  Job::orderBy('id', 'desc')->with('JobType')->paginate(1);
        $jobTypes =  JobType::all();
       // $organizations =  Organization::all();       
        
        return compact('jobs', 'jobTypes', 'status');

    }

    public function store(Request $request)
    {
        $job = new Job;

        $job->job_type_id = request('job_type_id');
        $job->title = request('title');
        $job->job_location = request('job_location');
        $job->total_vacancy = request('total_vacancy');
        $job->application_deadline = request('application_deadline');
        $job->salary_range = request('salary_range');
        $job->minimum_experience = request('minimum_experience');
        $job->maximum_experience = request('maximum_experience');
        $job->minimum_age = request('minimum_age');
        $job->maximum_age = request('maximum_age');
        $job->preferred_gender = request('preferred_gender');
        $job->responsibilities = request('responsibilities');
        $job->requirements = request('requirements');
        $job->other_benefits = request('other_benefits');
        $job->special_instruction = request('special_instruction');
        $job->status = request('status');

        $job->save();
    }

    public function show(Job $job)
    {
        return $job;
    }

    public function update(Request $request, Job $job)
    {
        $job->job_type_id = request('job_type_id');
        $job->title = request('title');
        $job->job_location = request('job_location');
        $job->total_vacancy = request('total_vacancy');
        $job->application_deadline = request('application_deadline');
        $job->salary_range = request('salary_range');
        $job->minimum_experience = request('minimum_experience');
        $job->maximum_experience = request('maximum_experience');
        $job->minimum_age = request('minimum_age');
        $job->maximum_age = request('maximum_age');
        $job->preferred_gender = request('preferred_gender');
        $job->responsibilities = request('responsibilities');
        $job->requirements = request('requirements');
        $job->other_benefits = request('other_benefits');
        $job->special_instruction = request('special_instruction');
        $job->status = request('status');

        $job->save();
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return 204;
    }
}
