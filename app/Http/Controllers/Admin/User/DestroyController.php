<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(User $user)
    {
        try {
            $user->delete();
        } catch (\Exception $exception) {
            abort(500);
        }
        return redirect()->route('admin.users.index');
    }
}
