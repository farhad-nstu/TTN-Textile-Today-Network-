<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Language;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        $languages = Language::orderBy('id', 'desc')->get();
        return compact('languages', 'status');
    }


    public function store(Request $request)
    {
        $language = new Language;

        $language->name = request('name');
        $language->language_code = request('language_code');
        $language->native_name = request('native_name');
        $language->status = request('status');

        $language->save();

    }

    public function update(Request $request, Language $language)
    {
        $language->name = request('name');
        $language->language_code = request('language_code');
        $language->native_name = request('native_name');
        $language->status = request('status');
        
        $language->save();

    }


    public function destroy(Language $language)
    {
        $language->delete();
    }
}
