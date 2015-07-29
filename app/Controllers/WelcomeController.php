<?php
namespace Controllers;

use Core\View;
use Core\Controller;
use Core\Rbac;
use Helpers\AdminLTE\Sitebar;
/*
 * Welcome controller
 *
 * @author David Carr - dave@simplemvcframework.com
 * @version 2.2
 * @date June 27, 2014
 * @date updated May 18 2015
 */
class WelcomeController extends Controller
{

    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Define Index page title and load template files
     */
    public function index()
    {
        $data['title'] = "Welcome";
        $data['welcome_message'] = "The framework dashboard";

        $data["dev"] = Sitebar::getMenuItems();
        
        View::renderTemplate('header', $data);
        View::render('welcome/welcome', $data);
        View::renderTemplate('footer', $data);
    }

    /**
     * Define Subpage page title and load template files
     */
    public function subPage()
    {
        $data['title'] = "Welcome";
        $data['welcome_message'] = "Subpage";

        View::renderTemplate('header', $data);
        View::render('welcome/subpage', $data);
        View::renderTemplate('footer', $data);
    }
}
