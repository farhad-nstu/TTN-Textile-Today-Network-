<?php
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'role_id' => 10,
        'status' => 10,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2b$10$9SgNcaRZtrDQodlyoiP5HOHsqbElN8LEwMOXKjkfad2A56XsQx0gm', // password
        'remember_token' => Str::random(10),
    ];
});
