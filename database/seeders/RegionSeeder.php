<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
            "name" => "Ilpe Adresse",
            "name_fr" => "Ilpe Adresse",
            "description" => "Ilpe Adresse",
            "status" => 1,
            "city_id" => 1,
            "state_id" => 1

        ]);
        //
    }
}
