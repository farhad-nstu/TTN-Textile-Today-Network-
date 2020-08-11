<?php

use Illuminate\Database\Seeder;

class PoliciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('policies')->insert([

            [
                'user_id' => '1',
                'title' => 'Signup policy',
                'unique_code' => 'signup',
                'descr' => 'This policy describes the information we process to support Facebook, Instagram, Messenger and other products and features offered by Facebook (Facebook Products or Products). You can find additional tools and information in the Facebook Settings and Instagram Settings.',
                'applicable_from' => '2020-02-11 11:20:30',
                'status' => '10'
            ],
            [
                'user_id' => '1',
                'title' => 'Cookie policy',
                'unique_code' => 'cookie',
                'descr' => 'This policy describes the information we process to support Facebook, Instagram, Messenger and other products and features offered by Facebook (Facebook Products or Products). You can find additional tools and information in the Facebook Settings and Instagram Settings.',
                'applicable_from' => '2020-02-11 11:20:30',
                'status' => '10'
            ],
            [
                'user_id' => '1',
                'title' => 'Privacy policy',
                'unique_code' => 'privacy',
                'descr' => 'This policy describes the information we process to support Facebook, Instagram, Messenger and other products and features offered by Facebook (Facebook Products or Products). You can find additional tools and information in the Facebook Settings and Instagram Settings.',
                'applicable_from' => '2020-02-11 11:20:30',
                'status' => '10'
            ],
            [
                'user_id' => '1',
                'title' => 'Page policy',
                'unique_code' => 'pages',
                'descr' => 'This policy describes the information we process to support Facebook, Instagram, Messenger and other products and features offered by Facebook (Facebook Products or Products). You can find additional tools and information in the Facebook Settings and Instagram Settings.',
                'applicable_from' => '2020-02-11 11:20:30',
                'status' => '10'
            ],
            [
                'user_id' => '1',
                'title' => 'Group policy',
                'unique_code' => 'groups',
                'descr' => 'This policy describes the information we process to support Facebook, Instagram, Messenger and other products and features offered by Facebook (Facebook Products or Products). You can find additional tools and information in the Facebook Settings and Instagram Settings.',
                'applicable_from' => '2020-02-11 11:20:30',
                'status' => '10'
            ],                  

        ]);
    }
}
