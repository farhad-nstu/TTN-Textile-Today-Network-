<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// password: *ttn-super-admin#2020
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
     {
         DB::table('users')->insert([
                   [
                     'role_id' => '1',
                     'name' => 'Super Admin',
                     'email' => 'admin@gmail.com',
                     'password' => '$2y$12$juFyOLk5tMm.4e/MXvsX..Lub4.MkAlEd0lg50jBzOzKjWnsGW5Ea',
                     'status' => '10',
                     'created_at' => now(),
                     'updated_at' => now()
                   ],

                   [
                     'role_id' => '10',
                     'name' => 'Riasad Rion',
                     'email' => 'mdrsdrion@gmail.com',
                     'password' => '$2y$12$juFyOLk5tMm.4e/MXvsX..Lub4.MkAlEd0lg50jBzOzKjWnsGW5Ea',
                     'status' => '10',
                     'created_at' => now(),
                     'updated_at' => now()

                   ],

                   [
                     'role_id' => '10',
                     'name' => 'Farhad',
                     'email' => 'farhad@gmail.com',
                     'password' => '$2y$12$juFyOLk5tMm.4e/MXvsX..Lub4.MkAlEd0lg50jBzOzKjWnsGW5Ea',
                     'status' => '10',
                     'created_at' => now(),
                     'updated_at' => now()

                   ],

                   [
                     'role_id' => '10',
                     'name' => 'Md. Ismail',
                     'email' => 'Ismail@gmail.com',
                     'password' => '$2y$12$juFyOLk5tMm.4e/MXvsX..Lub4.MkAlEd0lg50jBzOzKjWnsGW5Ea',
                     'status' => '10',
                     'created_at' => now(),
                     'updated_at' => now()
                   ]

               ]);
               factory(App\Models\User::class, 10)->create();
     }
}
