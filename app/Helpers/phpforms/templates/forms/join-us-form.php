<?php
use phpforms\Form;
use phpforms\Validator\Validator;

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
        $_SESSION['errors']['join-us-form'] = $validator->getAllErrors();
    } else {
        $from_email = 'contact@codecanyon.creation-site.org';
        $adress = addslashes($_POST['user-email']);
        $subject = 'phpforms - Join Us Form';
        $filter_values = 'join-us-form, submit-btn';
        $sent_message = Form::sendMail($from_email, $adress, $subject, $filter_values);
        Form::clear('join-us-form');
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('join-us-form', 'horizontal', 'novalidate=true');
$options = array(
        'horizontalLabelCol'       => '',
        'horizontalOffsetCol'      => '',
        'horizontalElementCol'     => 'col-xs-12',
);
$form->setOptions($options);
$form->startFieldset('Join Us Form');
$form->addHtml('<h4>Get Free Email Updates!<br><small>Join us for FREE to get instant email updates!</small></h4>');
$form->addInputWrapper('<div class="input-group"></div>', 'user-name');
$form->addHtml('<div class="input-group-addon"><i class="fa fa-user"></i></div>', 'user-name', 'before');
$form->addInput('text', 'user-name', '', '', 'required=required, placeholder=Your Name');
$form->addInputWrapper('<div class="input-group"></div>', 'user-email');
$form->addHtml('<div class="input-group-addon"><i class="fa fa-envelope"></i></div>', 'user-email', 'before');
$form->addInput('email', 'user-email', '', '', 'required=required, placeholder=Email');
$form->addHtml('<p class="pull-right"><small><i class="fa fa-lock fa-fw"></i>Your Information is Safe With us!</small></p>');
$options = array(
        'horizontalLabelCol'       => 'col-sm-3',
        'horizontalOffsetCol'      => 'col-sm-offset-3',
        'horizontalElementCol'     => 'col-sm-9',
);
$form->setOptions($options);
$form->addBtn('submit', 'submit-btn', 1, 'Get Access Today<i class="fa fa-unlock fa-lg fa-fw pull-right"></i>', 'class=btn btn-lg btn-success');
$form->endFieldset();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Join Us Form</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <?php $form->printIncludes('css'); ?>
</head>
<body>
    <h1 class="text-center">Join Us Form</h1>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <?php
            if (isset($sent_message)) {
                echo $sent_message;
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
