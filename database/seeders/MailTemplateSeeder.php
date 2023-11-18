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
            'mailable' => \App\Mail\WelcomeMail::class,
            'subject' => 'Welcome, {{ name }}',
            'html_template' => '<h1>Hello, {{ name }}! {{ email }}</h1>',
            'text_template' => 'Hello, {{ name }}!',
        ]);

        MailTemplate::create([
            'mailable' => \App\Mail\CancelAccountMail::class,
            'subject' => 'Leaving us already? (cancel account) {{ name }}',
            'html_template' => '<h1>Goodbye, {{ name }}!</h1>',
            'text_template' => 'Goodbye, {{ name }}!',
        ]);
    }
}
