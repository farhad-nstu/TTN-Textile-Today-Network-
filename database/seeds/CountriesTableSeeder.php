<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([

            [
              'name' => 'Bangladesh',
              'country_code' => 'BAN',
              'is_active' => '1'
            ],


            [
                'name' => 'United States',
                'country_code' => 'USA',
                'is_active' => '1'

            ],

            [
                'name' => 'India',
                'country_code' => 'IND',
                'is_active' => '1'
            ],

            

        ]);
    }
}
