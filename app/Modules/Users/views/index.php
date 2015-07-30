<?php
use Core\Rbac;
use Helpers\AdminLTE\DataTable;
use Helpers\AdminLTE\Box;

$table = new DataTable("SELECT * FROM rbac_users");
$table->addColumn("username", "Username");
$table->addColumn("surname", "Surname");
$table->addColumn("givenname", "Givenname");
$table->addColumn("email", "Email");
$table->addLink("/admin/users/detail/%parm%", "id", "detail", "fa fa-align-justify", "green", "(rol)admin");
$table->addLink("/admin/users/edit/%parm%", "id", "bewerk", "fa fa-pencil", "blue", "(rol)admin");
$table->dataTable(true);

$box = new Box();
$box->title = "All users";
$box->body = $table->render();
$box->witdh = 8; // min 2 max 12
$box->color = "info";
$box->addTool('<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>');
$box->border = true;
?>

<div class="row">
    <div class="col-md-2"></div>
    <?=$box->render();?>
</div>