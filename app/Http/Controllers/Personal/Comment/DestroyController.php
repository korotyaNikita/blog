<?php

namespace App\Http\Controllers\Personal\Comment;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Comment $comment)
    {
        try {
            $comment->delete();
        } catch (\Exception $exception) {
            abort(500);
        }
        return redirect()->route('personal.comments.index');
    }
}
