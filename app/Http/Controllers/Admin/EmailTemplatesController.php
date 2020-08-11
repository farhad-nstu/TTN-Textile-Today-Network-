<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplatesController extends Controller
{
    public function __construct() {
       $this->middleware('auth:api');
    }

    public function index()
    {
        $emailTemplates = EmailTemplate::orderBy('id', 'desc')->get();
        return $emailTemplates;

    }

    public function store(Request $request)
    {
       $emailTemplate = new EmailTemplate;

       $emailTemplate->template_title = request('template_title');
       $emailTemplate->template_code = request('template_code');
       $emailTemplate->email_subject = request('email_subject');
       $emailTemplate->email_body = request('email_body');
       $emailTemplate->email_from = request('email_from');

       $emailTemplate->save();

    }

    public function update(Request $request, EmailTemplate $emailTemplate)
    {
       $emailTemplate->template_title = request('template_title');
       $emailTemplate->template_code = request('template_code');
       $emailTemplate->email_subject = request('email_subject');
       $emailTemplate->email_body = request('email_body');
       $emailTemplate->email_from = request('email_from');

       $emailTemplate->save();

    }


    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();
    }
}
