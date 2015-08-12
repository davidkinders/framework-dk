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
    $required = array('user-name', 'user-email', 'user-phone', 'message');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->maxLength(100)->validate('message');
    $validator->email()->validate('user-email');
    $validator->captcha('captcha')->validate('captcha');

    // check for errors

    if ($validator->hasErrors()) {
        $_SESSION['errors']['contact-form-2'] = $validator->getAllErrors();
    } else {
        $from_email = 'contact@codecanyon.creation-site.org';
        $adress = addslashes($_POST['user-email']);
        $subject = 'phpforms - Contact Form 2';
        $filter_values = 'contact-form-2, captcha, submit-btn, captchaHash';
        $sent_message = Form::sendMail($from_email, $adress, $subject, $filter_values);
        Form::clear('contact-form-2');
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('contact-form-2', 'vertical', 'novalidate=true');
$form->startFieldset('Please fill in this form to contact us');
$form->addInput('text', 'user-name', '', 'Your name : ', 'required=required');
$form->addInput('email', 'user-email', '', 'Your email : ', 'required=required');
$form->addInput('text', 'user-phone', '', 'Your phone : ', 'required=required');
$form->addTextarea('message', '', 'Your message : ', 'cols=30, rows=4, required=required');
$form->addPlugin('word-character-count', '#message', 'default', array('%maxAuthorized%' => 100));
$form->addCheckbox('newsletter-checkboxes', 'Suscribe to Newsletter', 'newsletter', 1, 'checked=checked');
$form->printCheckboxGroup('newsletter-checkboxes', '');
$form->addInput('text', 'captcha', '', 'Type the characters please :', 'size=15');
$form->addPlugin('captcha', '#captcha');
$form->addBtn('submit', 'submit-btn', 1, 'Submit', 'class=btn btn-success');
$form->endFieldset();
$form->addPlugin('icheck', 'input', 'default', array('%theme%' => 'square-custom', '%color%' => 'green'));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Form 2</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <?php $form->printIncludes('css'); ?>
</head>
<body>
    <h1 class="text-center">Contact Form 2</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
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
