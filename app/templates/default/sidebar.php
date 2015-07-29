<?php
use Core\Rbac;
use Helpers\AdminLTE\Sitebar;
?>

<div class="main-sidebar">
  <!-- Inner sidebar -->
  <div class="sidebar">
    <!-- Search Form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search..."/>
        <span class="input-group-btn">
          <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form><!-- /.sidebar-form -->
    <ul class="sidebar-menu">
<?php
$menuItems = Sitebar::getMenuItems();
    foreach ($menuItems as $menuItem){

    if ($menuItem['items'] == null)
    {
        if ($_SERVER['REQUEST_URI'] == $menuItem['link']) {$active = "active";}else{$active = "";};
        echo "<li class=\"$active\"><a href=\"$menuItem[link]\"><i class=\"fa $menuItem[icon]\"></i><span>$menuItem[caption]</span></a></li>";    
    }
    else
    {
        if ($_SERVER['REQUEST_URI'] == $menuItem['link']) {$active = "active";}else{$active = "";};
        echo "<li class=\"$active\" class=\"treeview\">";
        echo "<a href=\"#\"><i class=\"fa $menuItem[icon]\"></i><span>Multilevel</span> <i class=\"fa fa-angle-left pull-right\"></i></a>";
        echo "<ul class=\"treeview-menu\">";
        subItems($menuItem['items']);
        echo "</ul>";
        echo "</li>";
    }     
}

function subItems($menuSubItems)
{
    foreach ($menuSubItems as $menuSubItem)
    {
        if ($_SERVER['REQUEST_URI'] == $menuSubItem['link']) {$active = "active";}else{$active = "";};
        echo "<li class=\"$active\"><a href=\"$menuSubItem[link]\"><i class=\"fa $menuSubItem[icon]\"></i><span>$menuSubItem[caption]</span></a></li>";    
    }
}       //class=\"active\"


?>
    </ul>
  </div>
</div>

