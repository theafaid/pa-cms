<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $name = $faker->sentence;
    return [
        'name' => $name,
        'slug' => \Illuminate\Support\Str::slug($name),
        'creator_id' => function(){
            return \App\User::all()->random()->id;
        }
    ];
});
