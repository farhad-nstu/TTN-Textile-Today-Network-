<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public function run()
            {

                DB::table('page_categories')->insert([

                    [
                      'title' => 'Product',
                      'status' => '10'
                    ],


                    [
                      'title' => 'Service',
                      'status' => '10'
                    ],

                    [
                      'title' => 'Media',
                      'status' => '0'
                    ],

                    

                ]);

        }
    
}
