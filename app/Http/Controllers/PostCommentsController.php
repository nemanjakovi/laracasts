<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Post $post)
    {

        // vlaidateion
        request()->validate([
            'body' => 'required'

        ]);

        $post->comments()->create([

            'body' => request('body'),
            'user_id' => request()->user()->id

        ]);

        return back();
    }
}
