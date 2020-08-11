<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('badges')->insert([

            [
              'title' => 'Copper',
              'color_code' => '#ededed',
              'score_needed' => '20',
              'status' => '0'
            ],


            [
              'title' => 'Gold',
              'color_code' => 'yellow',
              'score_needed' => '50',
              'status' => '10'

            ],

            [
              'title' => 'Platinum',
              'color_code' => 'gray',
              'score_needed' => '80',
              'status' => '10'
            ],

            

        ]);

    }
}
