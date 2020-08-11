<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProfileSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('profile_settings')->insert([
            [
              'table_name' => 'CoverPic',
              'description' => 'cover picture public',
              'status' => '10',
            ],
            [
              'table_name' => 'Feed',
              'description' => 'Feed is public',
              'status' => '10',
            ],
            [
              'table_name' => 'Friend',
              'description' => 'Friend is public',
              'status' => '10',
            ],
            [
              'table_name' => 'Info',
              'description' => 'Information is public',
              'status' => '10',
            ],
            [
              'table_name' => 'Jobs',
              'description' => 'Jobs is public',
              'status' => '10',
            ],
          
            [
              'table_name' => 'Portfolio',
              'description' => 'Portfolio is public',
              'status' => '10',
            ],
            [
              'table_name' => 'Profession',
              'description' => 'profession is public',
              'status' => '10',
            ],
            [
              'table_name' => 'ProfilePic',
              'description' => 'Profile Picture public',
              'status' => '10',
            ],
            [
              'table_name' => 'Reviews',
              'description' => 'Reviews is public',
              'status' => '10',
            ],
            [
              'table_name' => 'Solial Link',
              'description' => 'Social Link in only Friend',
              'status' => '10',
            ],           
        ]);
    }
}