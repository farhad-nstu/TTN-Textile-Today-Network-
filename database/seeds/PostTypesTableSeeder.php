<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
               * Run the database seeds.
               *
               * @return void
               */

                  DB::table('post_types')->insert([

                      [
                        'title' => 'Free',
                        'type_code' => '231',
                        'status' => '10'
                      ],


                      [
                        'title' => 'Premium',
                        'type_code' => '2341',
                        'status' => '10'
                      ],

                      [
                        'title' => 'Editors Choice',
                        'type_code' => '23421',
                        'status' => '10'
                      ],

                      

                  ]);

              
    }
}
