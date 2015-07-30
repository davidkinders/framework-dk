<?php

namespace Controllers;

use Core\View;
use Core\Controller;
use Core\Rbac;
use Helpers\Url;
use Helpers\Session;
use Helpers\AdminLTE\Assets;

class ProfileController extends Controller {

    /**
     * Call the parent construct
     */
    public function __construct() {
        parent::__construct();
    }

    public function login() {
        if (isset($_POST['username']) AND isset($_POST['password'])) {
            $username = trim(strtolower($_POST['username']));
            $password = trim($_POST['password']);

            if (Rbac::login($username, $password) == false) {
                Assets::setError("username or password incorrect!");
            } else {
                // cookie zetten
                if (!isset($_POST["rememberme"])) {
                    setcookie("username", "");
                } else {
                    setcookie("username", $username);
                }

                Url::redirect("");
            }
        }

        $data['title'] = "Login - SMVCdk";
        $data['login_text'] = "Sign in to start your session.";

        View::renderTemplate('login', [$data, $error]);
    }

    public function logoff() {
        Session::destroy();
        Url::redirect("/login");
    }

}
