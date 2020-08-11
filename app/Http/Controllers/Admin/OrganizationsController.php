<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Organization;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        $organizations = Organization::orderBy('id', 'desc')->paginate(10);
        return compact('organizations', 'status');
    }


    public function store(Request $request)
    {
        $organization = new Organization;
        $organization->name = request('name');
        $organization->short_details = request('short_details');
        $organization->website = request('website');
        $organization->phone = request('phone');
        $organization->fax = request('fax');
        $organization->email = request('email');
        $organization->address = request('address');
      //file upload
        if(!empty($request->company_logo)){
        $strpos = strpos($request->company_logo,';');
        $sub = substr($request->company_logo,0,$strpos);
        $ex = explode('/',$sub)[1];
        $name = time().".".$ex;
        $img = \Image::make($request->company_logo);
        $upload_path = public_path()."/images/company_logo/";
        $img->save($upload_path.$name);
       }else{
           $name = 'noimage.jpg';
       }

        $organization->company_logo = $name;

        $organization->status = request('status');
        $organization->save();
        $organization->users()->attach(request('user_id'),['is_creator' => request('user_id')]);

    }

    public function show(Organization $organization)
    {
        $status = $this->get_status_list('common');
        return compact('organization', 'status');
    }

    public function update(Request $request, Organization $organization)
    {
        $organization->name = request('name');
        $organization->short_details = request('short_details');
        $organization->website = request('website');
        $organization->phone = request('phone');
        $organization->fax = request('fax');
        $organization->email = request('email');
        $organization->address = request('address');

      //image update
      if(!empty($request->company_logo)){
        $strpos = strpos($request->company_logo,';');
        $sub = substr($request->company_logo,0,$strpos);
        $ex = explode('/',$sub)[1];
        $name = time().".".$ex;
        $img = \Image::make($request->company_logo);
        $upload_path = public_path()."/images/company_logo/";
        $image = $upload_path. $organization->company_logo;
        $img->save($upload_path.$name);

        if(file_exists($image)){
            @unlink($image);
        }

        }else{

            $name = $organization->company_logo;
    }

        $organization->company_logo = $name;
        $organization->status = request('status');
        $organization->update();
        $organization->users()->detach();
        $organization->users()->attach(request('user_id'),['is_creator' => request('user_id')]);

    }


    public function destroy(Organization $organization)
    {
        $image_path = public_path()."/images/company_logo/";
        $image = $image_path. $organization->company_logo;
        if(file_exists($image)){
            @unlink($image);
        }
        $organization->delete();
    }

    public function get_organization_details($id)
    {
        $status = $this->get_status_list('common');
        $organization = Organization::with('users')->find($id);
        return compact('organization', 'status');
    }
}
