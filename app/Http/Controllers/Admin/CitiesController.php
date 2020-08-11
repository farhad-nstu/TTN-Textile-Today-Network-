<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Admin\Country;
use App\Models\Admin\State;
use App\Models\Admin\City;


class CitiesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }
    public function view()
    {
        return view('cities.index');
    }

    
    public function index()
    {
        $countries = Country::all();
        $states = State::all();
        $cities =  City::with('country')->with('state')->paginate(5);
        return compact('states', 'countries', 'cities');
    }

    public function store(Request $request)
    {
        
        $city = City::create($request->all());
    }

    public function show(City $city)
    {
        return $city;
    }

    public function update(Request $request, City $city)
    {
        $city->update($request->all());
        return $city;
    }

    public function destroy(City $city)
    {
        $city->delete();
        return 204;
    }
}
