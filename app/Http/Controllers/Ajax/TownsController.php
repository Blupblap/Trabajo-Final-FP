<?php

namespace App\Http\Controllers\Ajax;

use App\Actions\UpdateTownBuildingsAndResources;
use Illuminate\Http\Request;
use App\Http\Resources\TownResource;

final class TownsController
{
    public function show(Request $request, UpdateTownBuildingsAndResources $updateTownBuildingsAndResources)
    {
        $town = $request->user()->town;

        $updateTownBuildingsAndResources->__invoke($town, now());

        return response()->json(new TownResource($town->load('buildingLevels', 'buildingLevels.building')));
    }
}
