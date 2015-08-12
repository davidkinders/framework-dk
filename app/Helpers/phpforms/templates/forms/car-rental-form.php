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
    $required = array('pick-up-location', 'pick-up-date', 'pick-up-time', 'drop-off-location', 'drop-off-date', 'drop-off-time', 'car-type', 'prefix', 'first-name', 'last-name', 'user-email', 'area-code', 'user-phone');
    foreach ($required as $required) {
        $validator->required()->validate($required);
    }
    $validator->email()->validate('user-email');

    // check for errors

    if ($validator->hasErrors()) {
        $_SESSION['errors']['car-rental-form'] = $validator->getAllErrors();

    } else {
        $from_email = 'contact@codecanyon.creation-site.org';
        $adress = addslashes($_POST['user-email']);
        $subject = 'phpforms - Car Rental Form';
        $filter_values = 'car-rental-form, submit-btn';
        $sent_message = Form::sendMail($from_email, $adress, $subject, $filter_values);
        Form::clear('car-rental-form');
    }
}

/* ==================================================
    The Form

    for class and methods documentation,
    go to documentation/index.html
================================================== */

$form = new Form('car-rental-form', 'horizontal', 'novalidate=true');
$form->startFieldset('Rent a car');

/* BS3 Panel 1 */

$form->addHtml('<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">') . " \n";
$form->addHtml('  <div class="panel panel-primary">') . " \n";
$form->addHtml('    <div class="panel-heading" role="tab" id="headingOne">') . " \n";
$form->addHtml('      <h4 class="panel-title">') . " \n";
$form->addHtml('        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">') . " \n";
    $form->addHtml('          Main rental informations <span class="caret"></span>') . " \n";
$form->addHtml('        </a>') . " \n";
$form->addHtml('      </h4>') . " \n";
$form->addHtml('    </div>') . " \n";
$form->addHtml('    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">') . " \n";
$form->addHtml('      <div class="panel-body">') . " \n";

/* Form First part */

        /* Pick up */

