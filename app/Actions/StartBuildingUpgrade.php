<?php

namespace App\Actions;

use App\Building;
use App\Exceptions\AlreadyUpgradingBuildingException;
use App\Exceptions\NotEnoughResourcesException;
use App\Exceptions\TownHallLevelException;
use App\Exceptions\WrongBuildingIdException;
use App\Town;
use Carbon\Carbon;

final class StartBuildingUpgrade
{
    private $updateTownBuildingsAndResources;

    public function __construct(UpdateTownBuildingsAndResources $updateTownBuildingsAndResources)
    {
        $this->updateTownBuildingsAndResources = $updateTownBuildingsAndResources;
    }

    public function __invoke(Town $town, int $id, Carbon $now)
    {
        $this->updateTownBuildingsAndResources->__invoke($town, $now);

        $buildingLevel = $town->buildingLevels()->whereBuildingLevelId($id)->first();

        if ($buildingLevel === null) {
            throw new WrongBuildingIdException();
        }

        if ($buildingLevel->pivot->upgrade_time !== null) {
            throw new AlreadyUpgradingBuildingException();
        }

        if (!$town->enoughResources($buildingLevel)) {
            throw new NotEnoughResourcesException();
        }

        $townhallLevel = $town->buildingLevels()->whereBuildingId(Building::TOWNHALL)->first()->level;

        if ($buildingLevel->level_town_hall > $townhallLevel) {
            throw new TownHallLevelException();
        }

        $town->startBuildingUpgrade($buildingLevel, $now);

        $town->save();
    }
}
