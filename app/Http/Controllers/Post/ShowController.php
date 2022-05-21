<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        try {
            $date = Carbon::parse($post->created_at);
            $relatedPosts = Post::where('category_id', $post->category_id)
                ->where('id', '!=', $post->id)
                ->get()
                ->take(3);
        } catch (\Exception $exception) {
            abort(500);
        }
        return view('post.show', compact('post', 'date', 'relatedPosts'));
    }
}
