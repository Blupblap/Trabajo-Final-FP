<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'town';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'name' => 'NoName',
        'wood' => 100,
        'stone' => 100
    ];

    protected $fillable = [
        'name'
    ];

    /**
     * The building_levels that belong to the town.
     */
    public function buildingLevels()
    {
        return $this->belongsToMany(BuildingLevel::class, 'town_building_level');
    }
}
