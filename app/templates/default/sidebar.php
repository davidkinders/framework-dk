<?php
use Helpers\AdminLTE\Config;
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

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">HEADER</li>
      <li class="active"><a href="#"><i class="fa fa-circle-o"></i><span>Link</span></a><</li>
      <li><a href="#"><span>Another Link</span></a></li>
      <li class="treeview">
        <a href="#"><span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="#">Link in level 2</a></li>
          <li><a href="#">Link in level 2</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>