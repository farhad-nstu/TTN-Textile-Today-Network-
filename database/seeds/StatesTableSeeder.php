<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([

            [
            'country_id' => '1',
            'name' => 'Dhaka'
            ],

            [
            'country_id' => '1',
            'name' => 'Gazipur'
            ],

            [
            'country_id' => '1',
            'name' => 'Khulna'
            ],

            [
            'country_id' => '1',
            'name' => 'Rajshahi'
            ],
            [
            'country_id' => '2',
            'name' => 'LA'
            ],

            [
            'country_id' => '2',
            'name' => 'New York'
            ],

            [
            'country_id' => '3',
            'name' => 'Delhi'
            ],

            [
            'country_id' => '3',
            'name' => 'Kolkata'
            ]

        ]);
    }
}
