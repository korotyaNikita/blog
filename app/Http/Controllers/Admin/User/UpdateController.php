<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $user->update($data);
            DB::commit();
        } catch(Exception $exception) {
            DB::rollBack();
            abort(500);
        }
        return redirect()->route('admin.users.show', $user->id);
    }
}
