<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MailTemplates\Interfaces\MailTemplateInterface;
use Spatie\MailTemplates\Models\MailTemplate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Mail\Mailable;

class PostMailTemplate extends MailTemplate implements MailTemplateInterface
{
    use HasFactory;

    public function scopeForMailable(Builder $query, Mailable $mailable)
    {
        return $query
            ->where('mailable', get_class($mailable)
    );
    }
}
