<?php

namespace Modules\Menu\Controllers;

use Core\Controller;
use Core\View;
use Core\Router;

class Menu extends Controller
{

	private $MyMenuModel;

	public function __construct()
	{
		parent::__construct();
		$this->MyMenuModel = new \Modules\Menu\Models\Menu();
	}

	public function routes()
	{
		Router::any('admin/menu', 'Modules\Menu\Controllers\Menu@index');
	}

	public function index()
	{
		$data['title'] = 'Menu';
		$data['modeldata'] = $this->MyMenuModel->myMenu();
		View::renderTemplate('header', $data);
		View::renderModule('Menu/views/index', $data);
		View::renderTemplate('footer', $data);
	}
}
