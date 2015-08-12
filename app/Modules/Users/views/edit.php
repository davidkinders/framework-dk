<?php

use Helpers\phpforms\Form;
use Helpers\phpforms\Validator\Validator;
use Helpers\AdminLTE\Box;

$db = \Helpers\Database::get();
$user = $db->select("SELECT * FROM rbac_users WHERE id = $data[userId] LIMIT 1");


$form = new Form('edit-user', 'vertical', 'novalidate=true');
$options = array(
    'horizontalLabelCol' => '',
    'horizontalOffsetCol' => '',
    'horizontalElementCol' => 'col-xs-12',
);
$form->setOptions($options);
$form->setAction($_SERVER['REQUEST_URI'], [$add_get_vars = true]);

$form->addInput("text", "username", $user[0]->username, "Username", 'required=required');
$form->addInput("text", "surname", $user[0]->surname, "Surname", 'required=required');
$form->addInput("text", "givenname", $user[0]->givenname, "Givename", 'required=required');
$form->addInput("email", "email", $user[0]->email, "Email", 'required=required');
$form->addBtn('submit', 'submit-btn', 1, '<span class="fa fa-floppy-o"></span> Opslaan', 'class=btn btn-success', 'buttons');
$form->printBtnGroup('buttons');

$box = new Box();
$box->title = "Edit";
$box->body = $form->render();
$box->witdh = 4; // min 2 max 12
$box->color = "info";
$box->addTool('<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>');
$box->border = false;
?>
<div class="row">
    <div class="col-md-4"></div>
<?= $box->render(); ?>
</div>

