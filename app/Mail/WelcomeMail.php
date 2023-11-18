<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Queue\SerializesModels;
use Spatie\MailTemplates\TemplateMailable;
use App\Models\User;
use App\Models\MailTemplate;

class WelcomeMail extends TemplateMailable
{
    use Queueable, SerializesModels;

    public function mailLayout(): BelongsTo
    {
        return $this->belongsTo(MailTemplate::class);
    }

    /** @var string */
    public $name;
    
    /** @var string */
    public $email;

    public function __construct(User $user)
    {
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function getHtmlLayout(): string
    {
        return view('mail.welcome', [
            'name' => $this->name,
            'email' => $this->email,
        ])->render();
    }
}
