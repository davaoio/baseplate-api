<?php

namespace App\Http\Controllers\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\Filter;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedIncludes('avatar')
            ->allowedSorts('first_name', 'last_name', 'created_at')
            ->allowedFilters([
                Filter::scope('search'),
            ])
            ->defaultSort('first_name')
            ->paginate(request('limit', 10));

        return UserResource::collection($users);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();

        return new UserResource($user);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
