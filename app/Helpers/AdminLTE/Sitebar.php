<?php

namespace Helpers\AdminLTE;

use Helpers\Password;
use Helpers\Session;

/**
 * David K. version 20150724
 * * */
class Sitebar extends AdminLTE {

    /**
     *
     * @var type 
     */
    private static $db = "";

    /**
     * 
     */
    static function init() {
        self::$db = \Helpers\Database::get();
    }

    public static function getMenuItems($id = null) {
        self::init();
        
        if ($id == NULL)
        {
            $menuItems = self::$db->select('SELECT * FROM menu WHERE sub_id = 0 AND id <> 0 ORDER BY weight');
        }
        else
        {
            $menuItems = self::$db->select("SELECT * FROM menu WHERE sub_id = $id ORDER BY weight"); 
        }
        
        foreach ($menuItems as $menuItem) {
            $count = self::$db->select("SELECT count(*) AS count FROM menu WHERE sub_id = $menuItem->id"); 
            
            // look if the menu had subitems
            if ($count[0]->count <> 0) // it has subitems
            {
                $menu[] = ["caption" => $menuItem->caption, "link" => $menuItem->link, "icon" => $menuItem->icon, 'rbac' => $menuItem->rbac, "items" => self::getMenuItems($menuItem->id)];    
            }
            else // it no has subitems
            {
                $menu[] = ["caption" => $menuItem->caption, "link" => $menuItem->link, "icon" => $menuItem->icon, 'rbac' => $menuItem->rbac, "items" => null];    
            }
        }
        return $menu;    
    }
    
}
