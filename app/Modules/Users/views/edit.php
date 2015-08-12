<?php

use Helpers\phpforms\Form;
use Helpers\phpforms\Validator\Validator;
use Helpers\AdminLTE\Box;

$db = \Helpers\Database::get();
$user = $db->select("SELECT * FROM rbac_users WHERE id = $data[userId] LIMIT 1");


$form = new Form('edit-user', 'horizontal', 'novalidate=true');
$options = array(
    'horizontalLabelCol' => '',
    'horizontalOffsetCol' => '',
    'horizontalElementCol' => 'col-xs-12',
);
$form->setOptions($options);
$form->setAction($_SERVER['REQUEST_URI'], [$add_get_vars = true]);
// username
$form->setOptions(array('horizontalElementCol' => 'col-xs-12'));
$form->addInputWrapper('<div class="input-group"></div>', 'username');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>', 'username', 'before');
$form->addInput('text', 'username', $user[0]->username, '', 'required=required, placeholder=Email*');
// surname, givenname
$form->setOptions(array('horizontalElementCol' => 'col-xs-6'));
$form->groupInputs('surname', 'givenname');

$form->addInput('text', 'surname', $user[0]->surname, '', 'required=required, placeholder=Surname*');
$form->addInput('text', 'givenname', $user[0]->givenname, '', 'placeholder=Givenname');
// email
$form->setOptions(array('horizontalElementCol' => 'col-xs-12'));
$form->addInputWrapper('<div class="input-group"></div>', 'email');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>', 'email', 'before');
$form->addInput('email', 'email', $user[0]->email, '', 'required=required, placeholder=Email*');
// button
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

