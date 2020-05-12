<?php

namespace App\Http\Controllers\Ajax;

use App\BuildingLevel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Town as TownResource;
use App\Http\Resources\BuildingLevel as BuildingLevelResource;
use Carbon\Carbon;
use Facade\Ignition\SolutionProviders\IncorrectValetDbCredentialsSolutionProvider;

class TownsController extends Controller
{
    public function show(Request $request)
    {
        $town = $request->user()->town;

        $this->updateResources($town);

        return response()->json(new TownResource($town->load('buildingLevels', 'buildingLevels.building')));
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

    private function updateResources($town)
    {
        $now = now();
        // $now = Carbon::createFromFormat('d-m-Y H:i:s', '09-05-2020 18:25:00');

        $time_offline = $now->diffInMinutes($town->last_checked);

        $buildingLevels = $town->buildingLevels()->updatesSomeResources()->get();

        $foodToAdd = 0;
        $woodToAdd = 0;
        $stoneToAdd = 0;
        $goldToAdd = 0;

        foreach ($buildingLevels as $buildingLevel) {
            if ($buildingLevel->pivot->update_time === null || $now->diffInMinutes($buildingLevel->pivot->update_time) < $buildingLevel->update_duration) {
                $foodToAdd += $time_offline * $buildingLevel->food_per_minute;
                $woodToAdd += $time_offline * $buildingLevel->wood_per_minute;
                $stoneToAdd += $time_offline * $buildingLevel->stone_per_minute;
                $goldToAdd += $time_offline * $buildingLevel->gold_per_minute;

                continue;
            }

            $time_until_update = $buildingLevel->update_duration - $town->last_checked->diffInMinutes($buildingLevel->pivot->update_time);
            $foodToAdd += $time_until_update * $buildingLevel->food_per_minute;
            $woodToAdd += $time_until_update * $buildingLevel->wood_per_minute;
            $stoneToAdd += $time_until_update * $buildingLevel->stone_per_minute;
            $goldToAdd += $time_until_update * $buildingLevel->gold_per_minute;

            $nextBuildingLevel = $buildingLevel->getNext();

            $remaining_time = $time_offline - $time_until_update;
            $foodToAdd += $remaining_time * $nextBuildingLevel->food_per_minute;
            $woodToAdd += $remaining_time * $nextBuildingLevel->wood_per_minute;
            $stoneToAdd += $remaining_time * $nextBuildingLevel->stone_per_minute;
            $goldToAdd += $remaining_time * $nextBuildingLevel->gold_per_minute;

            $town->buildingLevels()->updateExistingPivot(
                $buildingLevel->getKey(),
                [
                    'building_level_id' => $nextBuildingLevel->getKey(),
                    'update_time' => null
                ]
            );
        }

        $town->food += $foodToAdd;
        $town->wood += $woodToAdd;
        $town->stone += $stoneToAdd;
        $town->gold += $goldToAdd;

        $town->last_checked = $now;

        $town->save();
    }

    private function notEnoughResources($town, $building)
    {
        return $town->food < $building->required_food
            || $town->wood < $building->required_wood
            || $town->stone < $building->required_stone
            || $town->gold < $building->required_gold;
    }
}
