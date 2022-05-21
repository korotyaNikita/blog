<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DestroyController extends BaseController
{
    public function __invoke(Post $post)
    {
        try {
            $post->delete();
        } catch (\Exception $exception) {
            abort(500);
        }
        return redirect()->route('admin.posts.index');
    }
}
