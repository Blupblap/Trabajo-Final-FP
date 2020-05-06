<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Town as TownResource;
use Facade\Ignition\SolutionProviders\IncorrectValetDbCredentialsSolutionProvider;

class TownsController extends Controller
{
    public function show(Request $request)
    {
        return response()->json(new TownResource($request->user()->town->load('buildingLevels', 'buildingLevels.building')));
    }
}
