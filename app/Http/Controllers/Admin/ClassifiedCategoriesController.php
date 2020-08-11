<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ClassifiedCategory;
use Illuminate\Http\Request;

class ClassifiedCategoriesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        $classifiedCategories = ClassifiedCategory::orderBy('id', 'desc')->get();
        return compact('classifiedCategories', 'status');
    }


    public function store(Request $request)
    {
       $classifiedCategory = new ClassifiedCategory;

               $classifiedCategory->title = request('title');
               $classifiedCategory->descr = request('descr');
               $classifiedCategory->parent_id = request('parent_id');
               $classifiedCategory->status = request('status');

               $classifiedCategory->save();

    }

    public function update(Request $request, ClassifiedCategory $classifiedCategory)
    {
        $classifiedCategory->title = request('title');
        $classifiedCategory->descr = request('descr');
        $classifiedCategory->parent_id = request('parent_id');
        $classifiedCategory->status = request('status');
        
        $classifiedCategory->save();

    }


    public function destroy(ClassifiedCategory $classifiedCategory)
    {
        $classifiedCategory->delete();
    }
}
