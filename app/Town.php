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
        return $this->belongsToMany(BuildingLevel::class, 'town_building_level')->withPivot('update_time');
    }
}
