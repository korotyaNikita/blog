<?php

namespace App\Http\Controllers\Personal\Comment;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        try {
            $comments = auth()->user()->comments()->paginate(8);
        } catch (\Exception $exception) {
            abort(500);
        }
        return view('personal.comment.index', compact('comments'));
    }
}
