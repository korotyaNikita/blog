<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Tag $tag)
    {
        try {
            $data = $request->validated();
            $tag->update($data);
        } catch (\Exception $exception) {
            abort(500);
        }
        return redirect()->route('admin.tags.show', $tag->id);
    }
}
