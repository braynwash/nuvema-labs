<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita0ac281e2b26a0e0b4efa3db671f0178
{
    public static $classMap = array (
        'ComposerAutoloaderInita0ac281e2b26a0e0b4efa3db671f0178' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInita0ac281e2b26a0e0b4efa3db671f0178' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Database' => __DIR__ . '/../..' . '/application/database.class.php',
        'DatabaseException' => __DIR__ . '/../..' . '/exceptions/database_exception.class.php',
        'Dispatcher' => __DIR__ . '/../..' . '/application/dispatcher.class.php',
        'DuplicatePokemonException' => __DIR__ . '/../..' . '/exceptions/duplicate_pokemon_exception.class.php',
        'FavoritesSuccess' => __DIR__ . '/../..' . '/views/favorites_success.class.php',
        'FavoritesView' => __DIR__ . '/../..' . '/views/favorites_view.class.php',
        'Home' => __DIR__ . '/../..' . '/views/home.class.php',
        'IndexController' => __DIR__ . '/../..' . '/controllers/index_controller.class.php',
        'Login' => __DIR__ . '/../..' . '/views/login.class.php',
        'MissingDataException' => __DIR__ . '/../..' . '/exceptions/missing_data_exception.class.php',
        'NoResultsFoundException' => __DIR__ . '/../..' . '/exceptions/no_results_found_exception.class.php',
        'PasswordLengthException' => __DIR__ . '/../..' . '/exceptions/password_length_exception.class.php',
        'Pokemon' => __DIR__ . '/../..' . '/models/pokemon.class.php',
        'PokemonAdd' => __DIR__ . '/../..' . '/views/pokemon_create.class.php',
        'PokemonController' => __DIR__ . '/../..' . '/controllers/pokemon_controller.class.php',
        'PokemonDetail' => __DIR__ . '/../..' . '/views/pokemon_details.class.php',
        'PokemonError' => __DIR__ . '/../..' . '/views/pokemon_error.php',
        'PokemonModel' => __DIR__ . '/../..' . '/models/pokemon_model.class.php',
        'PokemonView' => __DIR__ . '/../..' . '/views/pokemon_view.class.php',
        'Register' => __DIR__ . '/../..' . '/views/register.class.php',
        'ResetView' => __DIR__ . '/../..' . '/views/reset_password.class.php',
        'Success' => __DIR__ . '/../..' . '/views/create_success.class.php',
        'TrainerModel' => __DIR__ . '/../..' . '/models/trainer_model.class.php',
        'TrainerSuccess' => __DIR__ . '/../..' . '/views/trainer_success.class.php',
        'TypeException' => __DIR__ . '/../..' . '/exceptions/type_exception.class.php',
        'UserController' => __DIR__ . '/../..' . '/controllers/user_controller.class.php',
        'UserError' => __DIR__ . '/../..' . '/views/user_error.php',
        'VerifyPasswordException' => __DIR__ . '/../..' . '/exceptions/verify_password_exception.class.php',
        'View' => __DIR__ . '/../..' . '/views/index_view.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInita0ac281e2b26a0e0b4efa3db671f0178::$classMap;

        }, null, ClassLoader::class);
    }
}
