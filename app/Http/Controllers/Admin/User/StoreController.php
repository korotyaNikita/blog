<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Jobs\StoreUserJob;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            StoreUserJob::dispatch($data);
            DB::commit();
            return redirect()->route('admin.users.index');
        } catch(Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }
}
