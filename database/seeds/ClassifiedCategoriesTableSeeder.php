<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassifiedCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('classified_categories')->insert([

            [
              'title' => 'Yarn',
              'descr' => 'aspernatur aut odit aut fugit, sed quia consequuntur magni dolores',
              'status' => '10'

            ],


            [
              'title' => 'Finishing',
              'descr' => 'quasi architecto beatae vitae dicta sunt',
              'status' => '10'
            ],

            [
              'title' => 'Machine Tools',
              'descr' => 'ab sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores',
              'status' => '0'
            ],

            

        ]);

    }
}
