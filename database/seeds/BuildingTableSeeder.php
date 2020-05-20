<?php

use App\Building;
use Illuminate\Database\Seeder;

class BuildingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Building::insert([
            ['name' => 'Woodsman Hut',],
            ['name' => 'Mine'],
            ['name' => 'Fishing dock'],
            ['name' => 'Farm'],
            ['name' => 'Alchemist'],
            ['name' => 'Merchant'],
            ['name' => 'Town hall']
        ]);
    }
}
