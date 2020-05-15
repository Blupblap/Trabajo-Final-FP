<?php

namespace App\Actions;

use App\Building;
use App\Exceptions\NotEnoughResourcesException;
use App\Exceptions\TownHallLevelException;
use App\Town;
use Carbon\Carbon;

final class StartBuildingUpgrade
{
    private $upgradeTownResources;

    public function __construct(UpdateTownResources $upgradeTownResources)
    {
        $this->upgradeTownResources = $upgradeTownResources;
    }

    public function __invoke(Town $town, int $id, Carbon $now)
    {
        $this->upgradeTownResources->__invoke($town, $now);

        $buildingLevel = $town->buildingLevels()->whereBuildingLevelId($id)->first();

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
