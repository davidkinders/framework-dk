<?php

use Core\Rbac;
use Helpers\AdminLTE\Sitebar;
?>

<div class="main-sidebar">
    <!-- Inner sidebar -->
    <div class="sidebar">
        <!-- Search Form (Optional) -->
<?php
if (SEARCHBOX){include "searchbox.php";};
?>
        <ul class="sidebar-menu">
            <?php
            $menuItems = Sitebar::getMenuItems();
            foreach ($menuItems as $menuItem) {

                if ($menuItem['items'] == null) {
                    if (Rbac::canUser($menuItem['rbac']) OR $menuItem['rbac'] == '(rol)everyone') {
                        if ($_SERVER['REQUEST_URI'] == $menuItem['link']) {
                            $active = "active";
                        } else {
                            $active = "";
                        };
                        echo "<li class=\"$active\"><a href=\"$menuItem[link]\"><i class=\"fa $menuItem[icon]\"></i><span>$menuItem[caption]</span></a></li>";
                    }
                } else {
                    $currentLink = explode("/", $_SERVER['REQUEST_URI']);
                    
                    if ("/".$currentLink[1] == $menuItem['link']) {
                        $active = "active";
                    } else {
                        $active = "";
                    };
                    if (Rbac::canUser($menuItem['rbac']) OR $menuItem['rbac'] == '(rol)everyone') {
                        echo "<li class=\"treeview $active\">";
                        echo "<a href=\"#\"><i class=\"fa $menuItem[icon]\"></i><span>$menuItem[caption]</span> <i class=\"fa fa-angle-left pull-right\"></i></a>";
                        echo "<ul class=\"treeview-menu\">";
                        subItems($menuItem['items']);
                        echo "</ul>";
                        echo "</li>";
                    }
                }
            }

            function subItems($menuSubItems) {
                foreach ($menuSubItems as $menuSubItem) {
                    if ($_SERVER['REQUEST_URI'] == $menuSubItem['link']) {
                        $active = "active";
                    } else {
                        $active = "";
                    };
                    if (Rbac::canUser($menuSubItem['rbac']) OR $menuSubItem['rbac'] == '(rol)everyone') {
                        echo "<li class=\"$active\"><a href=\"$menuSubItem[link]\"><i class=\"fa $menuSubItem[icon]\"></i><span>$menuSubItem[caption]</span></a></li>";
                    }
                }
            }

//class=\"active\"
            ?>
        </ul>
    </div>
</div>

