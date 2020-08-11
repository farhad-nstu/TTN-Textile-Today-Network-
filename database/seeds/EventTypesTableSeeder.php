<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('event_types')->insert([
            [
              'title' => 'Exhibition',
              'type_code' => 'ex',
              'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'status' => '10'
            ],

            [
              'title' => 'Fair',
              'type_code' => 'fair',
              'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
              'status' => '0'
            ],

            [
              'title' => 'Seminar',
              'type_code' => 'es',
              'descr' => 'At vero eos et accusamus et iusto odio dignissimos  asdf ducimus qui blanditiis',
              'status' => '10'
            ],
        ]);

    }
}
