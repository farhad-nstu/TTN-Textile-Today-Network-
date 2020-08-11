<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $statuses = $this->get_status_list('common');
        $settings = Setting::paginate(5);
        return compact('settings', 'statuses');
    }

    public function store(Request $request)
    {
        $setting = new Setting;
        $setting->code_name = request('code_name');
        $setting->code_label = request('code_label');
        $setting->code_value = request('code_value');
        $setting->code_descr = request('code_descr');
        $setting->status = request('status');
        $setting->save();
        return 'Setting Saved!';
    }

    public function show(Setting $setting)
    {
        //
    }

    public function update(Request $request, Setting $setting)
    {
        $setting->code_name = request('code_name');
        $setting->code_label = request('code_label');
        $setting->code_value = request('code_value');
        $setting->code_descr = request('code_descr');
        $setting->status = request('status');
        $setting->update();
        return 'Setting Updated!';
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
    }
}
