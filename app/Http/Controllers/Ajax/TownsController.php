<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Town as TownResource;
use App\Http\Resources\BuildingLevel as BuildingLevelResource;
use Facade\Ignition\SolutionProviders\IncorrectValetDbCredentialsSolutionProvider;

class TownsController extends Controller
{
    public function show(Request $request)
    {
        return response()->json(new TownResource($request->user()->town->load('buildingLevels', 'buildingLevels.building')));
    }

    public function update(Request $request, $id)
    {
        $town = $request->user()->town;
        $building = $town->buildingLevels()->whereBuildingLevelId($id)->first();

        if ($this->notEnoughResources($town, $building)) {
            return response()->json(
                ['error' => 'Not enough resources.']
            );
        }

        $th_level = $town->buildingLevels()->whereBuildingId(7)->first()->level;

        if ($building->level_town_hall > $th_level) {
            return response()->json(
                ['error' => 'You need to upgrade your town hall']
            );
        }
        
        $town->buildingLevels()->updateExistingPivot($id, ['update_time' => now()]);

        return response()->json($building);
    }

    private function notEnoughResources($town, $building)
    {
        return $town->food < $building->required_food
            || $town->wood < $building->required_wood
            || $town->stone < $building->required_stone
            || $town->gold < $building->required_gold;
    }
}
