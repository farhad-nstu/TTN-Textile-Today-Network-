<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PostType;
use Illuminate\Http\Request;

class PostTypesController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    
    public function view()
    {
        return view('post-types.index');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        
        $postTypes =  PostType::orderBy('id', 'desc')->paginate(5);

        foreach ($postTypes as $key => $value) {            
            $postTypes[$key]->status = $status[$value->status];
        }
        
        return compact('postTypes', 'status');
        //dd($status);
    }

    public function store(Request $request)
    {
        return PostType::create($request->all());
    }

    public function show(PostType $postType)
    {
        return $postType;
    }

    public function update(Request $request, PostType $postType)
    {
        $postType->update($request->all());
        return $postType;
    }

    public function destroy(PostType $postType)
    {
        $postType->delete();
        return 204;
    }

}
