<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Post $post)
    {
        try {
            auth()->user()->likedPosts()->detach($post->id);
        } catch (\Exception $exception) {
            abort(500);
        }
        return redirect()->route('personal.liked.index');
    }
}
