<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PageCategory;
use Illuminate\Http\Request;

class PageCategoriesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        $pageCategories = PageCategory::orderBy('id', 'desc')->get();
        return compact('pageCategories', 'status');
    }


    public function store(Request $request)
    {
        $pageCategory = new PageCategory;

        $pageCategory->title = request('title');
        $pageCategory->status = request('status');

        $pageCategory->save();

    }

    public function update(Request $request, PageCategory $pageCategory)
    {
        $pageCategory->title = request('title');
        $pageCategory->status = request('status');
        
        $pageCategory->save();

    }


    public function destroy(PageCategory $pageCategory)
    {
        $pageCategory->delete();
    }
}
