<?php

namespace Modules\Users\Controllers;

use Core\Controller;
use Core\View;
use Core\Router;
use Core\Rbac;
use Helpers\AdminLTE\Assets;
use Helpers\phpforms\Validator\Validator;

class Users extends Controller {

    private $MyUsersModel;

    public function __construct() {
        parent::__construct();
        $this->MyUsersModel = new \Modules\Users\Models\Users();
    }

    public function routes() {
        Router::any('admin/users', 'Modules\Users\Controllers\Users@index');
        Router::any('admin/users/detail/(:any)', 'Modules\Users\Controllers\Users@detail');
        Router::any('admin/users/edit/(:any)', 'Modules\Users\Controllers\Users@edit');
    }

    public function index() {
        Assets::addBreadcrumb(["caption" => "Users", "link" => ""]);
        if (Rbac::canUser("(rol)admin")) {
            $data['title'] = 'Users';
            $data['modeldata'] = $this->MyUsersModel->myUsers();
            View::renderTemplate('header', $data);
            View::renderModule('Users/views/index', $data);
            View::renderTemplate('footer', $data);
        } else {
            echo "No access";
        };
    }

    public function detail($id) {
        Assets::addBreadcrumb(["caption" => "Users", "link" => "/admin/users"]);
        Assets::addBreadcrumb(["caption" => "Detail", "link" => ""]);
        if (Rbac::canUser("(rol)admin")) {
            $data['userId'] = $id;
            $data['title'] = 'User detail';
            $data['modeldata'] = $this->MyUsersModel->myUsers();
            View::renderTemplate('header', $data);
            View::renderModule('Users/views/detail', $data);
            View::renderTemplate('footer', $data);
        } else {
            echo "No access";
        };
    }

    public function edit($id) {
        Assets::addBreadcrumb(["caption" => "Users", "link" => "/admin/users"]);
        Assets::addBreadcrumb(["caption" => "Detail", "link" => ""]);
        if (Rbac::canUser("(rol)admin")) {

            // start POST 
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["edit-user"]) {
                $validator = new Validator($_POST);
                $validator->required()->validate('username');
                $validator->required()->validate('email');
                $validator->required()->validate('givenname');
                $validator->required()->validate('surname');
                $validator->email()->validate('email');

                if ($validator->hasErrors()) {
                    // The form has errors
                    $_SESSION['errors']['edit-user'] = $validator->getAllErrors();
                    Assets::setError("The form has some errors!");
                } else {
                    // Good, update the database 
                }
            } // End POST

            $data['userId'] = $id;
            $data['title'] = 'User detail';
            $data['modeldata'] = $this->MyUsersModel->myUsers();
            View::renderTemplate('header', $data);
            View::renderModule('Users/views/edit', $data);
            View::renderTemplate('footer', $data);
        } else {
            echo "No access";
        };
    }

}
