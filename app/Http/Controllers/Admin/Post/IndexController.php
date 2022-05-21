<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {
        try {
            $posts = Post::paginate(8);
        } catch (\Exception $exception) {
            abort(500);
        }
        return view('admin.posts.index', compact('posts'));
    }
}
