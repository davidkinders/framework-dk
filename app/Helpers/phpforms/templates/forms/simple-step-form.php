<?php
use phpforms\Form;
use phpforms\Validator\Validator;

/* =============================================
    start session and include form class
============================================= */

session_start();
include_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpforms/Form.php';

$current_step = 1; // default if nothing posted
if (isset($_POST['back-btn'])) {
    $current_step = $_POST['back-btn'];
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/phpforms/Validator/Validator.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/phpforms/Validator/Exception.php';
    $validator = new Validator($_POST);
    if (isset($_POST['form-step-1'])) {

        /* Validate step 1 */

        $validator->required()->validate('human-or-robot');
        $validator->min(1, true, '<div class="alert alert-danger">Sorry, I don\' really like robots ...</div>')->validate('human-or-robot');
        if ($validator->hasErrors()) {
            $current_step = 1;
            $_SESSION['errors']['form-step-1'] = $validator->getAllErrors();
        } else { // register posted values and go to next step
            Form::registerValues('form-step-1');
            $current_step = 2;
        }
    } elseif (isset($_POST['form-step-2'])) {

        /* Validate step 2 */

        $validator->required()->validate('how-did-you-come-here');
        if ($validator->hasErrors()) {
            $current_step = 2;
            $_SESSION['errors']['form-step-2'] = $validator->getAllErrors();
        } else { // register posted values and go to next step
            Form::registerValues('form-step-2');
            $current_step = 3;
        }
    } elseif (isset($_POST['form-step-3'])) {

        /* Validate step 3 */

        if ($_POST['are-informations-correct'] < 1) { // back to step 1 with user message (wrong informations)
            $current_step = 1;
            $user_message = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Wrong informations ! </strong> Please try again ...</div>' . " \n";
        } else { // send email & go back to step 1 with user message (email sended)

            Form::registerValues('form-step-3');
            $user_values = Form::mergeValues(array('form-step-1', 'form-step-2', 'form-step-3'));
            $from_email = 'contact@codecanyon.creation-site.org';
            $adress = 'gilles.migliori@gmail.com';
            $subject = 'contact from my site';
            $filter_values = 'form-step-1, form-step-2, form-step-3, submit-btn';

            /* translate boolean values to text */

            $find                                    = array('/0/', '/1/');
            $replace                                 = array('No', 'Yes');
            $user_values['human-or-robot']           = preg_replace($find, $replace, $user_values['human-or-robot']);
            $user_values['are-informations-correct'] = preg_replace($find, $replace, $user_values['are-informations-correct']);

            $user_message = Form::sendMail($from_email, $adress, $subject, $filter_values, $user_values);
            $current_step = 1;
        }
    }
}
if ($current_step == 1) {

    /* ==================================================
        Step 1
    ================================================== */

    $form_id = 'form-step-1';
    $form = new Form('form-step-1', 'horizontal', 'novalidate=true');
    $form->addRadio('human-or-robot', 'I\'m a human', 1);
    $form->addRadio('human-or-robot', 'I\'m a robot', 0);
    $form->printRadioGroup('human-or-robot', 'Are you a human or a robot ?', false, 'required=required');
    $form->addBtn('submit', 'submit-btn', 1, 'Next <span class="glyphicon glyphicon-arrow-right append"></span>', 'class=btn btn-sm btn-success');
} elseif ($current_step == 2) {

    /* ==================================================
        Step 2
    ================================================== */

    $form_id = 'form-step-2';
    $form = new Form('form-step-2', 'horizontal', 'novalidate=true');
    $form->addOption('how-did-you-come-here', 'By foot', 'By foot');
    $form->addOption('how-did-you-come-here', 'By plane', 'By plane');
    $form->addOption('how-did-you-come-here', 'By car', 'By car');
    $form->addOption('how-did-you-come-here', 'By boat', 'By boat');
    $form->addOption('how-did-you-come-here', 'By bike', 'By bike');
    $form->addPlugin('bootstrap-select', '.selectpicker');
    $form->addSelect('how-did-you-come-here', 'How did you come here ?', 'class=selectpicker show-tick, required=required');
    $form->addBtn('submit', 'back-btn', 1, '<span class="glyphicon glyphicon-arrow-left prepend"></span> Back', 'class=btn btn-sm btn-warning', 'btns');
    $form->addBtn('submit', 'submit-btn', 2, 'Next <span class="glyphicon glyphicon-arrow-right append"></span>', 'class=btn btn-sm btn-success', 'btns');
    $form->printBtnGroup('btns');
} elseif ($current_step == 3) {

    /* ==================================================
        Step 3
    ================================================== */

    $form_id = 'form-step-3';
    $form = new Form('form-step-3', 'horizontal', 'novalidate=true');
    $form->addHtml('<p class="lead"><strong>You are human, you came here ' . strtolower($_SESSION['form-step-2']['how-did-you-come-here']) . '.</strong></p>');
    $form->addHtml('');
    $form->addHtml('');
    $form->addRadio('are-informations-correct', 'Yes, Excellent', 1);
    $form->addRadio('are-informations-correct', 'Absolutely not', 0);
    $form->printRadioGroup('are-informations-correct', 'Are these informations correct ?', false, 'required=required');
    $form->addBtn('submit', 'back-btn', 2, '<span class="glyphicon glyphicon-arrow-left prepend"></span> Back', 'class=btn btn-sm btn-warning', 'btns');
    $form->addBtn('submit', 'submit-btn', 3, 'Submit <span class="glyphicon glyphicon-arrow-right append"></span>', 'class=btn btn-sm btn-success', 'btns');
    $form->printBtnGroup('btns');
}
$form->addPlugin('icheck', 'input', 'default', array('%theme%' => 'square', '%color%' => 'green'));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Step Form</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <?php $form->printIncludes('css'); ?>
</head>
<body>
    <h1 class="text-center">Simple Step Form</h1>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <?php
            if (isset($user_message)) {
                echo $user_message;
            }
            ?>
            <?php /* code preview button */
                include_once '../assets/code-preview.php';
            ?>
            <legend>Simple Step Form</legend>
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
