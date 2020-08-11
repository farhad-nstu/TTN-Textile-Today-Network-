<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('services')->insert([

                   [
                     'title' => 'Jobs',
                     'service_code' => '3d442',
                     'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                     'status' => '10'
                   ],


                   [
                     'title' => 'Classifieds',
                     'service_code' => '34e34',
                     'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                     'status' => '10'
                   ],

                   [
                     'title' => 'Training',
                     'service_code' => '444es',
                     'descr' => 'At vero eos et accusamus et iusto odio dignissimos  asdf ducimus qui blanditiis',
                     'status' => '0'
                   ],

                   

               ]);
    }
}
