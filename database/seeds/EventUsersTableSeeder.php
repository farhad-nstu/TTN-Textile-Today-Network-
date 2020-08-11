<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_user')->insert([
            [
                'event_id' => '2',
                'user_id' => '1',
                'is_mentor' => '0',
                'is_creator' => '1',
              ],
              [
                'event_id' => '3',
                'user_id' => '2',
                'is_mentor' => '0',
                'is_creator' => '1',
              ],
              [
                'event_id' => '4',
                'user_id' => '2',
                'is_mentor' => '1',
                'is_creator' => '1',
              ],
              [
                'event_id' => '5',
                'user_id' => '1',
                'is_mentor' => '0',
                'is_creator' => '1',
              ],
              [
                'event_id' => '1',
                'user_id' => '7',
                'is_mentor' => '1',
                'is_creator' => '1',
              ],
              [
                'event_id' => '10',
                'user_id' => '10',
                'is_mentor' => '1',
                'is_creator' => '1',
              ],
        ]);
    }
}
