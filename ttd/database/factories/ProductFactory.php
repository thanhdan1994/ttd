<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->text(40);
    return [
        'user_id' => rand(1, 2),
        'category_id' => rand(1, 2),
        'name' => $name,
        'slug' => \Illuminate\Support\Str::slug($name),
        'excerpt' => $faker->text(200),
        'phone' => '0982390731',
        'address' => '496 Duong Quang Ham',
        'location' => $faker->longitude . '-' . $faker->latitude,
        'content' => $faker->text(1000)
    ];
});
