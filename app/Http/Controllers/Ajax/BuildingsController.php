<?php

namespace App\Http\Controllers\Ajax;

use App\Actions\StartBuildingUpgrade;
use App\Exceptions\NotEnoughResourcesException;
use App\Exceptions\TownHallLevelException;
use App\Town;
use Illuminate\Http\Request;

final class BuildingsController
{
    public function update(Request $request, int $id, StartBuildingUpgrade $startBuildingUpgrade)
    {
        $town = $request->user()->town;

        try {
            $startBuildingUpgrade->__invoke($town, $id, now());
        } catch (NotEnoughResourcesException $e) {
            return response()->json(
                ['error' => 'Not enough resources']
            );
        } catch (TownHallLevelException $e) {
            return response()->json(
                ['error' => 'You need to upgrade your town hall']
            );
        }

        return response()->json(true);
    }
}
