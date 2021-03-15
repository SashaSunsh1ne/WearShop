<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getAllTags()
    {
        return view('tags', ['data' => Tag::all()]); // senting all tags to "tags" view
    }
}
