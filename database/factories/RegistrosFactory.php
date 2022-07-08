<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Registros;
use Faker\Generator as Faker;

$factory->define(Registros::class, function (Faker $faker) {
    return [
        'nombre' => $faker -> name,
        'celular' => $faker -> phoneNumber,
        'correo' => $faker -> email,
        'linea_fletera' => $faker -> locale
    ];
});