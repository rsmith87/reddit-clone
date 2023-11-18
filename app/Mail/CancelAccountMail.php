<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Spatie\MailTemplates\TemplateMailable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MailTemplate;

class CancelAccountMail extends TemplateMailable
{
    use Queueable, SerializesModels;

    public function mailLayout(): BelongsTo
    {
        return $this->belongsTo(MailTemplate::class);
    }

    /** @var string */
    public $name;

    public function __construct(User $user)
    {
        $this->name = $user->name;
    }

    public function getHtmlLayout(): string
    {
        return view('mail.cancel', [
            'name' => $this->name,
        ])->render();
    }
}
