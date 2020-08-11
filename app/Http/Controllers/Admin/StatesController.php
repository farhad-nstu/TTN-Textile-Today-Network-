<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin\State;
use App\Models\Admin\Country;
use App\Http\Controllers\Controller;


class StatesController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api');
    }


    public function view()
    {
        return view('states.index');
    }


    // 
    
    public function index()
    {
        $countries = Country::all();
        $states =  State::orderBy('id', 'desc')->with('country')->paginate(5);
        return compact('states', 'countries');

    
    }

    public function store(Request $request)
    {
        return State::create($request->all());
    }

    public function show(State $state)
    {
        return $state;
    }

    public function update(Request $request, State $state)
    {
        $state->update($request->all());
        return $state;
    }

    public function destroy(State $state)
    {
        $state->delete();
        return 204;
    }
}
