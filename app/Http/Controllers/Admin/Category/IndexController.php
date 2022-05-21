<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        try {
            $categories = Category::paginate(8);
        } catch (\Exception $exception) {
            abort(500);
        }
        return view('admin.categories.index', compact('categories'));
    }
}
