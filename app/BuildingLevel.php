<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingLevel extends Model
{
    protected $table = 'building_level';

    public $timestamps = false;

    protected $casts = [
        'building_id' => 'integer',
        'level' => 'integer'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function towns()
    {
        return $this->belongsToMany(Town::class, 'town_building_level');
    }

    public function scopeUpdatesResources($query)
    {
        return $query
            ->where(function ($query) {
                $query->orWhereNotNull('food_per_minute');
                $query->orWhereNotNull('wood_per_minute');
                $query->orWhereNotNull('stone_per_minute');
                $query->orWhereNotNull('gold_per_minute');
            });
    }

    public function getNext()
    {
        return $this->newQuery()
            ->whereBuildingId($this->building_id)
            ->whereLevel($this->level + 1)
            ->first();
    }
}
