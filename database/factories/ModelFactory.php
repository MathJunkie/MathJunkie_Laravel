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
    $idScript = random_int(\DB::table('block')->min('id'), \DB::table('block')->max('id'));
    if ($i == 1) {
        $idScript = random_int(\DB::table('scripts')->min('id'), \DB::table('scripts')->max('id'));
    }
    return [
       'owner' => factory(App\User::class)->create()->email,
       'text' => $faker->realText(),
       'idScript' => $idScript,
       'isScript' => $i,
   ];

});

$factory->define(App\Block::class, function (Faker\Generator $faker) {
    return [
        'owner' => factory(App\User::class)->create()->email,
        'name' => $faker->unique()->word(),
        'category' => $faker->word(),
        'description' => $faker->realText(100),
    ];
});

$factory->define(App\Script::class, function (Faker\Generator $faker) {
    return [
        'owner' => factory(App\User::class)->create()->email,
        'name' => $faker->unique()->word(),
        'description' => $faker->realText(100),
    ];
});
