<?php

use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {

    return [
      'user_id' => 1,
      'nome' => $faker->firstName,
      'descrizione' => $faker->text($maxNbChars = 100),
      'data_creazione' => $faker->dateTimeInInterval($startDate = '-30 years', $interval = '+ 15 years', $timezone = null),
      'indirizzo' => $faker->address,
      'citta' => $faker->country,
      'provincia' => $faker->city,
      'cap' => $faker->numberBetween(11111,99999),
      'cellulare' => $faker->phoneNumber,
      'email' => $faker->unique()->safeEmail
    ];
});
