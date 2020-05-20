<?php

use App\BuildingLevel;
use Illuminate\Database\Seeder;

class BuildingLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertWoodsmanHutLevels();
        $this->insertMineLevels();
        $this->insertFishingDockLevels();
        $this->insertFarmLevels();
        $this->insertAlchemistLevels();
        $this->insertMerchantLevels();
        $this->insertTownHallLevels();
    }

    private function insertWoodsmanHutLevels()
    {
        BuildingLevel::insert([
            [
                'building_id' => 1,
                'level' => 0,
                'food_per_minute' => 0,
                'wood_per_minute' => 0,
                'stone_per_minute' => 0,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 100,
                'required_stone' => 0,
                'required_gold' => 0,
                'level_town_hall' => 0,
                'power' => 0,
                'sprite' => null,
                'upgrade_duration' => 1,
            ],
            [
                'building_id' => 1,
                'level' => 1,
                'food_per_minute' => 1,
                'wood_per_minute' => 0,
                'stone_per_minute' => 0,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 150,
                'required_stone' => 100,
                'required_gold' => 0,
                'level_town_hall' => 1,
                'power' => 10,
                'sprite' => 'woodsmanhut_1.png',
                'upgrade_duration' => 10,
            ]
        ]);
    }

    private function insertMineLevels()
    {
        BuildingLevel::insert([
            [
                'building_id' => 2,
                'level' => 0,
                'food_per_minute' => 0,
                'wood_per_minute' => 0,
                'stone_per_minute' => 0,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 50,
                'required_stone' => 100,
                'required_gold' => 0,
                'level_town_hall' => 0,
                'power' => 0,
                'sprite' => null,
                'upgrade_duration' => 1,
            ],
            [
                'building_id' => 2,
                'level' => 1,
                'food_per_minute' => 0,
                'wood_per_minute' => 0,
                'stone_per_minute' => 1,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 100,
                'required_stone' => 150,
                'required_gold' => 0,
                'level_town_hall' => 1,
                'power' => 10,
                'sprite' => 'mine_1.png',
                'upgrade_duration' => 10,
            ]
        ]);
    }

    private function insertFishingDockLevels()
    {
        BuildingLevel::insert([
            [
                'building_id' => 3,
                'level' => 0,
                'food_per_minute' => 0,
                'wood_per_minute' => 0,
                'stone_per_minute' => 0,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 200,
                'required_stone' => 100,
                'required_gold' => 0,
                'level_town_hall' => 0,
                'power' => 0,
                'sprite' => null,
                'upgrade_duration' => 1,
            ],
            [
                'building_id' => 3,
                'level' => 1,
                'food_per_minute' => 1,
                'wood_per_minute' => 0,
                'stone_per_minute' => 1,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 100,
                'required_stone' => 150,
                'required_gold' => 0,
                'level_town_hall' => 1,
                'power' => 10,
                'sprite' => 'fishingdock_1.png',
                'upgrade_duration' => 10,
            ]
        ]);
    }

    private function insertFarmLevels()
    {
        BuildingLevel::insert([
            [
                'building_id' => 4,
                'level' => 0,
                'food_per_minute' => 0,
                'wood_per_minute' => 0,
                'stone_per_minute' => 0,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 200,
                'required_stone' => 100,
                'required_gold' => 0,
                'level_town_hall' => 0,
                'power' => 0,
                'sprite' => null,
                'upgrade_duration' => 1,
            ],
            [
                'building_id' => 4,
                'level' => 1,
                'food_per_minute' => 1,
                'wood_per_minute' => 0,
                'stone_per_minute' => 1,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 100,
                'required_stone' => 150,
                'required_gold' => 0,
                'level_town_hall' => 1,
                'power' => 10,
                'sprite' => 'farm_1.png',
                'upgrade_duration' => 10,
            ]
        ]);
    }

    private function insertAlchemistLevels()
    {
        BuildingLevel::insert([
            [
                'building_id' => 5,
                'level' => 0,
                'food_per_minute' => 0,
                'wood_per_minute' => 0,
                'stone_per_minute' => 0,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 200,
                'required_stone' => 100,
                'required_gold' => 0,
                'level_town_hall' => 0,
                'power' => 0,
                'sprite' => null,
                'upgrade_duration' => 1,
            ],
            [
                'building_id' => 5,
                'level' => 1,
                'food_per_minute' => 1,
                'wood_per_minute' => 0,
                'stone_per_minute' => 1,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 100,
                'required_stone' => 150,
                'required_gold' => 0,
                'level_town_hall' => 1,
                'power' => 10,
                'sprite' => 'alchemist_1.png',
                'upgrade_duration' => 10,
            ]
        ]);
    }

    private function insertMerchantLevels()
    {
        BuildingLevel::insert([
            [
                'building_id' => 6,
                'level' => 0,
                'food_per_minute' => 0,
                'wood_per_minute' => 0,
                'stone_per_minute' => 0,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 200,
                'required_stone' => 100,
                'required_gold' => 0,
                'level_town_hall' => 0,
                'power' => 0,
                'sprite' => null,
                'upgrade_duration' => 1,
            ],
            [
                'building_id' => 6,
                'level' => 1,
                'food_per_minute' => 1,
                'wood_per_minute' => 0,
                'stone_per_minute' => 1,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 100,
                'required_stone' => 150,
                'required_gold' => 0,
                'level_town_hall' => 1,
                'power' => 10,
                'sprite' => 'merchant_1.png',
                'upgrade_duration' => 10,
            ]
        ]);
    }

    private function insertTownHallLevels()
    {
        BuildingLevel::insert([
            [
                'building_id' => 7,
                'level' => 0,
                'food_per_minute' => 0,
                'wood_per_minute' => 0,
                'stone_per_minute' => 0,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 200,
                'required_stone' => 100,
                'required_gold' => 0,
                'level_town_hall' => 0,
                'power' => 0,
                'sprite' => null,
                'upgrade_duration' => 1,
            ],
            [
                'building_id' => 7,
                'level' => 1,
                'food_per_minute' => 1,
                'wood_per_minute' => 0,
                'stone_per_minute' => 1,
                'gold_per_minute' => 0,
                'required_food' => 0,
                'required_wood' => 100,
                'required_stone' => 150,
                'required_gold' => 0,
                'level_town_hall' => 1,
                'power' => 10,
                'sprite' => 'townhall_1.png',
                'upgrade_duration' => 10,
            ]
        ]);
    }
}
