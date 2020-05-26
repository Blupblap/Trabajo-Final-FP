<?php

namespace App\Http\Controllers\Ajax;

use App\Actions\StartBuildingUpgrade;
use App\Exceptions\AlreadyUpgradingBuildingException;
use App\Exceptions\NextLevelNotExists;
use App\Exceptions\NotEnoughResourcesException;
use App\Exceptions\TownHallLevelException;
use App\Exceptions\WrongBuildingIdException;
use App\Http\Resources\TownResource;
use Illuminate\Http\Request;

final class BuildingsController
{
    public function update(Request $request, StartBuildingUpgrade $startBuildingUpgrade)
    {
        $id = $request->building_level_id;

        $town = $request->user()->town;

        try {
            $startBuildingUpgrade->__invoke($town, $id, now());
        } catch (AlreadyUpgradingBuildingException $e) {
            return response()->json(
                ['error' => __('custom.errorAlreadyUpgradingBuilding', ['id' => $id])]
            );
        } catch (WrongBuildingIdException $e) {
            return response()->json(
                ['error' => __('custom.errorWrongBuildingId', ['id' => $id])]
            );
        } catch (NextLevelNotExists $e) {
            return response()->json(
                ['error' => __('custom.errorNextLevelNotExists', ['id' => $id])]
            );
        } catch (NotEnoughResourcesException $e) {
            return response()->json(
                ['error' => __('custom.errorResources')]
            );
        } catch (TownHallLevelException $e) {
            return response()->json(
                ['error' => __('custom.errorTownHallLevel')]
            );
        }

        return response()->json(new TownResource($town->load('buildingLevels', 'buildingLevels.building')));
    }
}
