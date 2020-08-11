<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tag;
use App\Models\Admin\TagCategory;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $tagCategories = TagCategory::all();
        $statuses = $this->get_status_list('common');
        $tags = Tag::orderBy('id', 'desc')->with('tagCategory')->paginate(10);
        return compact('tags', 'tagCategories', 'statuses');
    }


    public function store(Request $request)
    {
        $tag = new Tag;

        $tag->tag_category_id = request('tag_category_id');
        $tag->tag = request('tag');
        $tag->status = request('status');

        $tag->save();

    }

    public function update(Request $request, Tag $tag)
    {
        $tag->tag_category_id = request('tag_category_id');
        $tag->tag = request('tag');
        $tag->status = request('status');
        
        $tag->save();

    }


    public function destroy(Tag $tag)
    {
        $tag->delete();
    }
}
