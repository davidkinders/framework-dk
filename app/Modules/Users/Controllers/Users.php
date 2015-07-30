<?php

namespace Modules\Users\Controllers;

use Core\Controller;
use Core\View;
use Core\Router;
use Core\Rbac;
use Helpers\AdminLTE\Assets;

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
        Rbac::setPassword("admin","admin");
        
        Assets::addBreadcrumb(["caption" => "Users", "link" => "/admin/users"]);
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

}