$form->setOptions(array('horizontalLabelCol' => 'col-sm-3', 'horizontalOffsetCol' => 'col-sm-offset-3', 'horizontalElementCol' => 'col-sm-4'));
$form->groupInputs('pick-up-location', 'pick-up-date', 'pick-up-time');
$form->addOption('pick-up-location', 'Alabama', 'Alabama');
$form->addOption('pick-up-location', 'Alabama', 'Alabama');
$form->addOption('pick-up-location', 'Alaska', 'Alaska');
$form->addOption('pick-up-location', 'Arizona', 'Arizona');
$form->addOption('pick-up-location', 'Arkansas', 'Arkansas');
$form->addOption('pick-up-location', 'California', 'California');
$form->addOption('pick-up-location', 'Colorado', 'Colorado');
$form->addOption('pick-up-location', 'Connecticut', 'Connecticut');
$form->addOption('pick-up-location', 'Delaware', 'Delaware');
$form->addOption('pick-up-location', 'District of Columbia', 'District of Columbia');
$form->addOption('pick-up-location', 'Florida', 'Florida');
$form->addOption('pick-up-location', 'Georgia', 'Georgia');
$form->addOption('pick-up-location', 'Hawaii', 'Hawaii');
$form->addOption('pick-up-location', 'Idaho', 'Idaho');
$form->addOption('pick-up-location', 'Illinois', 'Illinois');
$form->addOption('pick-up-location', 'Indiana', 'Indiana');
$form->addOption('pick-up-location', 'Iowa', 'Iowa');
$form->addOption('pick-up-location', 'Kansas', 'Kansas');
$form->addOption('pick-up-location', 'Kentucky', 'Kentucky');
$form->addOption('pick-up-location', 'Louisiana', 'Louisiana');
$form->addOption('pick-up-location', 'Maine', 'Maine');
$form->addOption('pick-up-location', 'Maryland', 'Maryland');
$form->addOption('pick-up-location', 'Massachusetts', 'Massachusetts');
$form->addOption('pick-up-location', 'Michigan', 'Michigan');
$form->addOption('pick-up-location', 'Minnesota', 'Minnesota');
$form->addOption('pick-up-location', 'Mississippi', 'Mississippi');
$form->addOption('pick-up-location', 'Missouri', 'Missouri');
$form->addOption('pick-up-location', 'Montana', 'Montana');
$form->addOption('pick-up-location', 'Nebraska', 'Nebraska');
$form->addOption('pick-up-location', 'Nevada', 'Nevada');
$form->addOption('pick-up-location', 'New Hampshire', 'New Hampshire');
$form->addOption('pick-up-location', 'New Jersey', 'New Jersey');
$form->addOption('pick-up-location', 'New Mexico', 'New Mexico');
$form->addOption('pick-up-location', 'New York', 'New York');
$form->addOption('pick-up-location', 'North Carolina', 'North Carolina');
$form->addOption('pick-up-location', 'North Dakota', 'North Dakota');
$form->addOption('pick-up-location', 'Ohio', 'Ohio');
$form->addOption('pick-up-location', 'Oklahoma', 'Oklahoma');
$form->addOption('pick-up-location', 'Oregon', 'Oregon');
$form->addOption('pick-up-location', 'Pennsylvania', 'Pennsylvania');
$form->addOption('pick-up-location', 'Rhode Island', 'Rhode Island');
$form->addOption('pick-up-location', 'South Carolina', 'South Carolina');
$form->addOption('pick-up-location', 'South Dakota', 'South Dakota');
$form->addOption('pick-up-location', 'Tennessee', 'Tennessee');
$form->addOption('pick-up-location', 'Texas', 'Texas');
$form->addOption('pick-up-location', 'Utah', 'Utah');
$form->addOption('pick-up-location', 'Vermont', 'Vermont');
$form->addOption('pick-up-location', 'Virginia', 'Virginia');
$form->addOption('pick-up-location', 'Washington', 'Washington');
$form->addOption('pick-up-location', 'West Virginia', 'West Virginia');
$form->addOption('pick-up-location', 'Wisconsin', 'Wisconsin');
$form->addOption('pick-up-location', 'Wyoming', 'Wyoming');
$form->addSelect('pick-up-location', 'Pick up location', 'class=selectpicker, data-live-search=true, required=required');
$form->setOptions(array('horizontalOffsetCol' => '', 'horizontalElementCol' => 'col-sm-3'));
$form->addPlugin('datepicker', '#pick-up-date');
$form->addHtml('<span class="help-block">Pick-up Date</span>', 'pick-up-date', 'after');
$form->addInput('text', 'pick-up-date', '', '', 'required=required');
$form->setOptions(array('horizontalElementCol' => 'col-sm-2'));
$form->addPlugin('timepicker', '#pick-up-time', 'ranges-disabled-2');
$form->addHtml('<span class="help-block">Pick-up Time</span>', 'pick-up-time', 'after');
$form->addInput('text', 'pick-up-time', '', '', 'required=required');

        /* Drop Off */

