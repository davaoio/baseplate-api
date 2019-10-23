<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->only(['name']));

        return new UserResource($user);
    }
}
