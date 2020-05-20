<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'building';

    public $timestamps = false;

    public const TOWNHALL = 7;

    public function buildingLevels()
    {
        return $this->hasMany(BuildingLevel::class);
    }
}
