<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{

    protected $table = 'town';

    public $timestamps = false;

    protected $attributes = [
        'name' => 'NoName',
        'wood' => 100,
        'stone' => 100
    ];

    protected $fillable = [
        'name'
    ];

    public function buildingLevels()
    {
        return $this->belongsToMany(BuildingLevel::class, 'town_building_level');
    }
}
