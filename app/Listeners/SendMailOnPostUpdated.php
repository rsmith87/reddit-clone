<?php

namespace App\Listeners;

use App\Events\PostUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\PostUpdatedMail;
use Mail;

class SendMailOnPostUpdated implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(PostUpdated $event): void
    {
        Mail::to($event->post->user->email)->send(new PostUpdatedMail($event->post));
    }
}
