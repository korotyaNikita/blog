<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        try {
            $categories = Category::all();
            $posts = Post::paginate(6);
            $postsCount = $posts->count();
            $randomPosts = $postsCount >= 4 ? Post::get()->random(4) : Post::all()->take($postsCount);
            $likedPosts = Post::withCount('likedUsers')->orderBy('liked_users_count', 'DESC')->get()->take(4);
        } catch (\Exception $exception) {
            abort(500);
        }
        return view('post.index', compact('posts', 'randomPosts', 'likedPosts', 'categories'));
    }
}
