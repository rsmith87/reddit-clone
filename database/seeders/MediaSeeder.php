<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Media;
use App\Models\Statistics;
use App\Models\User;
use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::reguard();
        for($i=1;$i<=7;$i++) {
            $image = Image::make(public_path('images/'.$i.'.png'));
            $encoded = $image->encode('data-url')->encoded;

            $media = new Media;
            $media->name = 'image'.$i;
            $media->hash_name = md5('image'.$i);
            $media->path = public_path('images/'.$i.'.png');
            $media->mime_type = $image->mime();
            $media->size = $image->filesize();
            $media->blob = $encoded;
            $media->slug = 'image-'.$i;
            $media->user_id = User::factory()->create()->id;
            $media->save();
        }
    }
}
