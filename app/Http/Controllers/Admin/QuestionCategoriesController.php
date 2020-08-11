<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\QuestionCategory;
use Illuminate\Http\Request;

class QuestionCategoriesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        // $questionCategories = QuestionCategory::orderBy('id', 'desc')->get();
        $questionCategories = QuestionCategory::all();
        return compact('questionCategories', 'status');
    }


    public function store(Request $request)
    {
        $questionCategory = new QuestionCategory;

        $questionCategory->title = request('title');
        $questionCategory->descr = request('descr');
        $questionCategory->status = request('status');

        $questionCategory->save();

    }

    public function update(Request $request, QuestionCategory $questionCategory)
    {
        $questionCategory->title = request('title');
        $questionCategory->descr = request('descr');
        $questionCategory->status = request('status');
        
        $questionCategory->save();

    }


    public function destroy(QuestionCategory $questionCategory)
    {
        $questionCategory->delete();
    }
}
