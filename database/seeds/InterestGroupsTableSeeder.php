<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('interest_groups')->insert([

            [
              'title' => 'Trade & Business',
              'group_code' => '3442',
              'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'status' => '10'
            ],


            [
              'title' => 'Sustainability',
              'group_code' => '3434',
              'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'status' => '10'
            ],


            [
              'title' => 'Fashion & Retail',
              'group_code' => 'es',
              'descr' => 'At vero eos et accusamus et iusto odio dignissimos  asdf ducimus qui blanditiis',
              'status' => '10'
            ],

            

        ]);

    }
}
