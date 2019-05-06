<?php

use Faker\Generator as Faker;
use App\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        // 'username' => 'Pannakarn PINSRIPETCHKUL',
        'post_title' => $faker->realText(100),
        // 'post_cover' => $faker->imageUrl($width = 640, $height = 480),
        'description' => $faker->realText(100),
        'post_detail' => $faker->realText(200),
        'category' => $faker->randomElement(['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others']),
        'hidden_status' => false,
        'report_status' => false
        // 'hidden_status' => $faker->boolean()
    ];
});
