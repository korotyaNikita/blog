<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Tag $tag)
    {
        try {
            $tag->delete();
        } catch (\Exception $exception) {
            abort(500);
        }
        return redirect()->route('admin.tags.index');
    }
}
