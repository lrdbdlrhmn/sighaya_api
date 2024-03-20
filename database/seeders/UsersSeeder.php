<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insert([
            "first_name" => "ali",
            "last_name" => "mohamed",
            "nni" => 1234567,
            "phone" => 43567899,
            "user_type" => "user",
            "email" => "ali_m@gmail.com",
            "whatsapp" => "45679015",
            "password" => Hash::make('1234'),
            "city_id" => 1,
            "state_id" => 1,
            "region_id" => 2
        ]);

    }
}
