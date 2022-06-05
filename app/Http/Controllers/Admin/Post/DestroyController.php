<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostUserLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestroyController extends BaseController
{
    public function __invoke(Post $post)
    {
        try {
            DB::beginTransaction();
            $postLike = PostUserLike::where('post_id', $post->id);
            $postLike->delete();
            $post->comments()->delete();
            $post->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
        return redirect()->route('admin.posts.index');
    }
}
