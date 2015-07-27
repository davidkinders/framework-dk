<?php
namespace Helpers\AdminLTE;

class Config extends AdminLTE {
    public function __construct()
    {
        // Modules
        define('MESSAGES', TRUE);
        define('TASKS', TRUE);
        define('NOTIFICATIONS', TRUE);
        
        // LAYOUT
        //define('SKIN', 'skin-blue');     
        define('SKIN', 'skin-blue-light');     
        //define('SKIN', 'skin-yellow');     
        //define('SKIN', 'skin-yellow-light');     
        //define('SKIN', 'skin-green');    
        //define('SKIN', 'skin-green-light');    
        //define('SKIN', 'skin-purple');     
        //define('SKIN', 'skin-purple-light');     
        //define('SKIN', 'skin-red');     
        //define('SKIN', 'skin-red-light');     
        //define('SKIN', 'skin-black');     
        //define('SKIN', 'skin-black-light');
        
        define('SIDEBAR-COLLAPSED', FALSE);
        
                    
    }    


}
