<?php



/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(App\User::class, function (Faker\Generator $faker)
{
    return [
        'email'          => $faker->email,
        'password'       => 'test',
        'password_confirmation' => 'test',
        'confirmation_code'     => md5(uniqid(mt_rand(), true)),
        'confirmed'             => 1
       # 'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'admin', function (Faker\Generator $faker) use ($factory)
{
    $user = $factory->raw(App\User::class);
    $user[ 'email' ]    = 'admin-' . $faker->numberBetween(0, 9).'@radic.nl';
    return $user;
});

$factory->defineAs(App\User::class, 'radic', function (Faker\Generator $faker) use ($factory)
{
    $user               = $factory->raw(App\User::class, [ ], 'admin');
    $user[ 'email' ]    = 'robin@radic.nl';
    return $user;
});


$factory->define(App\Permission::class,  function(Faker\Generator $faker) use ($factory){

});
$factory->defineAs(App\Permission::class, 'default', function(Faker\Generator $faker) use ($factory){

});

$factory->defineAs(App\Role::class, 'random', function(Faker\Generator $faker) use ($factory){

});
