<?php

namespace App\Http\Controllers\Post\Like;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Comment\StoreRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __invoke(Post $post)
    {
        try {
            DB::beginTransaction();
            auth()->user()->likedPosts()->toggle($post->id);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(404);
        }
        return redirect()->back();
    }
}
