<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Resources\UserResource;
use App\User;

final class RankingController
{
    public function show()
    {
        $users = collect(UserResource::collection(User::all()))->sortByDesc('score')->values()->all();

        return response()->json($users);
    }
}