<?php

namespace Database\Seeders;

use App\Models\MailTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MailTemplate::create([
            'name' => 'Welcome email',
            'mailable' => \App\Mail\WelcomeMail::class,
            'subject' => 'Welcome, {{ name }}',
            'html_template' => '<h1>Hello, {{ name }}! {{ email }}</h1>',
            'text_template' => 'Hello, {{ name }}!',
        ]);

        MailTemplate::create([
            'name' => 'Cancel account email',
            'mailable' => \App\Mail\CancelAccountMail::class,
            'subject' => 'Leaving us already? (cancel account) {{ name }}',
            'html_template' => '<h1>Goodbye, {{ name }}!</h1>',
            'text_template' => 'Goodbye, {{ name }}!',
        ]);

        MailTemplate::create([
            'name' => 'Post email',
            'mailable' => \App\Mail\PostMail::class,
            'subject' => 'New post: {{ name }}',
            'html_template' => '<h1>NEW POST BRO</h1>',
            'text_template' => 'NEW POST BRO!',
        ]);

        MailTemplate::create([
            'name' => 'Post updated email',
            'mailable' => \App\Mail\PostUpdatedMail::class,
            'subject' => 'Updated post: {{ name }}',
            'html_template' => '<h1>Updated POST BRO</h1>',
            'text_template' => 'Updated POST BRO!',
        ]);
    }
}
