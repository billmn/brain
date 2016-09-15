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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Message::class, function (Faker\Generator $faker) {
    return [
        'form_id' => $faker->randomDigitNotNull(),
        'form_name' => $faker->numerify('Form ###'),
        'email' => $faker->safeEmail(),
        'fields' => [
            'name' => [
                'label' => 'Name',
                'input' => $faker->firstName(),
            ],
            'lastname' => [
                'label' => 'Lastname',
                'input' => $faker->lastName(),
            ],
            'age' => [
                'label' => 'Age',
                'input' => $faker->numberBetween(20, 60),
            ],
            'notes' => [
                'label' => 'Notes',
                'input' => $faker->paragraph(),
            ],
        ],
    ];
});
