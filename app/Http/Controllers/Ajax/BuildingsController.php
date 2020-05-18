<?php

namespace App\Http\Controllers\Ajax;

use App\Actions\StartBuildingUpgrade;
use App\Exceptions\AlreadyUpgradingBuildingException;
use App\Exceptions\NotEnoughResourcesException;
use App\Exceptions\TownHallLevelException;
use App\Exceptions\WrongBuildingIdException;
use App\Town;
use Illuminate\Http\Request;

final class BuildingsController
{
    public function update(Request $request, int $id, StartBuildingUpgrade $startBuildingUpgrade)
    {
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
        } catch (NotEnoughResourcesException $e) {
            return response()->json(
                ['error' => __('custom.errorResources')]
            );
        } catch (TownHallLevelException $e) {
            return response()->json(
                ['error' => __('custom.errorTownHallLevel')]
            );
        }

        return response()->json(true);
    }
}
