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
    $required = array('first-name', 'last-name', 'user-email', 'phone-number', 'arrival-date', 'number-of-nights', 'number-of-guests');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->email()->validate('user-email');

    // check for errors

    if ($validator->hasErrors()) {
        $_SESSION['errors']['room-booking-form'] = $validator->getAllErrors();
    } else {
        $from_email = 'contact@codecanyon.creation-site.org';
        $adress = addslashes($_POST['user-email']);
        $subject = 'phpforms - Room Booking Form';
        $filter_values = 'room-booking-form, submit-btn';
        $sent_message = Form::sendMail($from_email, $adress, $subject, $filter_values);
        Form::clear('room-booking-form');
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('room-booking-form', 'horizontal', 'novalidate=true');
$form->startFieldset('Book a Room');
$form->setOptions(array('horizontalLabelCol' => 'col-sm-3', 'horizontalOffsetCol' => 'col-sm-offset-3', 'horizontalElementCol' => 'col-sm-4'));
$form->groupInputs('first-name', 'last-name');
$form->addHtml('<span class="help-block">First name</span>', 'first-name', 'after');
$form->addInput('text', 'first-name', '', 'Full Name : ', 'required=required');
$form->setOptions(array('horizontalOffsetCol' => '', 'horizontalElementCol' => 'col-sm-5'));
$form->addHtml('<span class="help-block">Last name</span>', 'last-name', 'after');
$form->addInput('text', 'last-name', '', '', 'required=required');
$form->setOptions(array('horizontalOffsetCol' => 'col-sm-offset-3', 'horizontalElementCol' => 'col-sm-9'));
$form->addInput('email', 'user-email', '', 'E-Mail : ', 'placeholder=email@example.com, required=required');
$form->addInput('text', 'phone-number', '', 'Phone Number : ', 'required=required');
$form->addPlugin('datepicker', '#arrival-date');
$form->addInput('text', 'arrival-date', '', 'Arrival Date', 'required=required');
$form->groupInputs('number-of-nights', 'number-of-guests');
for ($i=1; $i <= 30; $i++) {
    $form->addOption('number-of-nights', $i, $i);
}
$form->addOption('number-of-nights', 'more than 30', '30 +');
$form->setOptions(array('horizontalOffsetCol' => 'col-sm-offset-3', 'horizontalElementCol' => 'col-sm-3'));
$form->addInputWrapper('<div class="input-group"></div>', 'number-of-nights');
$form->addHtml('<div class="input-group-addon"><i class="fa fa-bed"></i></div>', 'number-of-nights', 'before');
$form->addSelect('number-of-nights', 'Number of Nights', 'class=selectpicker, required=required');
for ($i=1; $i <= 10; $i++) {
    $form->addOption('number-of-guests', $i, $i);
}
$form->addOption('number-of-guests', 'more than 10', '10 +');
$form->addInputWrapper('<div class="input-group"></div>', 'number-of-guests');
$form->addHtml('<div class="input-group-addon"><i class="fa fa-user-plus"></i></div>', 'number-of-guests', 'before');
$form->addSelect('number-of-guests', 'Number of Guests', 'class=selectpicker, required=required');
$form->addPlugin('tinymce', '#additional-informations', 'contact-config');
$form->setOptions(array('horizontalOffsetCol' => 'col-sm-offset-3', 'horizontalElementCol' => 'col-sm-9'));
$form->addTextarea('additional-informations', '', 'Additional Informations');
$form->addBtn('submit', 'submit-btn', 1, 'Submit', 'class=btn btn-success');
$form->endFieldset();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Room Booking Form</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <?php $form->printIncludes('css'); ?>
</head>
<body>
    <h1 class="text-center">Room Booking Form</h1>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
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
