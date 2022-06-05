<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class CreateController extends Controller
{
    public function __invoke()
    {
        try {
            $roles = User::getRoles();
        } catch (\Exception $exception) {
            abort(500);
        }
        return view('admin.users.create', compact('roles'));
    }
}
