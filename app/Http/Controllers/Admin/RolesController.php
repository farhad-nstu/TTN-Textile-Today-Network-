<?php

namespace App\Http\Controllers\Admin;


use App\Models\Admin\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RolesController extends Controller
{
    public function __construct() {
       $this->middleware('auth:api');
    }
    
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->paginate(10);
        return $roles;
    }


    public function store(Request $request)
    {
        $role = new Role;
        $role->title = request('title');
        $role->descr = request('descr');
        $role->save();

    }

    public function update(Request $request, Role $role)
    {
        $role->title = request('title');
        $role->descr = request('descr');
        $role->save();

    }


    public function destroy(Role $role)
    {
        $role->delete();
    }
}
