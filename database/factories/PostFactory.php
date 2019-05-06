<?php

use Faker\Generator as Faker;
use App\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_title' => $faker->realText(100),
        'description' => $faker->realText(100),
        'post_detail' => $faker->realText(200),
        'category' => $faker->randomElement(['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others']),
        'post_tag' => $faker->word(),
        'hidden_status' => false,
        'report_status' => false
    ];
});
