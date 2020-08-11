<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\AccessPoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccessPointsController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $accessPoints = AccessPoint::orderBy('id', 'desc')->paginate(10);
        $statuses = $this->get_status_list('common');
        return compact('accessPoints', 'statuses'); 

    }


    public function create()
    {
        return view('access-points.create');
    }


    public function store(Request $request)
    {

        //   $request->validate([
        //     'access_point_name' => 'required|max:200',
        //     'unique_code' => 'required|100',
        //     'status' => 'max:1|required',
        // ]);

        $accessPoint = new AccessPoint;

        $accessPoint->access_point_name = request('access_point_name');
        $accessPoint->unique_code = request('unique_code');
        $accessPoint->descr = request('descr');
        $accessPoint->status = request('status');

        $accessPoint->save();

    }

    public function update(Request $request, AccessPoint $accessPoint)
    {
        $accessPoint->access_point_name = request('access_point_name');
        $accessPoint->unique_code = request('unique_code');
        $accessPoint->descr = request('descr');
        $accessPoint->status = request('status');

        $accessPoint->save();

    }


    public function destroy(AccessPoint $accessPoint)
    {
        $accessPoint->delete();
    }
}
