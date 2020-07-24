<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'email' => $faker->unique()->safeEmail,
        'address'=>$faker->address,
        'phone'=>$faker->randomElement(['090909009', '0808080808', '0707070707']),
    ];
});

