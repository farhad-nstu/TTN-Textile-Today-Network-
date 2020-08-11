<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTypesTableSeeder extends Seeder
{
   /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run()
      {

          DB::table('job_types')->insert([

              [
                'title' => 'Full Time',
                'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                'status' => '10'
              ],


              [
                'title' => 'Part Time',
                'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                'status' => '0'
              ],

              [
                'title' => 'Remote',
                'descr' => 'At vero eos et accusamus et iusto odio dignissimos  asdf ducimus qui blanditiis',
                'status' => '10'
              ],

              

          ]);

      }
}
