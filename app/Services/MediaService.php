<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;

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
        $uploaded = $file->storePublicly('uploads');

        if (! $uploaded) {
            return response()->json('There was an error uploading your file.');
        }

        return Media::create([
            'path' => $uploaded,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'extension' => $file->extension(),
            'user_id' => auth()->id(),
        ]);
    }
}
