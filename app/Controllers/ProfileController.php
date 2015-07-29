<?php

namespace Controllers;

use Core\View;
use Core\Controller;
use Core\Rbac;
use Helpers\Url;

class ProfileController extends Controller {

    /**
     * Call the parent construct
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Define Index page title and load template files
     */
    public function login() {
        if (isset($_POST['username']) AND isset($_POST['password'])) {
            $username = trim(strtolower($_POST['username']));
            $password = trim($_POST['password']);

            if (!Rbac::login($username, $password)) {
                $error[] = "username or password incorrect!";
            } else {
                Url::redirect();
            }
        }

        $data['title'] = "Login - SMVCdk";
        $data['login_text'] = "Sign in to start your session.";

        View::renderTemplate('login', $data);

        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
    }

}
