<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'building';

    public function buildingLevels()
    {
        return $this->hasMany(BuildingLevel::class);
    }
}
