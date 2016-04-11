<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Kommentar::class, function (Faker\Generator $faker) {
   $i = rand(0,1);

    if ($i == 1) {
        $scripts_id = random_int(\DB::table('scripts')->min('id'), \DB::table('scripts')->max('id'));
        return [
            'user_id' => factory(App\User::class)->create()->id,
            'text' => $faker->realText(),
            'commentable_id' => $scripts_id,
            'commentable_type' => 'App\Script',
        ];
    }
    else {
        $block_id = random_int(\DB::table('block')->min('id'), \DB::table('block')->max('id'));
        return [
            'user_id' => factory(App\User::class)->create()->id,
            'text' => $faker->realText(),
            'commentable_id' => $block_id,
            'commentable_type' => 'App\Block',
        ];
    }

});

$factory->define(App\Block::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'name' => $faker->unique()->word(),
        'category' => $faker->word(),
        'description' => $faker->realText(100),
    ];
});

$factory->define(App\Script::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'name' => $faker->unique()->word(),
        'description' => $faker->realText(100),
    ];
});
