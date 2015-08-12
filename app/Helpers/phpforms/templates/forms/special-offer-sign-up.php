<?php
use phpforms\Form;
use phpforms\Validator\Validator;
use phpforms\database\Mysql;

/* =============================================
    start session and include form class
============================================= */

session_start();
include_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpforms/Form.php';

/* =============================================
    validation if posted
============================================= */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/phpforms/Validator/Validator.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/phpforms/Validator/Exception.php';
    $validator = new Validator($_POST);
    $required = array('user-first-name', 'user-name', 'user-email');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->email()->validate('user-email');

    // check for errors

    if ($validator->hasErrors()) {
        $_SESSION['errors']['special-offer-sign-up'] = $validator->getAllErrors();
    } else {

        /* Database insert (disabled for demo) */

        /*require_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpforms/database/db-connect.php';
        require_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpforms/database/Mysql.php';

        $db = new Mysql();
        $insert['ID'] = Mysql::SQLValue('');
        $insert['user_first_name'] = Mysql::SQLValue($_POST['user-first-name']);
        $insert['user_name'] = Mysql::SQLValue($_POST['user-name']);
        $insert['user_email'] = Mysql::SQLValue($_POST['user-email']);
        if (!$db->insertRow('YOUR_TABLE', $insert)) {
            $user_message = '<p class="alert alert-danger">' . $db->error() . '<br>' . $db->getLastSql() . '</p>' . " \n";
        } else {
            $user_message = '<p class="alert alert-success">Thanks for suscribe !</p>' . " \n";
            Form::clear('special-offer-sign-up');
        }*/
        Form::clear('special-offer-sign-up'); // just for demo ; delete this line if real database recording.
        $user_message = '<p class="alert alert-success">Thanks for signing up !</p>' . " \n"; // just for demo ; delete this line if real database recording.
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('special-offer-sign-up', 'vertical', 'novalidate=true');
$form->setOptions(array('elementsWrapper' => ''));
$form->addHtml('<h3>Special Offer Sign Up<br><small>Enter your Name and Email to get Special Deals</small></h3>');
$form->addHtml('<label>Full Name</label>');
$form->addHtml('<div class="row">');
$form->addHtml('<div class="col-xs-6">');
$form->addHtml('<div class="form-group">');
$form->addInputWrapper('<div class="input-group"></div>', 'user-first-name');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>', 'user-first-name', 'before');
$form->addInput('text', 'user-first-name', '', '', 'required=required');
$form->addHtml('<span class="help-block col-xs-6">First Name</span>');
$form->addHtml('</div>'); // form-group
$form->addHtml('</div>'); // col-xs-6
$form->addHtml('<div class="col-xs-6">');
$form->addHtml('<div class="form-group">');
$form->addInput('text', 'user-name', '', '', 'required=required');
$form->addHtml('<span class="help-block col-xs-6">Last Name</span>');
$form->addHtml('</div>'); // form-group
$form->addHtml('</div>'); // col-xs-6
$form->addHtml('</div>'); // row
$form->setOptions(array('elementsWrapper' => '<div class="form-group"></div>'));
$form->addHtml('<label>E-mail</label>');
$form->addInputWrapper('<div class="input-group"></div>', 'user-email');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>', 'user-email', 'before');
$form->addInput('email', 'user-email', '', '', 'required=required');
$form->addBtn('submit', 'submit-btn', 1, 'Sign Up <span class="glyphicon glyphicon-arrow-right append"></span>', 'class=btn btn-primary');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Special Offer Sign Up</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .help-block {
            padding-left: 0;
        }
    </style>
    <?php $form->printIncludes('css'); ?>
</head>
<body>
    <h1 class="text-center">Special Offer Sign Up</h1>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
            <?php
            if (isset($user_message)) {
                echo $user_message;
            }
            ?>
            <?php /* code preview button */
                include_once '../assets/code-preview.php';
            ?>
            <?php
            $form->render();
            ?>
            </div>
        </div>
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <?php
            $form->printIncludes('js');
            $form->printJsCode();
        ?>
    </div>
</body>
</html>
