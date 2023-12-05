<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaModifyRequest;
use App\Http\Requests\MediaRequest;
use App\Http\Resources\MediaCollection;
use App\Http\Resources\MediaResource;
use App\Http\Resources\ModifiedMediaResource;
use App\Models\Media;
use App\Services\MediaService;

class MediaController extends Controller
{
    /**
     * Return all instances of the model.
     *
     * return string
     */
    public function get(): MediaCollection
    {
        $media = Media::all();
        $media->load(['tags']);

        return new MediaCollection($media);
    }

    public function find(Media $media): MediaResource
    {
        $media->load(['tags']);

        return new MediaResource($media);
    }

    /**
     * Posts a new instance of the model if validated.
     */
    public function post(MediaRequest $mediaRequest, MediaService $mediaService): MediaResource
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

    public function modify(Media $media, MediaService $mediaService, MediaModifyRequest $mediaModifyRequest): ModifiedMediaResource
    {
        $resized_media = $mediaService->modify($media, $mediaModifyRequest);

        return new ModifiedMediaResource($resized_media);
    }

    public function delete(Media $media, MediaService $mediaService): \Illuminate\Http\JsonResponse
    {
        $deletedMedia = $mediaService->delete($media);

        return $deletedMedia ? response()->noContent() : response()->json('There was an error deleting your file.');
    }

    public function fetch(Media $media, MediaService $mediaService): \Illuminate\Http\Response
    {
        //Cache::get('media', );
        $decodedBlob = $mediaService->stripEncodedBlobText($media);
        return response(
            base64_decode($decodedBlob), 
            200
        )->withHeaders([
            'Content-Type' => $media->mime_type,
            'Cache-Control' => 'max-age=' . 60 * 60 * 24 * 31 . ', must-revalidate, public, immutable',
            'Expires' => 60 * 60 * 24 * 31,
        ]);
    }
}
