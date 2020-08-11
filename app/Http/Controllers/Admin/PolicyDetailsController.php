<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Policy;
use App\Models\Admin\PolicyDetail;

class PolicyDetailsController extends Controller
{
    public function view(){
        return view('policyDetails.index');
    }
    
    public function index($id){
        $statuses = $this->get_status_list('policy');
        $policy = Policy::with('policy_details')->find($id);
        // $policyDetails =  PolicyDetail::where('policy_id', $id)->orderby('id', 'DESC');
        return compact('policy', 'statuses');
    }

    public function store(Request $request, $id){
        $policyDetail = new PolicyDetail();
        $policyDetail->policy_id = $id;
        $policyDetail->section_name = request('section_name');
        $policyDetail->details = request('details');
        $policyDetail->mentionable_link = request('mentionable_link');
        $policyDetail->status = request('status');
        $policyDetail->save();
        $result['response'] = "success";						
        $result['message'] = "successfully added";
        return response()->json($result);
    }

    public function show($id){
        $statuses = $this->get_status_list('policy');
        $policyDetail = PolicyDetail::find($id);
        return compact('policyDetail', 'statuses');
    }

    public function update(Request $request, $id){
        $policyDetail = PolicyDetail::find($id);
        $policyDetail->section_name = request('section_name');
        $policyDetail->details = request('details');
        $policyDetail->mentionable_link = request('mentionable_link');
        $policyDetail->status = request('status');
        $policyDetail->update();
        $result['response'] = "success";						
        $result['message'] = "successfully added";
        return response()->json($result);
        // return $policyDetail;
    }

    public function destroy($id){
        $policyDetail = PolicyDetail::find($id);
        $policyDetail->delete();
        return 204;
    }
}
