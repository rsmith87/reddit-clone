<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('media:deleteFiles', function () {
    $this->comment('Deleting media files...');
    $media = \App\Models\Media::all();
    foreach($media as $m) {
        if(Storage::disk('public')->exists($m->path)) {
            $this->comment('Deleting media file: ' . Storage::disk('public')->path($m->path));
            unlink(Storage::disk('public')->path($m->path));
        }
    }
    $this->comment('Done!');
})->purpose('Delete all media files from the database.');
