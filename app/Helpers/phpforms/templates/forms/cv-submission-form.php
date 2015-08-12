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
    $required = array('user-name', 'user-first-name', 'user-email');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->email()->validate('user-email');

    // check for errors

    if ($validator->hasErrors()) {
        $_SESSION['errors']['cv-submission-form'] = $validator->getAllErrors();
    } else {

        /* Send email with attached file(s) */

        $path = rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/file-uploads/';
        $attachments = '';
        if (isset($_POST['cv'][0])) {
            $attachments = $path . $_POST['cv'][0] ;
            if (isset($_POST['cv'][1])) {
                $attachments .= ',' . $path . $_POST['cv'][1];
                if (isset($_POST['cv'][2])) {
                    $attachments .= ',' . $path . $_POST['cv'][2];
                }
            }
        }
        $options = array(
        'from_email'     =>  'contact@codecanyon.creation-site.org',
        'from_name'      =>  'phpforms', // optional
        'reply_to'       =>  'contact@codecanyon.creation-site.org', // optional
        'adress'         =>  addslashes($_POST['user-email']),
        'subject'        =>  'phpforms - CV Submission Form',
        'attachments'    =>  $attachments, // optional
        'filter_values'  => 'cv-submission-form, submit-btn', // optional
        'sent_message'   => '<p class="alert alert-success">Your CV has been successfully sent !</p>' // optional
        );
        $sent_message = Form::sendAdvancedMail($options);
        Form::clear('cv-submission-form');
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('cv-submission-form', 'horizontal', 'novalidate=true');
$options = array(
        'horizontalLabelCol'       => 'col-sm-3',
        'horizontalOffsetCol'      => 'col-sm-offset-3',
        'horizontalElementCol'     => 'col-sm-9',
);
$form->setOptions($options);
$form->startFieldset('CV Submission');
$form->addHtml('<h3>Do you want to work with us? <small>Please fill in your details below</small>.</h3><p>&nbsp;</p>');
$form->addInputWrapper('<div class="input-group"></div>', 'user-name');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>', 'user-name', 'before');
$form->addInput('text', 'user-name', '', 'Name', 'required=required');
$form->addInputWrapper('<div class="input-group"></div>', 'user-first-name');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>', 'user-first-name', 'before');
$form->addInput('text', 'user-first-name', '', 'First Name', 'required=required');
$form->addInputWrapper('<div class="input-group"></div>', 'user-email');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>', 'user-email', 'before');
$form->addInput('email', 'user-email', '', 'Email', 'required=required');
$form->addInput('text', 'position-applying-for', '', 'Position Applying For');
$form->addPlugin('tinymce', '#additional-information', 'contact-config');
$form->addTextarea('additional-information', '', 'Additional Information');
$fileUpload_config = array(
'xml'                 => 'default',
'uploader'            => 'defaultFileUpload.php',
'btn-text'            => 'Browse ...',
'max-number-of-files' => 3
);
$form->addHtml('<span class="help-block">3 files max. Accepted File Types : .pdf, .doc[x], .xls[x], .txt</span>', 'cv[]', 'after');
$form->addFileUpload('file', 'cv[]', '', 'Upload your CV <br>&amp; Other Testmonials <br>(e.g Certificates)', 'id=cvFileUpload', $fileUpload_config);
$form->addBtn('submit', 'submit-btn', 1, 'Submit CV', 'class=btn btn-success');
$form->endFieldset();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV Submission Form</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <?php $form->printIncludes('css'); ?>
</head>
<body>
    <h1 class="text-center">CV Submission Form</h1>
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
