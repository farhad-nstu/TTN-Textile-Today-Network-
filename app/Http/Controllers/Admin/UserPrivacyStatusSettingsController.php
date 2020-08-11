<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProfileSetting;

class UserPrivacyStatusSettingsController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profileStatus = $this->get_status_list('common');
        $profileSetting = ProfileSetting::orderBy('id', 'desc')->get();
        return compact('profileStatus', 'profileSetting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profileSetting = new ProfileSetting();

        $profileSetting->table_name = request('table_name');
        $profileSetting->description = request('description');
        $profileSetting->status = request('status');
        $profileSetting->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profileSetting = ProfileSetting::find($id);
        $profileSetting->table_name = request('table_name');
        $profileSetting->description = request('description');
        $profileSetting->status = request('status');
        $profileSetting->update();

        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profileSetting = ProfileSetting::find($id);
        $profileSetting->delete();
        return 1;
    }
}