$form->setOptions(array('horizontalLabelCol' => 'col-sm-3', 'horizontalOffsetCol' => 'col-sm-offset-3', 'horizontalElementCol' => 'col-sm-4'));
$form->groupInputs('drop-off-location', 'drop-off-date', 'drop-off-time');
$form->addOption('drop-off-location', 'Alabama', 'Alabama');
$form->addOption('drop-off-location', 'Alabama', 'Alabama');
$form->addOption('drop-off-location', 'Alaska', 'Alaska');
$form->addOption('drop-off-location', 'Arizona', 'Arizona');
$form->addOption('drop-off-location', 'Arkansas', 'Arkansas');
$form->addOption('drop-off-location', 'California', 'California');
$form->addOption('drop-off-location', 'Colorado', 'Colorado');
$form->addOption('drop-off-location', 'Connecticut', 'Connecticut');
$form->addOption('drop-off-location', 'Delaware', 'Delaware');
$form->addOption('drop-off-location', 'District of Columbia', 'District of Columbia');
$form->addOption('drop-off-location', 'Florida', 'Florida');
$form->addOption('drop-off-location', 'Georgia', 'Georgia');
$form->addOption('drop-off-location', 'Hawaii', 'Hawaii');
$form->addOption('drop-off-location', 'Idaho', 'Idaho');
$form->addOption('drop-off-location', 'Illinois', 'Illinois');
$form->addOption('drop-off-location', 'Indiana', 'Indiana');
$form->addOption('drop-off-location', 'Iowa', 'Iowa');
$form->addOption('drop-off-location', 'Kansas', 'Kansas');
$form->addOption('drop-off-location', 'Kentucky', 'Kentucky');
$form->addOption('drop-off-location', 'Louisiana', 'Louisiana');
$form->addOption('drop-off-location', 'Maine', 'Maine');
$form->addOption('drop-off-location', 'Maryland', 'Maryland');
$form->addOption('drop-off-location', 'Massachusetts', 'Massachusetts');
$form->addOption('drop-off-location', 'Michigan', 'Michigan');
$form->addOption('drop-off-location', 'Minnesota', 'Minnesota');
$form->addOption('drop-off-location', 'Mississippi', 'Mississippi');
$form->addOption('drop-off-location', 'Missouri', 'Missouri');
$form->addOption('drop-off-location', 'Montana', 'Montana');
$form->addOption('drop-off-location', 'Nebraska', 'Nebraska');
$form->addOption('drop-off-location', 'Nevada', 'Nevada');
$form->addOption('drop-off-location', 'New Hampshire', 'New Hampshire');
$form->addOption('drop-off-location', 'New Jersey', 'New Jersey');
$form->addOption('drop-off-location', 'New Mexico', 'New Mexico');
$form->addOption('drop-off-location', 'New York', 'New York');
$form->addOption('drop-off-location', 'North Carolina', 'North Carolina');
$form->addOption('drop-off-location', 'North Dakota', 'North Dakota');
$form->addOption('drop-off-location', 'Ohio', 'Ohio');
$form->addOption('drop-off-location', 'Oklahoma', 'Oklahoma');
$form->addOption('drop-off-location', 'Oregon', 'Oregon');
$form->addOption('drop-off-location', 'Pennsylvania', 'Pennsylvania');
$form->addOption('drop-off-location', 'Rhode Island', 'Rhode Island');
$form->addOption('drop-off-location', 'South Carolina', 'South Carolina');
$form->addOption('drop-off-location', 'South Dakota', 'South Dakota');
$form->addOption('drop-off-location', 'Tennessee', 'Tennessee');
$form->addOption('drop-off-location', 'Texas', 'Texas');
$form->addOption('drop-off-location', 'Utah', 'Utah');
$form->addOption('drop-off-location', 'Vermont', 'Vermont');
$form->addOption('drop-off-location', 'Virginia', 'Virginia');
$form->addOption('drop-off-location', 'Washington', 'Washington');
$form->addOption('drop-off-location', 'West Virginia', 'West Virginia');
$form->addOption('drop-off-location', 'Wisconsin', 'Wisconsin');
$form->addOption('drop-off-location', 'Wyoming', 'Wyoming');
$form->addSelect('drop-off-location', 'Drop off location', 'class=selectpicker, data-live-search=true, required=required');
$form->setOptions(array('horizontalOffsetCol' => '', 'horizontalElementCol' => 'col-sm-3'));
$form->addPlugin('datepicker', '#drop-off-date');
$form->addHtml('<span class="help-block">Drop-off Date</span>', 'drop-off-date', 'after');
$form->addInput('text', 'drop-off-date', '', '', 'required=required');
$form->setOptions(array('horizontalElementCol' => 'col-sm-2'));
$form->addPlugin('timepicker', '#drop-off-time', 'ranges-disabled-2');
$form->addHtml('<span class="help-block">Drop-off Time</span>', 'drop-off-time', 'after');
$form->addInput('text', 'drop-off-time', '', '', 'required=required');

        /* Car type */

$form->setOptions(array('horizontalElementCol' => 'col-sm-9'));
$form->addRadio('car-type', 'Standart Cars', 'Standart Cars');
$form->addRadio('car-type', 'Convertibles', 'Convertibles');
$form->addRadio('car-type', 'Luxury Cars', 'Luxury Cars');
$form->addRadio('car-type', 'Vans', 'Vans');
$form->addRadio('car-type', 'SUVs', 'SUVs');
$form->printRadioGroup('car-type', 'Car Type', true, 'required=required');

