<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        $services = Service::orderBy('id', 'desc')->get();
        return compact('services', 'status');
    }


    public function store(Request $request)
    {
        $service = new Service;

        $service->title = request('title');
        $service->service_code = request('service_code');
        $service->descr = request('descr');
        $service->status = request('status');

        $service->save();

    }

    public function update(Request $request, Service $service)
    {
        $service->title = request('title');
        $service->service_code = request('service_code');
        $service->descr = request('descr');
        $service->status = request('status');
        
        $service->save();

    }


    public function destroy(Service $service)
    {
        $service->delete();
    }
}
