<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BuildingLevelResource;

class TownResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'food' => $this->food,
            'wood' => $this->wood,
            'stone' => $this->stone,
            'gold' => $this->gold,
            'buildings' => BuildingLevelResource::collection($this->whenLoaded('buildingLevels'))
        ];
    }
}
