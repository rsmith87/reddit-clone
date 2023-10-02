<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

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
    public function post(Request $request)
    {
        $validated = $request->validate([
            'media' => 'required'
        ]);

        $media = $request->file('media');

        $destination_path = 'uploads';
        $media->move($destination_path, $media->getClientOriginalName());

        Media::updateOrCreate([
            'path',
            'mime_type' => $media->getMimeType(),
            'size' => $media->getSize(),
            'extension' => $media->getClientOriginalExtension(),
        ]);
    }
}
