<?php
namespace Core;
use Core\View;
/*
 * controller - base controller
 *
 * @author David Carr - dave@simplemvcframework.com
 * @version 2.2
 * @date June 27, 2014
 * @date updated May 18 2015
 */

abstract class Controller
{
    /**
     * view variable to use the view class
     * @var string
     */
    public $view;
    public $rbac;

    /**
     * on run make an instance of the config class and view class
     */
    public function __construct()
    {
        $this->view = new View();
    }
}
