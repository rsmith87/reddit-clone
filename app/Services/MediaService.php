<?php

namespace App\Services;

use App\Http\Requests\MediaRequest;
use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class MediaService
{
    /**
     * Stores a new Media
     *
     * @return mixed $media
     */
    public function store(
        UploadedFile $file
    ): Media {
        $uploadedFile = Storage::disk('public')->put("apiUploads", $file);

        if (!$uploadedFile) {
            return response()->json('There was an error uploading your file.');
        }

        $storedMedia = new Media;
        $storedMedia->name = $file->getClientOriginalName();
        $storedMedia->hash_name = pathinfo($file->hashName(), PATHINFO_FILENAME);
        $storedMedia->path = $uploadedFile;
        $storedMedia->mime_type = $file->getMimeType();
        $storedMedia->size = $file->getSize();
        $storedMedia->blob = Image::make($file)->encode('data-url')->encoded;
        $storedMedia->user_id = auth()->id();
        $storedMedia->save();

        return $storedMedia;
    } 

    public function modify(Media $media, array $attributes)
    {
        $media = Media::first();
        $filename = pathinfo($media->path)['filename'];
        $image = Image::make($media->path);

        if($attributes['preserveAspectRatio']) {
            $image->resize($attributes['width'], $attributes['height'], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        if($attributes['opacity'] < 100) {
            $image->opacity($attributes['opacity']);
        }

        if($attributes['extension']) {
            $path = public_path() .'/images/resized/' . $filename . '.' . $attributes['extension'];
            $image->save($path);
            $media->extension = $attributes['extension'];
            $media->save();
        }

        if($attributes['name']) {
            $path = public_path() .'/images/resized/' . $attributes['name'] . '.' . $media->extension;
            $image->save($path);
            $media->path = $path;
            $media->save();
        }

        if (! $image) {
            return response()->json('There was an error resizing your file.');
        }
        

        return $media;
    }

    public function rename(Media $media, string $newName)
    {
        $path = $media->path;
        
        $extension = $media->extension;

        $renamed = Image::make($path);

        $renamed->save(public_path() .'/images/resized/' . $newName . '.' . $extension);

        $media->path = public_path() .'/images/resized/' . $newName . '.' . $extension;
        $media->save();

        if (! $renamed) {
            return response()->json('There was an error renaming your file.');
        }

        return $renamed->filename . '.' . $renamed->extension;
    }

    public function getPath(Media $media)
    {
        return public_path($media->path);
    }
}
