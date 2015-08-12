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
    $required = array('user-name', 'user-email', 'message');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->required('Please tell us more about your request')->validate('subject');
    $validator->email()->validate('user-email');

    // check for errors

    if ($validator->hasErrors()) {
        $_SESSION['errors']['contact-form-3'] = $validator->getAllErrors();
    } else {
        $from_email = 'contact@codecanyon.creation-site.org';
        $adress = addslashes($_POST['user-email']);
        $subject = 'phpforms - Contact Form 3';
        $filter_values = 'contact-form-3, submit-btn';
        $sent_message = Form::sendMail($from_email, $adress, $subject, $filter_values);
        Form::clear('contact-form-3');
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('contact-form-3', 'horizontal', 'novalidate=true');
$options = array(
        'horizontalLabelCol'       => '',
        'horizontalOffsetCol'      => '',
        'horizontalElementCol'     => 'col-xs-12',
);
$form->setOptions($options);
$form->startFieldset('Please fill in this form to contact us');
$form->setOptions(array('horizontalElementCol' => 'col-xs-6'));
$form->groupInputs('user-name', 'user-first-name');
$form->addInputWrapper('<div class="input-group"></div>', 'user-name');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>', 'user-name', 'before');
$form->addInput('text', 'user-name', '', '', 'required=required, placeholder=Name*');
$form->addInput('text', 'user-first-name', '', '', 'placeholder=First Name');
$form->setOptions(array('horizontalElementCol' => 'col-xs-12'));
$form->addInputWrapper('<div class="input-group"></div>', 'user-email');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>', 'user-email', 'before');
$form->addInput('email', 'user-email', '', '', 'required=required, placeholder=Email*');
$form->addInputWrapper('<div class="input-group"></div>', 'user-phone');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></div>', 'user-phone', 'before');
$form->addInput('text', 'user-phone', '', '', 'placeholder=Phone');
$form->addHtml('<span class="help-block">If other, please tell us more ... </span>', 'subject', 'after');
$form->addOption('subject', '', 'Your request concerns ...');
$form->addOption('subject', 'Support', 'Support', '', 'data-icon=glyphicon glyphicon-info-sign text-warning');
$form->addOption('subject', 'Sales', 'Sales', '', 'data-icon=glyphicon glyphicon-usd text-warning');
$form->addOption('subject', 'Other', 'Other', '', 'data-icon=glyphicon glyphicon-question-sign text-warning');
$form->addSelect('subject', '', 'class=selectpicker');
$form->addHtml('<div class="hidden-wrapper off">');
$form->addInput('text', 'subject-other', '', '', 'placeholder=Please tell more about your request ...');
$form->addHtml('</div>');
$form->addTextarea('message', 'Your message ...', '', 'cols=30, rows=4, required=required');
$form->addPlugin('tinymce', '#message', 'contact-config');
$form->addCheckbox('newsletter-checkboxes', 'Suscribe to Newsletter', 'newsletter', 1, 'checked=checked');
$form->printCheckboxGroup('newsletter-checkboxes', '');
$options = array(
        'horizontalLabelCol'       => 'col-sm-3',
        'horizontalOffsetCol'      => 'col-sm-offset-3',
        'horizontalElementCol'     => 'col-sm-9',
);
$form->setOptions($options);
$form->addBtn('submit', 'submit-btn', 1, 'Send <span class="glyphicon glyphicon-envelope append"></span>', 'class=btn btn-success');
$form->endFieldset();
$form->addHtml('<p class="text-warning">* Required fields</p>');
$form->addPlugin('icheck', 'input', 'default', array('%theme%' => 'square-custom', '%color%' => 'green'));
?>
<!DOCTYPE html>
<html>
<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Form 3</title>

        <!-- Bootstrap CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
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
        <?php $form->printIncludes('css'); ?>
</head>
<body>
    <h1 class="text-center">Contact Form 3</h1>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="subject"]').on('change', function () {
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
