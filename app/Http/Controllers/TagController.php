<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Return all instances of the model.
     */
    public function get()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }
}
