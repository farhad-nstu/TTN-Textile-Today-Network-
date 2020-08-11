<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TrainingCategory;
use Illuminate\Http\Request;

class TrainingCategoriesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $statuses = $this->get_status_list('common');
        $trainingCategories = TrainingCategory::orderBy('id', 'desc')->paginate(10);
        
        return compact('trainingCategories', 'statuses');

    }


    public function store(Request $request)
    {
        $trainingCategory = new TrainingCategory;

        $trainingCategory->title = request('title');
        $trainingCategory->descr = request('descr');
        $trainingCategory->status = request('status');

        $trainingCategory->save();

    }

    public function update(Request $request, TrainingCategory $trainingCategory)
    {
        $trainingCategory->title = request('title');
        $trainingCategory->descr = request('descr');
        $trainingCategory->status = request('status');

        $trainingCategory->save();

    }


    public function destroy(TrainingCategory $trainingCategory)
    {
        $trainingCategory->delete();
    }
}
