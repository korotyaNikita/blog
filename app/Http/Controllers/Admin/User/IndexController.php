<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        try {
            $users = User::paginate(8);
        } catch (\Exception $exception) {
            abort(500);
        }
        return view('admin.users.index', compact('users'));
    }
}
