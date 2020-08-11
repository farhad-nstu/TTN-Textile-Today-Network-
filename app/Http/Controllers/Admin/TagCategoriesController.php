<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TagCategory;
use Illuminate\Http\Request;

class TagCategoriesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $tagCategories = TagCategory::orderBy('id', 'desc')->paginate(10);
        return $tagCategories;
    }


    public function store(Request $request)
    {
        $tagCategory = new TagCategory;

        $tagCategory->title = request('title');
        $tagCategory->save();

    }

    public function update(Request $request, TagCategory $tagCategory)
    {
        $tagCategory->title = request('title');
        $tagCategory->save();

    }


    public function destroy(TagCategory $tagCategory)
    {
        $tagCategory->delete();
    }
}
