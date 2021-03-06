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
    $required = array('user-name', 'user-email', 'user-password');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->hasLowercase()->hasNumber()->minLength(8)->validate('user-password');
    $validator->email()->validate('user-email');

    // check for errors

    if ($validator->hasErrors()) {
        $_SESSION['errors']['sign-up-modal-form-2'] = $validator->getAllErrors();
    } else {
        $from_email = 'contact@codecanyon.creation-site.org';
        $adress = addslashes($_POST['user-email']);
        $subject = 'phpforms - Sign Up Modal Form 2';
        $filter_values = 'sign-up-modal-form-2, captcha, submit-btn';
        $sent_message = Form::sendMail($from_email, $adress, $subject, $filter_values);
        Form::clear('sign-up-modal-form-2');
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('sign-up-modal-form-2', 'vertical', 'novalidate=true');
$options = array(
        'horizontalLabelCol'       => '',
        'horizontalOffsetCol'      => '',
        'horizontalElementCol'     => 'col-xs-12',
);
$form->setOptions($options);
$form->addInputWrapper('<div class="input-group"></div>', 'user-name');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>', 'user-name', 'before');
$form->addInput('text', 'user-name', '', '', 'placeholder=Name, required=required');
$form->addInputWrapper('<div class="input-group"></div>', 'user-email');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>', 'user-email', 'before');
$form->addInput('email', 'user-email', '', '', 'placeholder=E-mail Address, required=required');
$form->addPlugin('passfield', '#user-password');
$form->addHtml('<span class="help-block">password must contain lowercase letters and be 8 characters long</span>', 'user-password', 'after');
$form->addInputWrapper('<div class="input-group"></div>', 'user-password');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-eye-close"></span></div>', 'user-password', 'before');
$form->addInput('password', 'user-password', '', '', 'placeholder=password, required=required');
$form->addBtn('submit', 'submit-btn', 1, 'Submit <span class="glyphicon glyphicon-circle-arrow-right append"></span>', 'class=btn btn-success');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up Modal Form 2</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <?php $form->printIncludes('css'); ?>
</head>
<body>
    <h1 class="text-center">Sign Up Modal Form 2</h1>
    <div class="container">
        <div class="row">
            <?php
            if (isset($sent_message)) {
                echo $sent_message;
            }
            ?>
            <?php /* code preview button */
                include_once '../assets/code-preview.php';
            ?>
            <!-- Button trigger modal -->
            <div class="text-center">
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalForm">
                  Trigger Sign Up Modal Form 2
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
                  </div>
                  <div class="modal-body">
                        <?php
                        $form->render();
                        ?>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <?php
            $form->printIncludes('js');
            $form->printJsCode();
        ?>
        <?php

        /* Launch form modal if form has posted errors */
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $validator->hasErrors()) {
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('button[data-target="#myModalForm"]').trigger('click');
                });
            </script>
            <?php
        }
        ?>
</body>
</html>
