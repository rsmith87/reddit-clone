<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaModifyRequest;
use App\Http\Requests\MediaRequest;
use App\Http\Resources\MediaCollection;
use App\Http\Resources\MediaResource;
use App\Http\Resources\ModifiedMediaResource;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Return all instances of the model.
     *
     * return string
     */
    public function get()
    {
        $media = Media::all();
        $media->load(['tags']);

        return new MediaCollection($media);
    }

    public function find($id)
    {
        $media = Media::find($id);
        $media->load(['tags']);

        return new MediaResource($media);
    }

    /**
     * Posts a new instance of the model if validated.
     */
    public function post(MediaRequest $mediaRequest, MediaService $mediaService)
    {
        /**
         * Handles validation of the request.
         */
        $validated = $mediaRequest->validated();

        $media = $mediaService->store(
            $mediaRequest->file('file')
        );

        return new MediaResource($media);
    }

    public function modify(Media $media, MediaService $mediaService, MediaModifyRequest $mediaModifyRequest)
    {
        $mediaModifyRequest->validated();

        $attributes = [
            'preserveAspectRatio' => $mediaModifyRequest->has('preserveAspectRatio') ? $mediaModifyRequest->get('preserveAspectRatio') : false,
            'opacity' => $mediaModifyRequest->has('opacity') ? $mediaModifyRequest->get('opacity') : 100,
            'overwriteOriginal' => $mediaModifyRequest->has('overwriteOriginal') ? $mediaModifyRequest->get('overwriteOriginal') : false,
            'name' => $mediaModifyRequest->has('name') ? $mediaModifyRequest->get('name') : null,
            'width' => $mediaModifyRequest->has('width') ? $mediaModifyRequest->get('width') : null,
            'height' => $mediaModifyRequest->has('height') ? $mediaModifyRequest->get('height') : null,
            'extension' => $mediaModifyRequest->has('extension') ? $mediaModifyRequest->get('extension') : $media->first()->extension,
        ];

        $resized_media = $mediaService->modify($media, $attributes);

        return new ModifiedMediaResource($resized_media);
    }

    public function delete(Media $media)
    {
        $media->delete();

        return response()->json('Media deleted successfully.');
    }

    public function fetchMedia(Media $media)
    {
        $file = Storage::disk('public')->get($media->path);
        $decodedBlob = str_replace('data:'.$media->mime_type.';base64,', '', $media->blob);
        return response(base64_decode($decodedBlob), 200)->header('Content-Type', $media->mime_type);
    }
}
