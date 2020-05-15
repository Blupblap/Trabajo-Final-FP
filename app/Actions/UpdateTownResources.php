<?php

namespace App\Actions;

use App\Town;
use Carbon\Carbon;

final class UpdateTownResources
{
    public function __invoke(Town $town, Carbon $now)
    {
        // $now = Carbon::createFromFormat('d-m-Y H:i:s', '09-05-2020 18:25:00');

        $timeOffline = $now->diffInMinutes($town->last_checked);

        $buildingLevels = $town->buildingLevels()->updatesSomeResources()->get();

        foreach ($buildingLevels as $buildingLevel) {
            if ($buildingLevel->pivot->upgrade_time === null || $now->diffInMinutes($buildingLevel->pivot->upgrade_time) < $buildingLevel->upgrade_duration) {
                $town->addResources($timeOffline, $buildingLevel);

                continue;
            }

            $timeUntilUpdate = $buildingLevel->upgrade_duration - $town->last_checked->diffInMinutes($buildingLevel->pivot->upgrade_time);
            $town->addResources($timeUntilUpdate, $buildingLevel);

            $nextBuildingLevel = $buildingLevel->getNext();

            $remainingTime = $timeOffline - $timeUntilUpdate;
            $town->addResources($remainingTime, $nextBuildingLevel);

            $town->buildingLevels()->updateExistingPivot(
                $buildingLevel->getKey(),
                [
                    'building_level_id' => $nextBuildingLevel->getKey(),
                    'upgrade_time' => null
                ]
            );
        }

        if ($timeOffline > 0) {
            $town->last_checked = $now;
        }

        $town->save();
    }
}