$form->addHtml('      </div>') . " \n";
$form->addHtml('    </div>') . " \n";
$form->addHtml('  </div>') . " \n";

/* BS3 Panel 2 */

$form->addHtml('  <div class="panel panel-primary">') . " \n";
$form->addHtml('    <div class="panel-heading" role="tab" id="headingTwo">') . " \n";
$form->addHtml('      <h4 class="panel-title">') . " \n";
$form->addHtml('        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">') . " \n";
$form->addHtml('          Extras <span class="caret"></span>') . " \n";
$form->addHtml('        </a>') . " \n";
$form->addHtml('      </h4>') . " \n";
$form->addHtml('    </div>') . " \n";
$form->addHtml('    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">') . " \n";
$form->addHtml('      <div class="panel-body">') . " \n";

/* Form Second part */

$form->addRadio('with', 'GPS navigation system', 'GPS navigation system');
$form->addRadio('with', 'Booster', 'Booster');
$form->addRadio('with', 'Child safety seat', 'Child safety seat');
$form->addRadio('with', 'Additional driver', 'Additional driver');
$form->printRadioGroup('with', 'With', false);
$form->addTextarea('additional-requests', '', 'Additional Requests');

$form->addHtml('      </div>') . " \n";
$form->addHtml('    </div>') . " \n";
$form->addHtml('  </div>') . " \n";

/* BS3 Panel 3 */

$form->addHtml('  <div class="panel panel-primary">') . " \n";
$form->addHtml('    <div class="panel-heading" role="tab" id="headingThree">') . " \n";
$form->addHtml('      <h4 class="panel-title">') . " \n";
$form->addHtml('        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">') . " \n";
$form->addHtml('          Personal informations <span class="caret"></span>') . " \n";
$form->addHtml('        </a>') . " \n";
$form->addHtml('      </h4>') . " \n";
$form->addHtml('    </div>') . " \n";
$form->addHtml('    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">') . " \n";
$form->addHtml('      <div class="panel-body">') . " \n";

/* Form Third part */

$form->groupInputs('prefix', 'first-name', 'last-name');
$form->setOptions(array('horizontalElementCol' => 'col-sm-2'));
$form->addOption('prefix', 'Mr', 'Mr');
$form->addOption('prefix', 'Mrs', 'Mrs');
$form->addSelect('prefix', 'Full Name', 'required=required');
$form->setOptions(array('horizontalElementCol' => 'col-sm-3'));
$form->addInput('text', 'first-name', '', '', 'required=required, placeholder=First Name');
$form->setOptions(array('horizontalElementCol' => 'col-sm-4'));
$form->addInput('text', 'last-name', '', '', 'required=required, placeholder=Last Name');
$form->setOptions(array('horizontalElementCol' => 'col-sm-9'));
$form->addInput('email', 'user-email', '', 'E-Mail', 'required=required');
$form->groupInputs('area-code', 'user-phone');
$form->setOptions(array('horizontalElementCol' => 'col-sm-2'));
$form->addInput('text', 'area-code', '', 'Phone Number', 'required=required, placeholder=Area Code');
$form->setOptions(array('horizontalElementCol' => 'col-sm-7'));
$form->addInput('text', 'user-phone', '', '', 'required=required, placeholder=Phone Number');

/* Close BS3 Panel */

$form->addHtml('      </div>') . " \n";
$form->addHtml('    </div>') . " \n";
$form->addHtml('  </div>') . " \n";
$form->addHtml('</div>') . " \n";

/* iCheck */

$form->addPlugin('icheck', 'input', 'default', array('%theme%' => 'square', '%color%' => 'yellow'));

$form->addBtn('submit', 'submit-btn', 1, 'Submit', 'class=btn btn-success');
$form->endFieldset();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Rental Form</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <?php $form->printIncludes('css'); ?>
</head>
<body>
    <h1 class="text-center">Car Rental Form</h1>
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
            /* open panel where we found the first error */
            if (!$('#collapseOne .has-error')[0] && $('#collapseThree .has-error')[0]) {
                $('#collapseOne').removeClass('in');
                $('#collapseThree').addClass('in');
            }
        });
    </script>
</body>
</html>
