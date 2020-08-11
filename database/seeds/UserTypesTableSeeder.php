<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([

           [
             'title' => 'Subscriber',
		         'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis'
           ],


           [
             'title' => 'Corporate Member',
		         'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis'
           ],


           [
             'title' => 'Common',
		         'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
           ],  

       ]);
    }
}
