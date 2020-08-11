<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([

            [
            'country_id' => '1',
            'state_id' => '1',
            'name' => 'Farmgate'
            ],
            [
            'country_id' => '1',
            'state_id' => '1',
            'name' => 'Uttora',
            ],
            [
            'country_id' => '1',
            'state_id' => '4',
            'name' => 'Chapai Nawabganj',
            ],
            [
            'country_id' => '1',
            'state_id' => '4',
            'name' => 'Nator',
            ],
            [
            'country_id' => '1',
            'state_id' => '4',
            'name' => 'Pabna',
            ],           
        ]);
    }
}
