<?php

namespace App\Mail;

use App\Models\MailTemplate;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MailTemplates\TemplateMailable;

class PostUpdatedMail extends TemplateMailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function mailLayout(): BelongsTo
    {
        return $this->belongsTo(MailTemplate::class);
    }

    /** @var string */
    public $post;

    public $name;

    /**
     * Create a new message instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
        $this->name = $post->title;
    }

    public function getHtmlLayout(): string
    {
        return view('mail.post-updated', [
            'post' => $this->post,
            'name' => $this->post->title,
        ])->render();
    }
}
