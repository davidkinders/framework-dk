<?php
namespace Core;
use Helpers\Session;

class Config
{
    public function __construct()
    {
        //turn on output buffering
        ob_start();
        //site address with ending slash /
        define('DIR', 'http://framework-dk/');

        //set default controller and method for legacy calls
        define('DEFAULT_CONTROLLER', 'welcome');
        define('DEFAULT_METHOD', 'index');

        //set the default template
        define('TEMPLATE', 'default');

        //database details ONLY NEEDED IF USING A DATABASE
        define('DB_TYPE', 'mysql');
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'framework-dk');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('PREFIX', '');

        //set prefix for sessions
        define('SESSION_PREFIX', 'fw_');

        //optionall create a constant for the name of the site
        define('SITETITLE', 'V2.2-dk');

        //optionall set a site email address
        //define('SITEEMAIL', '');

        //turn on custom error handling
        set_exception_handler('Core\Logger::ExceptionHandler');
        set_error_handler('Core\Logger::ErrorHandler');

        //set timezone
        date_default_timezone_set('Europe/Brussels');

        //start sessions
        Session::init();
    }
}