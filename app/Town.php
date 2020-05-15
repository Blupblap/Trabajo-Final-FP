<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{

    protected $table = 'town';

    public $timestamps = false;

    protected $attributes = [
        'name' => 'NoName',
        'food' => 0,
        'wood' => 100,
        'stone' => 100,
        'gold' => 0
    ];

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'last_checked' => 'datetime'
    ];

    public function buildingLevels()
    {
        return $this->belongsToMany(BuildingLevel::class, 'town_building_level')->withPivot('upgrade_time');
    }

    public function addResources(int $time, BuildingLevel $buildingLevel)
    {
        $this->food += $time * $buildingLevel->food_per_minute;
        $this->wood += $time * $buildingLevel->wood_per_minute;
        $this->stone += $time * $buildingLevel->stone_per_minute;
        $this->gold += $time * $buildingLevel->gold_per_minute;
    }

    public function startBuildingUpgrade(BuildingLevel $buildingLevel, $time)
    {
        $this->buildingLevels()->updateExistingPivot($buildingLevel->getKey(), ['upgrade_time' => $time]);

        $this->food -= $buildingLevel->required_food;
        $this->wood -= $buildingLevel->required_wood;
        $this->stone -= $buildingLevel->required_stone;
        $this->gold -= $buildingLevel->required_gold;
    }

    public function enoughResources(BuildingLevel $buildingLevel)
    {
        return $this->food >= $buildingLevel->required_food
            && $this->wood >= $buildingLevel->required_wood
            && $this->stone >= $buildingLevel->required_stone
            && $this->gold >= $buildingLevel->required_gold;
    }
}
