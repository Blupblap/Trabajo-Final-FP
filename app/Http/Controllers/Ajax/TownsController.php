<?php

namespace App\Http\Controllers\Ajax;

use App\Actions\UpdateTownResources;
use Illuminate\Http\Request;
use App\Http\Resources\TownResource;

final class TownsController
{
    public function show(Request $request, UpdateTownResources $updateTownResources)
    {
        $town = $request->user()->town;

        $updateTownResources->__invoke($town, now());

        return response()->json(new TownResource($town->load('buildingLevels', 'buildingLevels.building')));
    }
}
