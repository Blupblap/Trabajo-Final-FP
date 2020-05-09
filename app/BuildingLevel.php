<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingLevel extends Model
{
    protected $table = 'building_level';

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function towns()
    {
        return $this->belongsToMany(Town::class, 'town_building_level');
    }
}
