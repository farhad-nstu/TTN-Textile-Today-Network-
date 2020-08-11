<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Skill;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $skills = Skill::orderBy('id', 'desc')->paginate(10);
        return $skills;
    }


    public function store(Request $request)
    {
        $skill = new Skill;

        $skill->title = request('title');

        $skill->save();

    }

    public function update(Request $request, Skill $skill)
    {
        $skill->title = request('title');
        
        $skill->save();

    }


    public function destroy(Skill $skill)
    {
        $skill->delete();
    }
}
