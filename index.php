<?php
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    echo "<h1>Please install via composer.json</h1>";
    echo "<p>Install Composer instructions: <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
    echo "<p>Once composer is installed navigate to the working directory in your terminal/command promt and enter 'composer install'</p>";
    exit;
}

if (!is_readable('app/Core/Config.php')) {
    die('No Config.php found, configure and rename Config.example.php to Config.php in app/Core.');
}

/*
 * ---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 * ---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
define('ENVIRONMENT', 'development');
/*
 * ---------------------------------------------------------------
 * ERROR REPORTING
 * ---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but production will hide them.
 */

if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            error_reporting(E_ALL);
            break;
        case 'production':
            error_reporting(0);
            break;
        default:
            exit('The application environment is not set correctly.');
    }
}

//initiate config
new Core\Config();

//create alias for Router
use Core\Router;
use Core\Rbac;
use Helpers\Hooks;
use Helpers\Url;

if (Rbac::isGuest()) {

    $freePages = ['/login', '/profile/forgot', '/profile/login'];
    if (!in_array($_SERVER['REQUEST_URI'], $freePages)) {
        Url::redirect("login");
    }
    // Profile
    Router::any('login', 'Controllers\ProfileController@login');
    
} else {

    Router::any('', 'Controllers\WelcomeController@index');
    
    Router::any('subpage', 'Controllers\WelcomeController@subPage');

// Samples
    Router::any('samples', 'Controllers\SamplesController@index');
    
    
// profile
   Router::any('logoff', 'Controllers\ProfileController@logoff'); 
    
}

//module routes
$hooks = Hooks::get();
$hooks->run('routes');

//if no route found
Router::error('Core\Error@index');

//turn on old style routing
Router::$fallback = false;

//execute matched routes
Router::dispatch();
