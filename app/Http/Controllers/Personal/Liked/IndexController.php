<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        try {
            $posts = auth()->user()->likedPosts()->paginate(8);
        } catch (\Exception $exception) {
            abort(500);
        }
        return view('personal.liked.index', compact('posts'));
    }
}
