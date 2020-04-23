<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'building';

    /**
     * Get the building levels.
     */
    public function buildingLevels()
    {
        return $this->hasMany(BuildingLevel::class);
    }
}
