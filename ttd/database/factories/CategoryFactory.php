<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slug' => \Illuminate\Support\Str::slug($name)
    ];
});
