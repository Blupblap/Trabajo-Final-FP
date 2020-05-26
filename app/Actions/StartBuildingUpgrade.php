<?php

namespace App\Actions;

use App\Building;
use App\Exceptions\AlreadyUpgradingBuildingException;
use App\Exceptions\NextLevelNotExists;
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

        if (is_null($buildingLevel)) {
            throw new WrongBuildingIdException();
        }

        if (is_null($buildingLevel->getNext())) {
            throw new NextLevelNotExists();
        }

        if (isset($buildingLevel->pivot->upgrade_time)) {
            throw new AlreadyUpgradingBuildingException();
        }

        $townhallLevel = $town->buildingLevels()->whereBuildingId(Building::TOWNHALL)->first()->level;

        if ($buildingLevel->level_town_hall > $townhallLevel) {
            throw new TownHallLevelException();
        }

        if (!$town->enoughResources($buildingLevel)) {
            throw new NotEnoughResourcesException();
        }

        $town->startBuildingUpgrade($buildingLevel, $now);

        $town->save();
    }
}
