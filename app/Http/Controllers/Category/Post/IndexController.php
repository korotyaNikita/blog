<?php

namespace App\Http\Controllers\Category\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;

class IndexController extends Controller
{
    public function __invoke(Category $category)
    {
        try {
            $posts = $category->posts()->paginate(6);
        } catch (\Exception $exception) {
            abort(500);
        }
        return view('category.post.index', compact('posts'));
    }
}
