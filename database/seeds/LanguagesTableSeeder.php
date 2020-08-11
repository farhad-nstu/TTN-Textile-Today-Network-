<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesTableSeeder extends Seeder
{
/**
       * Run the database seeds.
       *
       * @return void
       */
      public function run()
      {

          DB::table('languages')->insert([

              [
                'name' => 'Bangla',
                'language_code' => 'BAN',
                'native_name' => 'Bangla',
                'status' => '10'
              ],


              [
               'name' => 'English',
               'language_code' => 'ENG',
               'native_name' => 'English',
               'status' => '10'
              ],

              [
                'name' => 'Arabic',
                'language_code' => 'ARB',
                'native_name' => 'Arabic',
                'status' => '0'
              ],

              

          ]);

      }
}
