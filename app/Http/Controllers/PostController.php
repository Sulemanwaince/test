<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPodcast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Store a new podcast.
     *
     * @param Request $request
     * @param $post
     * @return Response
     */
    public function store(Request $request, $post)
    {
        // Create post here ..
        SendEmails::dispatch($post);
    }
}
