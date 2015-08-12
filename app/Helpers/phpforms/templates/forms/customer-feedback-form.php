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
    $required = array('customer-name', 'customer-email');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->required('<br>Please rate')->validate('company-rating');
    $validator->required('<br>Please rate')->validate('support-rating');
    $validator->required('Please choose one or several product(s)')->validate('product-choice.0');
    $validator->email()->validate('customer-email');

    // check for errors

    if ($validator->hasErrors()) {
        $_SESSION['errors']['customer-feedback-form'] = $validator->getAllErrors();
    } else {
        $from_email = 'contact@codecanyon.creation-site.org';
        $adress = addslashes($_POST['customer-email']);
        $subject = 'phpforms - Customer Feedback Form';
        $filter_values = 'customer-feedback-form, submit-btn';
        $sent_message = Form::sendMail($from_email, $adress, $subject, $filter_values);
        Form::clear('customer-feedback-form');
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('customer-feedback-form', 'horizontal', 'novalidate=true');
$form->startFieldset('Customer Feedback Form');
$form->addHtml('<p class="text-primary text-center">You are encouraged to use the online feedback form below to send us your comments as well as any queries about our products.</p><br>');
$form->addHtml('<div class="row">');
$form->addHtml('<div class="col-md-6">');
$form->addInput('text', 'customer-name', '', 'Customer Name', 'required=required');
$form->addInput('text', 'customer-email', '', 'E-Mail Adress', 'required=required');
$form->addInput('text', 'organization', '', 'Organization');
$form->addHtml('</div>');
$form->addHtml('<div class="col-md-6">');
$form->addOption('product-choice[]', 'Computers', 'Computers', '', 'data-icon=glyphicon-hdd');
$form->addOption('product-choice[]', 'Games', 'Games', '', 'data-icon=glyphicon-send');
$form->addOption('product-choice[]', 'Books', 'Books', '', 'selected, data-icon=glyphicon-book');
$form->addOption('product-choice[]', 'Music', 'Music', '', 'selected, data-icon=glyphicon-headphones');
$form->addOption('product-choice[]', 'Photos', 'Photos', '', 'data-icon=glyphicon-picture');
$form->addOption('product-choice[]', 'Films', 'Films', '', 'data-icon=glyphicon-film');
$form->addHtml('<span class="help-block">(multiple choices)</span>', 'product-choice[]', 'after');
$form->addSelect('product-choice[]', 'What products are you interested in ?', 'class=selectpicker, required=required, multiple=multiple');
$form->addHtml('</div>');
$form->addHtml('</div>');
$form->addHtml('<div class="row">');
$form->addHtml('<div class="col-md-6">');
$form->addRadio('company-rating', 'Very High', 'Very High');
$form->addRadio('company-rating', 'High', 'High');
$form->addRadio('company-rating', 'Neutral', 'Neutral', 'checked=checked');
$form->addRadio('company-rating', 'Low', 'Low');
$form->addRadio('company-rating', 'Very Low', 'Very Low');
$form->printRadioGroup('company-rating', 'How would you rate our company ?', false, 'required=required');
$form->addHtml('</div>');
$form->addHtml('<div class="col-md-6">');
$form->addRadio('support-rating', 'Excellent', 'Excellent');
$form->addRadio('support-rating', 'Good', 'Good', 'checked=checked');
$form->addRadio('support-rating', 'Fair', 'Fair');
$form->addRadio('support-rating', 'Poor', 'Poor');
$form->addRadio('support-rating', 'Terrible', 'Terrible');
$form->printRadioGroup('support-rating', 'How would you rate our support ?', false, 'required=required');
$form->addHtml('</div>');
$form->addHtml('</div>');
$options = array(
        'horizontalLabelCol'       => 'col-sm-2',
        'horizontalOffsetCol'      => 'col-sm-offset-2',
        'horizontalElementCol'     => 'col-sm-10',
);
$form->setOptions($options);
$form->addTextarea('comment', '', 'Do you have other comments for us ?');
$form->addBtn('submit', 'submit-btn', 1, 'Submit', 'class=btn btn-success');

$form->endFieldset();
$form->addHtml('<p class="pull-right"><strong class="text-danger">*</strong> Required fields</p>');
$form->addHtml('</div>');
$form->addPlugin('icheck', 'input', 'default', array('%theme%' => 'square', '%color%' => 'red'));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Feedback Form</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <?php
    $form->printIncludes('css');
    ?>
</head>
<body>
    <h1 class="text-center">Customer Feedback Form</h1>
    <div class="container">
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
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <?php
        $form->printIncludes('js');
        $form->printJsCode();
        ?>
</body>
</html>
