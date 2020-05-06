<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BuildingLevel extends JsonResource
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
            "required_food" => $this->required_food,
            "required_wood" => $this->required_wood,
            "required_stone" => $this->required_stone,
            "required_gold" => $this->required_gold,
            "level_town_hall" => $this->level_town_hall,
            "power" => $this->power,
            "sprite" => $this->sprite,
            "update_duration" => $this->update_duration,
        ];
    }
}
