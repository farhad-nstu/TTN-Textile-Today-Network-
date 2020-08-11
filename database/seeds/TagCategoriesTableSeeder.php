<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tag_categories')->insert([

                           [
                             'title' => 'Fashion'
                           ],


                           [
                             'title' => 'Fabric'
                           ],

                           [
                             'title' => 'RMG'
                           ],

                           

                       ]);
    }
}
