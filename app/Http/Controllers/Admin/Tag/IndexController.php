<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        try {
            $tags = Tag::paginate(8);
        } catch (\Exception $exception) {
            abort(500);
        }
        return view('admin.tags.index', compact('tags'));
    }
}
