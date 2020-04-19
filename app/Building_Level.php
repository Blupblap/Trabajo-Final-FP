<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building_Level extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'building_level';

    /**
     * Get the building that owns the building_level.
     */
    public function building() {
        return $this->belongsTo('App\Building');
    }

    /**
     * Get the towns that belong to the building_level.
     */
    public function towns() {
        return $this->belongsToMany('App\Town', 'town_building_level');
    }

}
