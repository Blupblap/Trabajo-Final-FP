<?php

namespace App\Listeners;

use App\BuildingLevel;
use Illuminate\Auth\Events\Registered;

class CreateTownOnUserRegistered
{
    public function handle(Registered $event)
    {
        $town = $event->user->town()->create();
        $buildingLevelIds = BuildingLevel::whereLevel(0)->pluck('id');
        $town->buildingLevels()->attach(
            $buildingLevelIds->mapWithKeys(function ($id) {
                return [$id => ['upgrade_time' => null]];
            })->toArray()
        );
    }
}
