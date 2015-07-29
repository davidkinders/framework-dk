<?php
namespace Controllers;

use Core\View;
use Core\Controller;
use Core\Rbac;


class SamplesController extends Controller
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

        View::renderTemplate('header', $data);
        View::render('samples/index', $data);
        View::renderTemplate('footer', $data);
    }

}
