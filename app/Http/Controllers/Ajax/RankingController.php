<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

final class RankingController
{
    public function show(Request $request)
    {
        $users = UserResource::collection(User::all());

        return response()->json($users);
    }
}