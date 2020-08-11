<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Policy;
use App\Models\Admin\PolicyDetail;

class PoliciesController extends Controller
{

    public function get_policy_list(){
        $policies = Policy::all();
        return compact('policies');
    } 
    
    public function get_policy($id){        
        $policy = Policy::with('policy_details')->orderby('id', 'DESC')->find($id);       
        return compact('policy');
    }
}
