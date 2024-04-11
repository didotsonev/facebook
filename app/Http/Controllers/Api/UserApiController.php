<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserIndexRequest;
use App\Http\Requests\UserShowRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserIndexRequest $request): AnonymousResourceCollection
    {
        $whereEmail = $request->{UserIndexRequest::WHERE_EMAIL};

//        if ($whereEmail) {
//            $users = User::where('email', $whereEmail)->get();
//        } else {
//            $users = User::all();
//        }

//        $users = User::query();
//
//        if ($whereEmail) {
//            $users->where('email', $whereEmail);
//        }
//
//        $users = $users->get();

        // SELECT * FROM users WHERE email = $whereEmail
        $users = User
            ::when($whereEmail, function ($query) use ($whereEmail)  {
                return $query->where(User::EMAIL, $whereEmail);
            })
            ->get();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): UserResource
    {
        $user = User::create($request->validated());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserShowRequest $request, User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user): UserResource
    {
        // update user data
        $user->update($request->all());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDestroyRequest $request, User $user): UserResource
    {
        $user->delete();

        return new UserResource($user);
    }
}
