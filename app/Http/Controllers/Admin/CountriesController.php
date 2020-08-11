<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
// use App\Http\Requests;
use App\Models\Admin\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\Country as CountryResource;

class CountriesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function view()
    {
        return view('countries.index');
    }

    public function index()
    {
        $countries = Country::paginate(5);
        return CountryResource::collection($countries);
    }
 
    public function store(Request $request)
    {
        $country = $request->isMethod('put') ? Country::findOrFail($request->id) : new Country;

        $country->id = $request->input('id');
        $country->name = $request->input('name');
        $country->country_code = $request->input('country_code');
        
        if($country->save()) {
            return new CountryResource($country);
        }
        
    }

    public function show($id)
    {
        $country = Country::findOrFail($id);
        return new CountryResource($country);
    }

    public function update($id){
        
        $country = Country::findOrFail($id);
        $country->id = $request->input('id');
        $country->name = $request->input('name');
        $country->country_code = $request->input('country_code');

         if($country->save()) {
            return new CountryResource($country);
        }
        
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        if($country->delete()) {
            return new CountryResource($country);
        }    
    }

    
}
