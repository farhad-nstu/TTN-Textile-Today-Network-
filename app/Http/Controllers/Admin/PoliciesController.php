<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Policy;

class PoliciesController extends Controller
{
    public function view()
    {
        return view('policies.index');
    }

    
    public function index()
    {
        $statuses = $this->get_status_list('policy');
        $policies =  Policy::orderby('id', 'DESC')->paginate(5);
        return compact('policies', 'statuses');
    }

    public function store(Request $request)
    {
        // $this->validate($request, array(
        //     'title' => 'required|max:255',
        //     'unique_code'  => 'required|unique:policies',
        // ));
        $policy = new Policy;
        $policy->title = request('title');


        $subject = $request->descr;
        $pattern = '/<img.*?src=".*?"[^\>]+>/';
        preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);   
        // dd($matches);  

        foreach($matches as $match){
            $stringImage  = implode(" ",$match);
            // dd($match);
            // $exploded = explode(',', $stringImage);
            // preg_match('/data:image\/(png|jpeg|jpg);base64,/', $stringImage, $mat);
            // preg_match('/data:image\/(png|jpeg|jpg);base64,/', $stringImage, $mat);
            preg_match('^/9j/[0-9A-Za-z]{"}^', $stringImage, $mat);
            dd($mat);
            $a = implode(" ", $mat);
            // preg_replace('/data:image\/(png|jpeg|jpg);base64,/', $a, $stringImage);
            // dd($stringImage);
            
            if(Str::contains($match[0], 'jpeg')){
                $extension = 'jpeg';
            } else if(Str::contains($match[0], 'png')) {
                $extension = 'png';
            } else {
                $extension = 'jpg';
            }
            preg_match('/".*"/', $stringImage, $abc);
            dd($abc);
            $decoded = base64_decode($match[0]);
            $fileName = Str::random().'.'.$extension;
            $path = public_path().'/uploads/'.$fileName;       
            file_put_contents($path, $decoded);
            $finalImage = preg_replace($pattern, $path, $subject);
        }

        $policy->descr = $finalImage;



        $policy->unique_code = request('unique_code');
        $policy->user_id = request('user_id');
        $policy->applicable_from = request('applicable_from');
        $policy->status = request('status');
        $policy->save();
        $result['response'] = "success";						
        $result['message'] = "successfully added";
        return response()->json($result);
    }

    public function show(Policy $policy_index)
    {
        $statuses = $this->get_status_list('policy');
        return compact ('policy_index', 'statuses');
    }

    public function update(Request $request, Policy $policy_index)
    {
        $policy_index->title = request('title');
        $policy_index->descr = request('descr');
        $policy_index->applicable_from = request('applicable_from');
        $policy_index->status = request('status');
        $policy_index->update();
        $result['response'] = "success";						
        $result['message'] = "successfully added";
        return response()->json($result);
    }

    public function destroy(Policy $policy_index)
    {
        $policy_index->delete();
    }
}
