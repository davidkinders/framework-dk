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
    $required = array('first-name', 'last-name', 'email', 'phone-number', 'number-of-guests', 'date', 'time');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->email()->validate('email');

    // check for errors

    if ($validator->hasErrors()) {
        $_SESSION['errors']['reservation-form'] = $validator->getAllErrors();
    } else {
        $from_email = 'contact@codecanyon.creation-site.org';
        $adress = addslashes($_POST['email']);
        $subject = 'phpforms - Reservation Form';
        $filter_values = 'reservation-form, submit-btn';
        $sent_message = Form::sendMail($from_email, $adress, $subject, $filter_values);
        Form::clear('reservation-form');
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('reservation-form', 'horizontal', 'novalidate=true');
$form->startFieldset('Please fill the form below');
$form->setOptions(array('horizontalLabelCol' => 'col-sm-4', 'horizontalOffsetCol' => 'col-sm-offset-4', 'horizontalElementCol' => 'col-sm-4'));
$form->groupInputs('first-name', 'last-name');
$form->addHtml('<span class="help-block">First name</span>', 'first-name', 'after');
$form->addInput('text', 'first-name', '', 'Full Name : ', 'required=required');
$form->setOptions(array('horizontalLabelCol' => '', 'horizontalOffsetCol' => ''));
$form->addHtml('<span class="help-block">Last name</span>', 'last-name', 'after');
$form->addInput('text', 'last-name', '', '', 'required=required');
$form->setOptions(array('horizontalLabelCol' => 'col-sm-4', 'horizontalOffsetCol' => 'col-sm-offset-4', 'horizontalElementCol' => 'col-sm-8'));
$form->addInput('email', 'email', '', 'E-Mail : ', 'required=required');
$form->addInput('text', 'phone-number', '', 'Phone Number : ', 'required=required');
$form->addInput('number', 'number-of-guests', '', 'Number of Guests: : ', 'required=required');
$form->setOptions(array('horizontalElementCol' => 'col-sm-4'));
$form->groupInputs('date', 'time');
$form->addPlugin('datepicker', '#date');
$form->addHtml('<span class="help-block">Date</span>', 'date', 'after');
$form->addInput('text', 'date', '', 'Date / Time : ', 'required=required');
$form->setOptions(array('horizontalOffsetCol' => '', 'horizontalElementCol' => 'col-sm-2'));
$form->addPlugin('timepicker', '#time', 'ranges-disabled-1');
$form->addHtml('<span class="help-block">Time</span>', 'time', 'after');
$form->addInput('text', 'time', '', '', 'required=required');
$form->setOptions(array('horizontalLabelCol' => 'col-sm-4', 'horizontalOffsetCol' => 'col-sm-offset-4', 'horizontalElementCol' => 'col-sm-8'));
$form->addOption('reservation-type', 'Dinner', 'Dinner', '', 'data-icon=fa fa-cutlery');
$form->addOption('reservation-type', 'Birthday/ Anniversary', 'Birthday/ Anniversary', '', 'data-icon=fa fa-birthday-cake');
$form->addOption('reservation-type', 'Nightlife', 'Nightlife', '', 'data-icon=fa fa-moon-o');
$form->addOption('reservation-type', 'Private', 'Private', '', 'data-icon=fa fa-user-secret');
$form->addOption('reservation-type', 'Wedding', 'Wedding', '', 'data-icon=fa fa-heart');
$form->addOption('reservation-type', 'Corporate', 'Corporate', '', 'data-icon=fa fa-briefcase');
$form->addOption('reservation-type', 'Other', 'Other', '', 'data-icon=fa fa-star');
$form->addSelect('reservation-type', 'Reservation Type', 'class=selectpicker show-tick');
$form->addHtml('<div class="hidden-wrapper off">');
$form->addInput('text', 'reservation-type-other', '', '', 'placeholder=Please tell more ...');
$form->addHtml('</div>');
$form->addTextarea('special-request', '', 'Any Special Request ? ');
$form->addBtn('submit', 'submit-btn', 1, 'Submit <i class="fa fa-arrow-right fa-fw"></i>', 'class=btn btn-success');
$form->endFieldset();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation Form</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <?php $form->printIncludes('css'); ?>
    <!-- Style to show / hide dependant fields -->
        <style type="text/css">
            .hidden-wrapper {
                overflow: hidden;
                -webkit-transition: all 400ms ease-in;
                -moz-transition: all 400ms ease-in;
                -ms-transition: all 400ms ease-in;
                -o-transition: all 400ms ease-in;
                transition: all 400ms ease-in;
            }
            .hidden-wrapper.off {
                height: 0;
                opacity: 0;
            }
            .hidden-wrapper:not(.off) {
                height: auto;
                opacity: 1;
            }
        </style>
</head>
<body>
    <h1 class="text-center">Reservation Form</h1>
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
        <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="reservation-type"]').on('change', function () {
                if ($(this).val() == 'Other') {
                    $('.hidden-wrapper').removeClass('off');
                } else {
                    $('.hidden-wrapper').addClass('off');
                }
            });
        });
    </script>
</body>
</html>
