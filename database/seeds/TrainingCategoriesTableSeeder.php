<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('training_categories')->insert([

                           [
                             'title' => 'SSD',
          					 'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                             'status'=>'10'
                           ],


                           [
                             'title' => 'FSD',
          					 'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                             'status'=>'10'
                           ],

                           [
                             'title' => 'SMS',
          					 'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                             'status'=>'0'
                           ],

                           

                       ]);
    }
}
