<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\EventType;
use Illuminate\Http\Request;

class EventTypesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        $eventTypes = EventType::orderBy('id', 'desc')->get();
        return compact('eventTypes', 'status');
    }


    public function store(Request $request)
    {
       $eventType = new EventType;

               $eventType->title = request('title');
               $eventType->type_code = request('type_code');
               $eventType->descr = request('descr');
               $eventType->status = request('status');

               $eventType->save();

    }

    public function update(Request $request, EventType $eventType)
    {
        $eventType->title = request('title');
        $eventType->type_code = request('type_code');
        $eventType->descr = request('descr');
        $eventType->status = request('status');
        
        $eventType->save();

    }


    public function destroy(EventType $eventType)
    {
        $eventType->delete();
    }
}
