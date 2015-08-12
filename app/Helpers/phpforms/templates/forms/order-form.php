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
    include_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpforms/Validator/Validator.php';
    include_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpforms/Validator/Exception.php';
    $validator = new Validator($_POST);
    $required = array('first-name', 'last-name', 'email', 'area-code', 'phone-number', 'street-address', 'city', 'zip-code', 'country');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->maxLength(100)->validate('message');
    $validator->email()->validate('email');

    // check for errors

    if ($validator->hasErrors()) {
        $_SESSION['errors']['order-form'] = $validator->getAllErrors();
    } else {
        $from_email = 'contact@codecanyon.creation-site.org';
        $adress = addslashes($_POST['email']);
        $subject = 'phpforms - Order Form';
        $filter_values = 'order-form, submit-btn';
        $sent_message = Form::sendMail($from_email, $adress, $subject, $filter_values);
        Form::clear('order-form');
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('order-form', 'horizontal', 'novalidate=true');
$options = array(
        'horizontalLabelCol'       => '',
        'horizontalOffsetCol'      => '',
        'horizontalElementCol'     => 'col-sm-6',
);
$form->setOptions($options);
$form->startFieldset('Order Form');
$form->addHtml('<label>Full name</label>');
$form->groupInputs('first-name', 'last-name');
$form->addHtml('<span class="help-block">First name</span>', 'first-name', 'after');
$form->addInput('text', 'first-name', '', '', 'required=required');
$form->addHtml('<span class="help-block">Last name</span>', 'last-name', 'after');
$form->addInput('text', 'last-name', '', '', 'required=required');
$form->addHtml('<div class="row">');
$form->addHtml('<div class="col-sm-6">');
$form->addHtml('<label>Email</label>');
$form->setOptions(array('horizontalElementCol' => 'col-sm-12'));
$form->addInput('email', 'email');
$form->addHtml('<label>Contact Number</label>');
$form->setOptions(array('horizontalElementCol' => 'col-sm-4'));
$form->groupInputs('area-code', 'phone-number');
$form->addHtml('<span class="help-block">Area Code</span>', 'area-code', 'after');
$form->addInput('text', 'area-code');
$form->setOptions(array('horizontalElementCol' => 'col-sm-8'));
$form->addHtml('<span class="help-block">Phone Number</span>', 'phone-number', 'after');
$form->addInput('text', 'phone-number');
$form->addHtml('</div>');
$form->addHtml('<div class="col-sm-6">');
$form->addHtml('<label>Payment Method</label>');
$form->setOptions(array('horizontalElementCol' => 'col-sm-12'));
$form->addRadio('payment-method', '<img src="../assets/img/cb.png" alt="credit card">', 'credit-card');
$form->addRadio('payment-method', '<img src="../assets/img/paypal.png" alt="paypal">', 'paypal');
$form->printRadioGroup('payment-method', '', false);
$form->addHtml('</div>');
$form->addHtml('</div>');
$form->setOptions(array('horizontalElementCol' => 'col-sm-2'));
$form->addHtml('<label>Billing Address</label>');
$form->setOptions(array('horizontalElementCol' => 'col-sm-12'));
$form->addHtml('<span class="help-block">Street Address</span>', 'street-address', 'after');
$form->addInput('text', 'street-address');
$form->addHtml('<span class="help-block">Street Address Line 2</span>', 'street-address-2', 'after');
$form->addInput('text', 'street-address-2');
$form->setOptions(array('horizontalElementCol' => 'col-sm-6'));
$form->groupInputs('city', 'state');
$form->addHtml('<span class="help-block">City</span>', 'city', 'after');
$form->addInput('text', 'city');
$form->addHtml('<span class="help-block">State / Province</span>', 'state', 'after');
$form->addInput('text', 'state');
$form->groupInputs('zip-code', 'country');
$form->addHtml('<span class="help-block">Postal / Zip Code</span>', 'zip-code', 'after');
$form->addInput('text', 'zip-code');
$form->addHtml('<span class="help-block">Country</span>', 'country', 'after');
$form->addCountrySelect('country', '', '', array('flag_size' => 16));

$options = array(
        'horizontalLabelCol'       => 'col-sm-4',
        'horizontalOffsetCol'      => 'col-sm-offset-4',
        'horizontalElementCol'     => 'col-sm-8',
);
$form->addBtn('submit', 'submit-btn', 1, 'Proceed <span class="glyphicon glyphicon-ok append"></span>', 'class=btn btn-success');
$form->endFieldset();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Form</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <?php $form->printIncludes('css'); ?>
</head>
<body>
    <h1 class="text-center">Order Form</h1>
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
