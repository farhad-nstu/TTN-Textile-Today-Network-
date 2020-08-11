<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([

                   [
                     'tag_category_id' => '1',
                     'tag' => 'Sustainable Fashion',
                     'status' => '10'
                   ],


                   [
                     'tag_category_id' => '1',
                     'tag' => 'Denim',
                     'status' => '10'
                   ],

                   [
                     'tag_category_id' => '2',
                     'tag' => 'Printing',
                     'status' => '0'
                   ],

                   

               ]);
    }
}
