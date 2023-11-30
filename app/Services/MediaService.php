<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MediaModifyRequest;

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

    public function modify(Media $media, MediaModifyRequest $mediaModifyRequest)
    {
        $filename = pathinfo($media->path)['filename'];
        $image = Image::make($media->path);

        if($mediaModifyRequest->has('preserveAspectRatio')) {
            $image->resize($mediaModifyRequest->get('width') , $mediaModifyRequest->get('height'), function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        if($mediaModifyRequest->has('opacity') < 100) {
            $image->opacity($mediaModifyRequest->get('opacity'));
        }

        if($mediaModifyRequest->has('extension')) {
            $path = public_path() .'/images/resized/' . $filename . '.' . $mediaModifyRequest->get('extension');
            $image->save($path);
            $media->extension = $mediaModifyRequest->get('extension');
            $media->save();
        }

        if($mediaModifyRequest->has('name')) {
            $path = public_path() .'/images/resized/' . $mediaModifyRequest->get('name') . '.' . $media->extension;
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

    public function delete(Media $media): bool
    {
        $image = Storage::disk('public')->delete($media->path);
        $media->delete();

        return true;
    }

    public function getPath(Media $media): string
    {
        return Storage::disk('public')->path($media->path);
    }

    public function stripEncodedBlobText(Media $media): string
    {
        return str_replace('data:'.$media->mime_type.';base64,', '', $media->blob);
    }
}
