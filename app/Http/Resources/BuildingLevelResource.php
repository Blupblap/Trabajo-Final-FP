<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class BuildingLevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "building_level_id" => $this->id,
            "building_id" => $this->building_id,
            "name" => $this->whenLoaded('building', function () {
                return $this->building->name;
            }),
            "level" => $this->level,
            "food_per_minute" => $this->food_per_minute,
            "wood_per_minute" => $this->wood_per_minute,
            "stone_per_minute" => $this->stone_per_minute,
            "gold_per_minute" => $this->gold_per_minute,
            "required_food" => $this->required_food,
            "required_wood" => $this->required_wood,
            "required_stone" => $this->required_stone,
            "required_gold" => $this->required_gold,
            "level_town_hall" => $this->level_town_hall,
            "power" => $this->power,
            "sprite" => $this->sprite,
            "upgrade_duration" => $this->upgrade_duration,
            "upgrade_time_left" => isset($this->pivot->upgrade_time) ? now()->diffInSeconds(Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->upgrade_time)->addMinutes($this->upgrade_duration)) : 0,
            "has_next" => !is_null($this->getNext()),
        ];
    }
}
