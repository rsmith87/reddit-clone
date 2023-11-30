<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailTemplateRequest;
use App\Models\MailTemplate;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class MailTemplateController extends Controller
{
    public function index()
    {
        $mailTemplates = MailTemplate::all();
        return response()->json($mailTemplates);
    }

    public function createMailTemplate(MailTemplateRequest $mailTemplateRequest)
    {
        $mailTemplate = MailTemplate::create($mailTemplateRequest->all());
        // Here we may need to create the mail template file in the filesystem.
        // It'd be a good idea to have something to copy from.
        $createTemplate = Artisan::call('make:mail', [
            'name' => $mailTemplate->name,
            '--markdown' => 'mail.' . $mailTemplate->name,
        ]   
        );
        return response()->json($mailTemplate);
    }

    public function editMailTemplate(MailTemplateRequest $mailTemplateRequest, MailTemplate $mailTemplate)
    {
        $mailTemplate->update($mailTemplateRequest->all());
        return response()->json($mailTemplate);
    }

    public function findMailTemplate(MailTemplate $mailTemplate)
    {
        return response()->json($mailTemplate);
    }

    public function deleteMailTemplate(MailTemplate $mailTemplate)
    {
        $mailTemplate->delete();
        return response()->json($mailTemplate);
    }
}
