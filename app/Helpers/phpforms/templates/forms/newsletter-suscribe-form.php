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
    $required = array('user-name', 'user-email');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->email()->validate('user-email');

    // check for errors

    if ($validator->hasErrors()) {
        $_SESSION['errors']['newsletter-suscribe-form'] = $validator->getAllErrors();
    } else {

        /* Database insert (disabled for demo) */

        /*require_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpforms/database/db-connect.php';
        require_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpforms/database/Mysql.php';

        $db = new Mysql();
        $insert['ID'] = Mysql::SQLValue('');
        $insert['user_name'] = Mysql::SQLValue($_POST['user-name']);
        $insert['user_email'] = Mysql::SQLValue($_POST['user-email']);
        if (!$db->insertRow('YOUR_TABLE', $insert)) {
            $user_message = '<p class="alert alert-danger">' . $db->error() . '<br>' . $db->getLastSql() . '</p>' . " \n";
        } else {
            $user_message = '<p class="alert alert-success">Thanks for suscribe !</p>' . " \n";
            Form::clear('newsletter-suscribe-form');
        }*/
        Form::clear('newsletter-suscribe-form'); // just for demo ; delete this line if real database recording.
        $user_message = '<p class="alert alert-success">Thanks for suscribe !</p>' . " \n"; // just for demo ; delete this line if real database recording.
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('newsletter-suscribe-form', 'vertical', 'novalidate=true');
$form->startFieldset('Newsletter Suscribe Form');
$form->addHtml('<p>&nbsp;</p><p class="text-success text-center"><em>Subscribe to our Newsletter and receive exclusive offers, updates and news</em></p>');
$form->addHtml('<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">');
$form->addInputWrapper('<div class="input-group"></div>', 'user-name');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>', 'user-name', 'before');
$form->addInput('text', 'user-name', '', '', $attr = 'placeholder=Your Name, required=required');
$form->addInputWrapper('<div class="input-group"></div>', 'user-email');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>', 'user-email', 'before');
$form->addInput('email', 'user-email', '', '', $attr = 'placeholder=Your E-mail, required=required');
$form->addBtn('submit', 'submit-btn', 1, 'Suscribe <i class="fa fa-arrow-right fa-fw"></i>', 'class=btn btn-primary btn-block');
$form->addHtml('</div>');
$form->endFieldset();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newsletter Suscribe Form</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <?php $form->printIncludes('css'); ?>
</head>
<body>
    <h1 class="text-center">Newsletter Suscribe Form</h1>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
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
