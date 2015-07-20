<?php



/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(App\User::class, function (Faker\Generator $faker)
{
    return [
        #'username'           => $faker->name,
        'email'          => $faker->email,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'password'       => Sentinel::getHasher()->hash(str_random(10)),
       # 'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'admin', function (Faker\Generator $faker) use ($factory)
{

    $user = $factory->raw(App\User::class);
   # $user['username'] = 'admin' . $faker->numberBetween(0, 9);
    $user[ 'email' ]    = $faker->numberBetween(0, 9).'@radic.nl';
    $user[ 'password' ] = Sentinel::getHasher()->hash('test');
    return $user;
});

$factory->defineAs(App\User::class, 'radic', function (Faker\Generator $faker) use ($factory)
{
    $user               = $factory->raw(App\User::class, [ ], 'admin');
    #$user[ 'username' ]     = 'radic';
    $user[ 'email' ]    = 'robin@radic.nl';
    $user[ 'password' ] = Sentinel::getHasher()->hash('test');

    return $user;
});
