<?php

namespace App\Http\Controllers\Personal\Main;

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
            $data = [];
            $data['commentsCount'] = auth()->user()->comments()->count();
            $data['likedPostsCount'] = auth()->user()->likedPosts()->count();
        } catch (\Exception $exception) {
            abort(500);
        }
        return view('personal.main.index', compact('data'));
    }
}
