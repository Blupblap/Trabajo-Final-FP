<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model {

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
        'food' => 100,
        'wood' => 100,
        'stone' => 100,
        'gold' => 100,
    ];
    
    /**
     * The building_levels that belong to the town.
     */
    public function building_levels()
    {
        return $this->belongsToMany('App\Building_Level', 'town_building_level');
    }
}
