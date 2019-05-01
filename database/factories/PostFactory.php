<<<<<<< HEAD
<?php

use Faker\Generator as Faker;
use App\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_title' => $faker->realText(100),
        'post_detail' => $faker->realText(200),
        'post_tag' => $faker->randomElement(['free', 'sale']),
        // 'hidden_status' => true
        'hidden_status' => $faker->boolean()
    ];
});
=======
<?php

use Faker\Generator as Faker;
use App\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_title' => $faker->realText(100),
        'post_detail' => $faker->realText(200),
        'post_tag' => $faker->randomElement(['free', 'sale']),
        // 'hidden_status' => true
        'hidden_status' => $faker->boolean()
    ];
});
>>>>>>> 08742661ee61e2e95f5f69d499da22a0526c1500
