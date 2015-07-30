<?php

use Helpers\Url;
use Helpers\Hooks;
use Helpers\AdminLTE\AdminLTE;
use Helpers\AdminLTE\Assets;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $data['title'] . SITETITLE ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        Assets::addToHeader("css", Url::templatePath() . 'bootstrap/css/bootstrap.min.css');
        //Assets::addToHeader("css", Url::templatePath() . 'plugins/bootstrap-dialog/css/bootstrap-dialog.min.css');       
        Assets::addToHeader("css", Url::templatePath() . 'plugins/font-awesome/css/font-awesome.min.css');
        Assets::addToHeader("css", Url::templatePath() . 'plugins/ionicons/css/ionicons.min.css');
        Assets::addToHeader("css", Url::templatePath() . 'dist/css/AdminLTE.min.css');
        Assets::addToHeader("css", Url::templatePath() . 'dist/css/skins/' . SKIN . '.min.css');
        Assets::addToHeader("css", Url::templatePath() . "plugins/datatables/dataTables.bootstrap.css");
        Assets::addToHeader("css", Url::templatePath() . 'custom.css');

        echo (Assets::renderHeader("css"));

        Assets::addToFooter("js", Url::templatePath() . 'plugins/jQuery/jQuery-2.1.4.min.js');
        Assets::addToFooter("js", Url::templatePath() . 'plugins/jquery-ui/jquery-ui.min.js');
        Assets::addToFooter("js", Url::templatePath() . 'bootstrap/js/bootstrap.min.js');
        //Assets::addToFooter("js", Url::templatePath() . 'plugins/bootstrap-dialog/js/bootstrap-dialog.min.js');     
        Assets::addToFooter("js", Url::templatePath() . 'plugins/bootbox/bootbox.min.js');
        Assets::addToFooter("js", Url::templatePath() . 'plugins/slimScroll/jquery.slimscroll.min.js');
        Assets::addToFooter("js", Url::templatePath() . 'plugins/fastclick/fastclick.min.js');
        Assets::addToFooter("js", Url::templatePath() . 'dist/js/app.min.js');
        Assets::addToFooter("js", Url::templatePath() . 'dist/js/demo.js');
        ?>


    </head>
    <body class="<?= SKIN ?> sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="../../index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>LT</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b>LTE</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <?php
                            if (MESSAGES) {
                                include "messages.php";
                            }
                            ?>
                            <?php
                            if (NOTIFICATIONS) {
                                include "notifications.php";
                            }
                            ?>
                            <?php
                            if (TASKS) {
                                include "tasks.php";
                            }
                            ?>
<?php
if (PROFILE) {
    include "profile.php";
}
?>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
<?php include "sidebar.php" ?>
                <!-- /.sidebar -->
            </aside>

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
<?= $data['title'] ?>
                        <small><?= $data['titleSub'] ?></small>
                    </h1>
<?php
if (PROFILE) {
    include "breadcrumb.php";
}
?>
                </section>

                <!-- Main content -->
                <section class="content">