<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('roles')->insert([
        [
          'id' => '1',
          'title' => 'Admin',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis'
        ],


        [
         'id' => '2',
         'title' => 'Manager',
         'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis'
        ],

        [
          'id' => '3',
          'title' => 'User',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis'
        ],

      ]);
    }
}
