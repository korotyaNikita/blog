<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $password = Str::random(10);
            $data['password'] = Hash::make($password);
            $user = User::create($data);
            Mail::to($data['email'])->send(new PasswordMail($password));
            event(new Registered($user));
            DB::commit();
            return redirect()->route('admin.users.index');
        } catch(Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }
}
