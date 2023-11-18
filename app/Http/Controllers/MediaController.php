<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Models\Media;
use App\Services\MediaService;

class MediaController extends Controller
{
    /**
     * Return all instances of the model.
     *
     * return string
     */
    public function get()
    {
        $media = Media::with('tags')->get();

        return response()->json($media);
    }

    /**
     * Posts a new instance of the model if validated.
     */
    public function post(MediaRequest $request, MediaService $service)
    {
        /**
         * Handles validation of the request.
         */
        $validated = $request->validated();

        $uploaded_media = $service->store(
            $request->file('file')
        );

        return response()->json($uploaded_media);
    }
}
