<?php
use phpforms\Form;
use phpforms\Validator\Validator;

/* =============================================
    start session and include form class
============================================= */

session_start();
include_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpforms/Form.php';

$current_step = 1; // default if nothing posted

/* =============================================
    validation if posted
============================================= */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/phpforms/Validator/Validator.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/phpforms/Validator/Exception.php';
    $validator = new Validator($_POST);
    if (isset($_POST['cs-step-1'])) {

        /* Validate step 1 */

        $required = array('satisfied-with-company', 'words-to-describe-our-products.0');
        foreach ($required as $required) {
            $validator->required()->validate($required);
        }
        if ($validator->hasErrors()) {
            $current_step = 1;
            $_SESSION['errors']['cs-step-1'] = $validator->getAllErrors();
        } else { // register posted values and go to next step
            Form::registerValues('cs-step-1');
            $current_step = 2;
        }
    } elseif (isset($_POST['cs-step-2'])) {

        /* Validate step 2 */

        $required = array('how-well-do-our-products-meet-your-needs.0', 'rate-the-quality-of-our-products');
        foreach ($required as $required) {
            $validator->required()->validate($required);
        }
        if ($validator->hasErrors()) {
            $current_step = 2;
            $_SESSION['errors']['cs-step-2'] = $validator->getAllErrors();
        } else { // register posted values and go to next step
            Form::registerValues('cs-step-2');
            $current_step = 3;
        }
    } elseif (isset($_POST['cs-step-3'])) {

        /* Validate step 3 */

        $required = array('rate-the-value-for-money-of-our-products', 'responsive-to-questions-about-our-products');
        foreach ($required as $required) {
            $validator->required()->validate($required);
        }
        if ($validator->hasErrors()) {
            $current_step = 3;
            $_SESSION['errors']['cs-step-3'] = $validator->getAllErrors();
        } else { // register posted values and go to next step
            Form::registerValues('cs-step-3');
            $current_step = 4;
        }
    } elseif (isset($_POST['cs-step-4'])) {

        /* Validate step 4 */

        $required = array('how-long-have-you-been-a-customer-of-our-company', 'how-likely-purchase-products-again');
        foreach ($required as $required) {
            $validator->required()->validate($required);
        }
        if ($validator->hasErrors()) {
            $current_step = 4;
            $_SESSION['errors']['cs-step-4'] = $validator->getAllErrors();
        } else { // register posted values and go to next step
            Form::registerValues('cs-step-4');
            $current_step = 5;
        }
    } elseif (isset($_POST['cs-step-5'])) {

        /* Validate step 4 */

        $required = array('recommend-to-a-friend-or-colleague');
        foreach ($required as $required) {
            $validator->required()->validate($required);
        }
        if ($validator->hasErrors()) {
            $current_step = 5;
            $_SESSION['errors']['cs-step-5'] = $validator->getAllErrors();
        } else { // SEND ALL
            Form::registerValues('cs-step-5');
            $current_step = 1;

            $values = Form::mergeValues(array('cs-step-1', 'cs-step-2', 'cs-step-3', 'cs-step-4', 'cs-step-5'));
            $from_email = 'contact@codecanyon.creation-site.org';
            $adress = 'gilles.migliori@gmail.com';
            $subject = 'phpforms - Step Customer Satisfaction Slide Form';
            $filter_values = 'cs-step-1, cs-step-2, cs-step-3, cs-step-4, cs-step-5, submit-btn';
            $sent_message = Form::sendMail($from_email, $adress, $subject, $filter_values, $values);
            Form::clear('cs-step-1');
            Form::clear('cs-step-2');
            Form::clear('cs-step-3');
            Form::clear('cs-step-4');
            Form::clear('cs-step-5');
        }
    }
}
if ($current_step == 1) {

    /* ==================================================
        Step 1
    ================================================== */

    $form_id = 'cs-step-1';

    $form = new Form('cs-step-1', 'horizontal', 'novalidate=true');
    $form->addRadio('satisfied-with-company', 'Very Satisfied', 'Very Satisfied');
    $form->addRadio('satisfied-with-company', 'Somewhat satisfied', 'Somewhat satisfied');
    $form->addRadio('satisfied-with-company', 'Neither satisfied nor dissatisfied', 'Neither satisfied nor dissatisfied', 'checked=checked');
    $form->addRadio('satisfied-with-company', 'Somewhat dissatisfied', 'Somewhat dissatisfied');
    $form->addRadio('satisfied-with-company', 'Very dissatisfied', 'Very dissatisfied');
    $form->printRadioGroup('satisfied-with-company', 'Overall, how satisfied or dissatisfied are you with our company ?', false, 'required=required');
    $form->addOption('words-to-describe-our-products[]', 'Reliable', 'Reliable');
    $form->addOption('words-to-describe-our-products[]', 'High quality', 'High quality');
    $form->addOption('words-to-describe-our-products[]', 'Useful', 'Useful');
    $form->addOption('words-to-describe-our-products[]', 'Unique', 'Unique');
    $form->addOption('words-to-describe-our-products[]', 'Good value for money', 'Good value for money');
    $form->addOption('words-to-describe-our-products[]', 'Overpriced', 'Overpriced');
    $form->addOption('words-to-describe-our-products[]', 'Impractical', 'Impractical');
    $form->addOption('words-to-describe-our-products[]', 'Ineffective', 'Ineffective');
    $form->addOption('words-to-describe-our-products[]', 'Poor quality', 'Poor quality');
    $form->addOption('words-to-describe-our-products[]', 'Unreliable', 'Unreliable');
    $form->addPlugin('bootstrap-select', '.selectpicker');
    $form->addHtml('<span class="help-block">multiple choices - choose at least one</span>', 'words-to-describe-our-products[]', 'after');
    $form->addSelect('words-to-describe-our-products[]', 'Which of the following words would you use to describe our products ?', 'class=selectpicker show-tick, multiple=multiple, data-selected-text-format=count, required=required');
    $form->addBtn('submit', 'submit-btn', 1, 'Next <span class="glyphicon glyphicon-circle-arrow-right append"></span>', 'class=btn btn-sm btn-success');
    if (isset($sent_message)) {
        echo $sent_message;
    }
} elseif ($current_step == 2) {

    /* ==================================================
        Step 2
    ================================================== */

    $form_id = 'cs-step-2';
    $previous_form = new Form('cs-step-1');

    $form = new Form('cs-step-2', 'horizontal', 'novalidate=true');
    $form->addOption('how-well-do-our-products-meet-your-needs[]', 'Extremely well', 'Extremely well');
    $form->addOption('how-well-do-our-products-meet-your-needs[]', 'Very well', 'Very well');
    $form->addOption('how-well-do-our-products-meet-your-needs[]', 'Somewhat well', 'Somewhat well');
    $form->addOption('how-well-do-our-products-meet-your-needs[]', 'Not so well', 'Not so well');
    $form->addOption('how-well-do-our-products-meet-your-needs[]', 'Not at all well', 'Not at all well');
    $form->addPlugin('bootstrap-select', '.selectpicker');
    $form->addHtml('<span class="help-block">multiple choices - choose at least one</span>', 'how-well-do-our-products-meet-your-needs[]', 'after');
    $form->addSelect('how-well-do-our-products-meet-your-needs[]', 'How well do our products meet your needs ?', 'class=selectpicker show-tick, multiple=multiple, data-selected-text-format=count, required=required');
    $form->addRadio('rate-the-quality-of-our-products', 'Very high quality', 'Very high quality');
    $form->addRadio('rate-the-quality-of-our-products', 'High quality', 'High quality');
    $form->addRadio('rate-the-quality-of-our-products', 'Neither high nor low quality', 'Neither high nor low quality', 'checked=checked');
    $form->addRadio('rate-the-quality-of-our-products', 'Low quality', 'Low quality');
    $form->addRadio('rate-the-quality-of-our-products', 'Very low quality', 'Very low quality');
    $form->printRadioGroup('rate-the-quality-of-our-products', 'How would you rate the quality of our products ?', false, 'required=required');
    $form->addBtn('button', 'back-btn', 2, '<span class="glyphicon glyphicon-circle-arrow-left prepend"></span> Back', 'class=btn btn-sm btn-warning', 'btns');
    $form->addBtn('submit', 'submit-btn', 2, 'Next <span class="glyphicon glyphicon-circle-arrow-right append"></span>', 'class=btn btn-sm btn-success', 'btns');
    $form->printBtnGroup('btns');
} elseif ($current_step == 3) {

    /* ==================================================
        Step 3
    ================================================== */

    $form_id = 'cs-step-3';
    $previous_form = new Form('cs-step-2');

    $form = new Form('cs-step-3', 'horizontal', 'novalidate=true');
    $form->addRadio('rate-the-value-for-money-of-our-products', 'Excellent', 'Excellent');
    $form->addRadio('rate-the-value-for-money-of-our-products', 'Above average', 'Above average');
    $form->addRadio('rate-the-value-for-money-of-our-products', 'Average', 'Average', 'checked=checked');
    $form->addRadio('rate-the-value-for-money-of-our-products', 'Below average', 'Below average');
    $form->addRadio('rate-the-value-for-money-of-our-products', 'Poor', 'Poor');
    $form->printRadioGroup('rate-the-value-for-money-of-our-products', 'How would you rate the value for money of our products ?', false, 'required=required');
    $form->addRadio('responsive-to-questions-about-our-products', 'Extremely responsive', 'Extremely responsive');
    $form->addRadio('responsive-to-questions-about-our-products', 'Very responsive', 'Very responsive');
    $form->addRadio('responsive-to-questions-about-our-products', 'Moderately responsive', 'Moderately responsive', 'checked=checked');
    $form->addRadio('responsive-to-questions-about-our-products', 'Not so responsive', 'Not so responsive');
    $form->addRadio('responsive-to-questions-about-our-products', 'Not at all responsive', 'Not at all responsive');
    $form->addRadio('responsive-to-questions-about-our-products', 'Not applicable', 'Not applicable');
    $form->printRadioGroup('responsive-to-questions-about-our-products', 'How responsive have we been to your questions or concerns about our products ?', false, 'required=required');
    $form->addBtn('button', 'back-btn', 3, '<span class="glyphicon glyphicon-circle-arrow-left prepend"></span> Back', 'class=btn btn-sm btn-warning', 'btns');
    $form->addBtn('submit', 'submit-btn', 3, 'Next <span class="glyphicon glyphicon-circle-arrow-right append"></span>', 'class=btn btn-sm btn-success', 'btns');
    $form->printBtnGroup('btns');
} elseif ($current_step == 4) {

    /* ==================================================
        Step 4
    ================================================== */

    $form_id = 'cs-step-4';
    $previous_form = new Form('cs-step-3');

    $form = new Form('cs-step-4', 'horizontal', 'novalidate=true');
    $form->addRadio('how-long-have-you-been-a-customer-of-our-company', 'This is my first purchase', 'This is my first purchase');
    $form->addRadio('how-long-have-you-been-a-customer-of-our-company', 'Less than six months', 'Less than six months');
    $form->addRadio('how-long-have-you-been-a-customer-of-our-company', 'Six months to a year', 'Six months to a year');
    $form->addRadio('how-long-have-you-been-a-customer-of-our-company', '1 - 2 years', '1 - 2 years');
    $form->addRadio('how-long-have-you-been-a-customer-of-our-company', '3 or more years', '3 or more years');
    $form->addRadio('how-long-have-you-been-a-customer-of-our-company', 'I haven\'t made a purchase yet', 'I haven\'t made a purchase yet');
    $form->printRadioGroup('how-long-have-you-been-a-customer-of-our-company', 'How long have you been a customer of our company ?', false, 'required=required');
    $form->addRadio('how-likely-purchase-products-again', 'Extremely likely', 'Extremely likely');
    $form->addRadio('how-likely-purchase-products-again', 'Very likely', 'Very likely');
    $form->addRadio('how-likely-purchase-products-again', 'Somewhat likely', 'Somewhat likely', 'checked=checked');
    $form->addRadio('how-likely-purchase-products-again', 'Not so likely', 'Not so likely');
    $form->addRadio('how-likely-purchase-products-again', 'Not at all likely', 'Not at all likely');
    $form->printRadioGroup('how-likely-purchase-products-again', 'How likely are you to purchase any of our products again ?', false, 'required=required');
    $form->addBtn('button', 'back-btn', 4, '<span class="glyphicon glyphicon-circle-arrow-left prepend"></span> Back', 'class=btn btn-sm btn-warning', 'btns');
    $form->addBtn('submit', 'submit-btn', 4, 'Next <span class="glyphicon glyphicon-circle-arrow-right append"></span>', 'class=btn btn-sm btn-success', 'btns');
    $form->printBtnGroup('btns');
} elseif ($current_step == 5) {

    /* ==================================================
        Step 5
    ================================================== */

    $form_id = 'cs-step-5';
    $previous_form = new Form('cs-step-4');

    $form = new Form('cs-step-5', 'vertical', 'novalidate=true');
    $form->setOptions(array('inlineRadioLabelClass' => 'radio-label-vertical'));
    $form->addHtml('<div class="radio-label-vertical-wrapper">');
    $form->addRadio('recommend-to-a-friend-or-colleague', 0, '0');
    $form->addRadio('recommend-to-a-friend-or-colleague', 1, '1');
    $form->addRadio('recommend-to-a-friend-or-colleague', 2, '2');
    $form->addRadio('recommend-to-a-friend-or-colleague', 3, '3');
    $form->addRadio('recommend-to-a-friend-or-colleague', 4, '4');
    $form->addRadio('recommend-to-a-friend-or-colleague', 5, '5');
    $form->addRadio('recommend-to-a-friend-or-colleague', 6, '6');
    $form->addRadio('recommend-to-a-friend-or-colleague', 7, '7');
    $form->addRadio('recommend-to-a-friend-or-colleague', 8, '8');
    $form->addRadio('recommend-to-a-friend-or-colleague', 9, '9');
    $form->addRadio('recommend-to-a-friend-or-colleague', 10, '10');
    $form->printRadioGroup('recommend-to-a-friend-or-colleague', 'How likely is it that you would recommend this company to a friend or colleague ?', true, 'required=required');
    $form->addHtml('</div>');
    $form->addTextarea('other-comments', '', 'Do you have any other comments, questions, or concerns ?');
    $form->addBtn('button', 'back-btn', 5, '<span class="glyphicon glyphicon-circle-arrow-left prepend"></span> Back', 'class=btn btn-sm btn-warning', 'btns');
    $form->addBtn('submit', 'submit-btn', 5, 'Submit <span class="glyphicon glyphicon-circle-arrow-right append"></span>', 'class=btn btn-sm btn-success', 'btns');
    $form->printBtnGroup('btns');
}
$form->addPlugin('icheck', 'input', 'default', array('%theme%' => 'flat', '%color%' => 'red'));
$form->printIncludes('css');
$form->render();
$form->printIncludes('js');
$form->printJsCode();
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#<?php echo $form_id; ?>').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'customer-satisfaction-step-form/cs-steps.php',
                type: 'POST',
                data: $(this).serialize()
            }).done(function (data) {
                var targetIndex = $(data).find('button[name="submit-btn"]').val();
                $('#step-' + (targetIndex - 1)).animate({'opacity': 0}, 600);
                $('#step-' + targetIndex).html(data).animate({'opacity': 1}, 600);
                var stepWidth = $('#step-1').width();
                $('#slide').animate({
                    'margin-left': (-(stepWidth * (targetIndex - 1)))
                }, 600);
            });
        });
        if ($('button[name="back-btn"]')[0]) {
            $('button[name="back-btn"]').on('click', function (e) {
                e.preventDefault();
                var targetIndex = ($(this).val() - 1);
                    $('#step-' + (targetIndex + 1)).animate({'opacity': 0}, 600);
                    $('#step-' + targetIndex).animate({'opacity': 1}, 600);
                    var stepWidth = $('#step-1').width();
                    $('#slide').animate({
                        'margin-left': (-(stepWidth * (targetIndex - 1)))
                    }, 600);
            });
        }
    });
</script>
