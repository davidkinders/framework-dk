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
    $required = array('user-name', 'user-first-name', 'user-email', 'user-phone', 'message');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->maxLength(100)->validate('message');
    $validator->email()->validate('user-email');
    $validator->captcha('captcha')->validate('captcha');

    // check for errors

    if ($validator->hasErrors()) {
        $_SESSION['errors']['contact-form-1'] = $validator->getAllErrors();
    } else {
        $from_email = 'contact@codecanyon.creation-site.org';
        $adress = addslashes($_POST['user-email']);
        $subject = 'phpforms - Contact Form 1';
        $filter_values = 'contact-form-1, captcha, submit-btn, captchaHash';
        $sent_message = Form::sendMail($from_email, $adress, $subject, $filter_values);
        Form::clear('contact-form-1');
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('contact-form-1', 'horizontal', 'novalidate=true');
$options = array(
        'horizontalLabelCol'       => '',
        'horizontalOffsetCol'      => '',
        'horizontalElementCol'     => 'col-xs-12'
);
$form->setOptions($options);
$form->startFieldset('Please fill in this form to contact us');
$form->addHtml('<p class="text-warning">All fields are required</p>');
$form->setOptions(array('horizontalElementCol' => 'col-xs-6'));
$form->groupInputs('user-name', 'user-first-name');
$form->addInputWrapper('<div class="input-group"></div>', 'user-name');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>', 'user-name', 'before');
$form->addInput('text', 'user-name', '', '', 'required=required, placeholder=Name');
$form->addInputWrapper('<div class="input-group"></div>', 'user-first-name');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>', 'user-first-name', 'before');
$form->addInput('text', 'user-first-name', '', '', 'required=required, placeholder=First Name');
$form->setOptions(array('horizontalElementCol' => 'col-xs-12'));
$form->addInputWrapper('<div class="input-group"></div>', 'user-email');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>', 'user-email', 'before');
$form->addInput('email', 'user-email', '', '', 'required=required, placeholder=Email');
$form->addInputWrapper('<div class="input-group"></div>', 'user-phone');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></div>', 'user-phone', 'before');
$form->addInput('text', 'user-phone', '', '', 'required=required, placeholder=Phone');
$form->addTextarea('message', '', '', 'cols=30, rows=4, required=required, placeholder=Message');
$form->addPlugin('word-character-count', '#message', 'default', array('%maxAuthorized%' => 100));
$form->addCheckbox('newsletter-checkboxes', 'Suscribe to Newsletter', 'newsletter', 1, 'checked=checked');
$form->printCheckboxGroup('newsletter-checkboxes', '');
$options = array(
        'horizontalLabelCol'       => 'col-sm-3',
        'horizontalOffsetCol'      => 'col-sm-offset-3',
        'horizontalElementCol'     => 'col-sm-9',
);
$form->setOptions($options);
$form->addInput('text', 'captcha', '', 'Type the following characters :', 'size=15');
$form->addPlugin('captcha', '#captcha');
$form->addBtn('submit', 'submit-btn', 1, 'Send <span class="glyphicon glyphicon-envelope append"></span>', 'class=btn btn-success');
$form->endFieldset();
$form->addPlugin('icheck', 'input', 'default', array('%theme%' => 'square-custom', '%color%' => 'green'));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Form 1</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <?php $form->printIncludes('css'); ?>
</head>
<body>
    <h1 class="text-center">Contact Form 1</h1>
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
    </div>
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
