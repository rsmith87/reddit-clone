<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Mail\CancelAccountMail;
use App\Http\Requests\MailTemplateRequest;
use App\Models\MailTemplate;
use App\Models\User;
use Mail;

class MailController extends Controller
{
    /**
     * Create the mail template.
     *
     * @param  MailTemplateRequest  $mailTemplateRequest
     * @return void
     */
    public function createMailTemplate(MailTemplateRequest $mailTemplateRequest)
    {
        $mailTemplate = new MailTemplate();
        $mailTemplate->mailable = $mailTemplateRequest->mailable;
        $mailTemplate->subject = $mailTemplateRequest->subject;
        $mailTemplate->html_template = $mailTemplateRequest->html_template;
        $mailTemplate->text_template = $mailTemplateRequest->text_template;
        $mailTemplate->save();
        return response()->json($mailTemplate);
    }

    /**
     * Update the mail template.
     *
     * @param  MailTemplateRequest  $mailTemplateRequest
     * @return void
     */
    public function editMailTemplate(MailTemplateRequest $mailTemplateRequest)
    {
        $mailTemplate = MailTemplate::where('id', $mailTemplateRequest->id)->first();
        $mailTemplate->mailable = $mailTemplateRequest->mailable;
        $mailTemplate->subject = $mailTemplateRequest->subject;
        $mailTemplate->html_template = $mailTemplateRequest->html_template;
        $mailTemplate->text_template = $mailTemplateRequest->text_template;
        $mailTemplate->save();
        return response()->json($mailTemplate);
    }

    public function sendMail()
    {
        $user = User::where('id', \Auth::id())->first();
        Mail::to($user->email)->send(new WelcomeMail($user));
    }

    public function sendCancelAccountMail()
    {
        $user = User::where('id', \Auth::id())->first();
        Mail::to($user->email)->send(new CancelAccountMail($user));
    }
}
