<?php
use phpforms\Form;

session_start();

/* =============================================
    Forms
============================================= */

$forms = array(
    array(
        'title'      =>  'Car Rental Form',
        'desc'       =>  'Step form with accordion &amp; step validation',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/car-rental-form.php',
        'class'      =>  'order-rental step accordion active',
        'icon'       =>  'icon-car'
    ),
    array(
        'title'      =>  'Contact Form 1',
        'desc'       =>  'Horizontal contact form with captcha',
        'desc-class' =>  '',
        'link'       =>  'templates/forms/contact-form-1.php',
        'class'      =>  'contact-form simple active',
        'icon'       =>  'icon-mail'
    ),
    array(
        'title'      =>  'Contact Form 2',
        'desc'       =>  'Vertical contact form with captcha',
        'desc-class' =>  '',
        'link'       =>  'templates/forms/contact-form-2.php',
        'class'      =>  'contact-form simple active',
        'icon'       =>  'icon-mail-read'
    ),
    array(
        'title'      =>  'Contact Form 3',
        'desc'       =>  'Contact form with rich text editor &amp; dependant field',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/contact-form-3.php',
        'class'      =>  'contact-form simple active',
        'icon'       =>  'icon-phone'
    ),
    array(
        'title'      =>  'Customer Feedback Form',
        'desc'       =>  '2 columns<br>Feedback Form<br>with multiselect',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/customer-feedback-form.php',
        'class'      =>  'simple survey active',
        'icon'       =>  'icon-comments'
    ),
    array(
        'title'      =>  'Customer Satisfaction Step Form',
        'desc'       =>  'Ajax step form with sliding transitions',
        'desc-class' =>  '',
        'link'       =>  'templates/forms/customer-satisfaction-step-form.php',
        'class'      =>  'survey step ajax active',
        'icon'       =>  'icon-chart'
    ),
    array(
        'title'      =>  'CV Submission Form',
        'desc'       =>  'Horizontal form with rich text editor &amp; file upload',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/cv-submission-form.php',
        'class'      =>  'simple file-upload active',
        'icon'       =>  'icon-profile'
    ),
    array(
        'title'      =>  'Join Us Form',
        'desc'       =>  'Horizontal<br>suscribe form',
        'desc-class' =>  '',
        'link'       =>  'templates/forms/join-us-form.php',
        'class'      =>  'simple sign-in active',
        'icon'       =>  'icon-user-plus'
    ),
    array(
        'title'      =>  'Join Us Modal Form',
        'desc'       =>  'Horizontal suscribe Modal form',
        'desc-class' =>  '',
        'link'       =>  'templates/forms/join-us-modal-form.php',
        'class'      =>  'modal-form sign-in active',
        'icon'       =>  'icon-user-plus'
    ),
    array(
        'title'      =>  'Newsletter Suscribe Form',
        'desc'       =>  'Horizontal Newsletter suscribe form',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/newsletter-suscribe-form.php',
        'class'      =>  'simple sign-in active',
        'icon'       =>  'icon-newspaper'
    ),
    array(
        'title'      =>  'Newsletter Suscribe Modal Form',
        'desc'       =>  'Horizontal Newsletter suscribe Modal form',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/newsletter-suscribe-modal-form.php',
        'class'      =>  'modal-form sign-in active',
        'icon'       =>  'icon-newspaper'
    ),
    array(
        'title'      =>  'Order Form',
        'desc'       =>  'Order Form with Payment Method<br>&amp Country select',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/order-form.php',
        'class'      =>  'simple order-rental country-select active',
        'icon'       =>  'icon-tag'
    ),
    array(
        'title'      =>  'Reservation Form',
        'desc'       =>  'Reservation Form date &amp; time pickers, icon select list',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/reservation-form.php',
        'class'      =>  'simple reservation-booking active',
        'icon'       =>  'icon-food'
    ),
    array(
        'title'      =>  'Room Booking Form',
        'desc'       =>  'Booking Form<br>Date Picker,<br>Rich Text Editor',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/room-booking-form.php',
        'class'      =>  'simple reservation-booking active',
        'icon'       =>  'icon-bed'
    ),
    array(
        'title'      =>  'Sign Up Form 1',
        'desc'       =>  'Vertical Form<br>password generator &amp; validation',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/sign-up-form-1.php',
        'class'      =>  'simple sign-in active',
        'icon'       =>  'icon-key'
    ),
    array(
        'title'      =>  'Sign Up Form 2',
        'desc'       =>  'Horizontal Form password generator &amp; validation',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/sign-up-form-2.php',
        'class'      =>  'simple sign-in active',
        'icon'       =>  'icon-unlock-alt'
    ),
    array(
        'title'      =>  'Sign Up Modal Form 1',
        'desc'       =>  'Vertical Modal Form password generator',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/sign-up-modal-form-1.php',
        'class'      =>  'simple modal-form sign-in active',
        'icon'       =>  'icon-key'
    ),
    array(
        'title'      =>  'Sign Up Modal Form 2',
        'desc'       =>  'Horizontal Modal Form password generator',
        'desc-class' =>  ' class="small"',
        'link'       =>  'templates/forms/sign-up-modal-form-2.php',
        'class'      =>  'simple modal-form sign-in active',
        'icon'       =>  'icon-unlock-alt'
    ),
    array(
        'title'      =>  'Simple Step Form',
        'desc'       =>  'Simple Step Form with step validation',
        'desc-class' =>  '',
        'link'       =>  'templates/forms/simple-step-form.php',
        'class'      =>  'simple step active',
        'icon'       =>  'icon-rocket'
    ),
    array(
        'title'      =>  'Special Offer Sign Up',
        'desc'       =>  'Simple Vertical<br>Sign Up Form',
        'desc-class' =>  '',
        'link'       =>  'templates/forms/special-offer-sign-up.php',
        'class'      =>  'simple sign-in active',
        'icon'       =>  'icon-gift'
    )
);
$list = '';
foreach ($forms as $form) {
    $list .= '<a class="grid-item ' . $form['class'] . '" href="' . $form['link'] . '" target="_blank">' . " \n";
    $list .= '<div class="item-content">' . " \n";
    $list .= '<h3>' . $form['title'] . '</h3>' . " \n";
    $list .= '<span class="grid-icon ' . $form['icon'] . '"></span>' . " \n";
    $list .= '</div>' . " \n";
    $list .= '<div class="item-overlay"><p' . $form['desc-class'] . '>' . $form['desc'] . '</p><div class="btn btn-grey">Demo<span class="icon-arrow-right append"></span></div></div>' . " \n";
    $list .= '</a>' . " \n";
}
include_once 'Form.php';
$toggle_templates = new Form('toggle-templates', 'vertical');
/*
accordion
ajax
contact-form
country-select
file-upload
modal-form
order-rental
reservation-booking
sign-in
simple
step
survey
 */
$toggle_templates->addPlugin('icheck', 'input', 'default', array('%theme%' => 'square-custom', '%color%' => 'blue'));
$toggle_templates->addCheckbox('templates-chk', 'Accordion', 'accordion', 'accordion', 'checked');
$toggle_templates->addCheckbox('templates-chk', 'Ajax', 'ajax', 'ajax', 'checked');
$toggle_templates->addCheckbox('templates-chk', 'Contact', 'contact-form', 'contact-form', 'checked');
$toggle_templates->addCheckbox('templates-chk', 'Country Select', 'country-select', 'country-select', 'checked');
$toggle_templates->addCheckbox('templates-chk', 'File Upload', 'file-upload', 'file-upload', 'checked');
$toggle_templates->addCheckbox('templates-chk', 'Modal', 'modal-form', 'modal-form', 'checked');
$toggle_templates->addCheckbox('templates-chk', 'Order / Rental', 'order-rental', 'order-rental', 'checked');
$toggle_templates->addCheckbox('templates-chk', 'Reservation-booking', 'reservation-booking', 'reservation-booking', 'checked');
$toggle_templates->addCheckbox('templates-chk', 'Sign-in', 'sign-in', 'sign-in', 'checked');
$toggle_templates->addCheckbox('templates-chk', 'Simple Form', 'simple', 'simple', 'checked');
$toggle_templates->addCheckbox('templates-chk', 'Step Form', 'step', 'step', 'checked');
$toggle_templates->addCheckbox('templates-chk', 'Survey', 'survey', 'survey', 'checked');
$toggle_templates->printCheckboxGroup('templates-chk', '', false);

/* =============================================
    Elements
============================================= */

$elements = array(
    'input' => array(
        'title'      =>  'input',
        'link'       =>  'documentation/class-doc/index.html#addInput',
        'class'      =>  'e-input active'
    ),
    'input-group' => array(
        'title'      =>  'input group',
        'link'       =>  'documentation/class-doc/index.html#groupInputs',
        'class'      =>  'e-input e-input-group active'
    ),
    'input-group-addon' =>array(
        'title'      =>  'input group addon',
        'link'       =>  'documentation/class-doc/index.html#groupInputs',
        'class'      =>  'e-input e-input-group e-input-group-addon e-custom-html active'
    ),
    'textarea' => array(
        'title'      =>  'textarea',
        'link'       =>  'documentation/class-doc/index.html#addTextarea',
        'class'      =>  'e-textarea active'
    ),
    'select' => array(
        'title'      =>  'select',
        'link'       =>  'documentation/class-doc/index.html#addSelect',
        'class'      =>  'e-select active'
    ),
    'select-country' => array(
        'title'      =>  'select country',
        'link'       =>  'documentation/class-doc/index.html#addCountrySelect',
        'class'      =>  'e-select e-select-country active'
    ),
    'radio' => array(
        'title'      =>  'radio',
        'link'       =>  'documentation/class-doc/index.html#addRadio',
        'class'      =>  'e-radio active'
    ),
    'checkbox' => array(
        'title'      =>  'checkbox',
        'link'       =>  'documentation/class-doc/index.html#addCheckbox',
        'class'      =>  'e-checkbox active'
    ),
    'button' => array(
        'title'      =>  'button',
        'link'       =>  'documentation/class-doc/index.html#addBtn',
        'class'      =>  'e-button active'
    ),
    'button-group' => array(
        'title'      =>  'button group',
        'link'       =>  'documentation/class-doc/index.html#printBtnGroup',
        'class'      =>  'e-button e-button-group active'
    ),
    'custom-html' => array(
        'title'      =>  'custom html',
        'link'       =>  'documentation/class-doc/index.html#addHtml',
        'class'      =>  'e-custom-html active'
    ),
    'file-upload' => array(
        'title'      =>  'file upload',
        'link'       =>  'documentation/class-doc/index.html#fileupload',
        'class'      =>  'e-input e-plugins e-file-upload active'
    ),
    'tinymce' => array(
        'title'      =>  'tinymce',
        'link'       =>  'documentation/class-doc/index.html#tinymce-example',
        'class'      =>  'e-tinymce e-plugins e-textarea active'
    ),
    'bootstrap-select' => array(
        'title'      =>  'bootstrap select',
        'link'       =>  'documentation/class-doc/index.html#bootstrap-select-example',
        'class'      =>  'e-bootstrap-select e-plugins e-select active'
    ),
    'icheck' => array(
        'title'      =>  'icheck',
        'link'       =>  'documentation/class-doc/index.html#icheck-example',
        'class'      =>  'e-icheck e-plugins e-radio e-checkbox active'
    ),
    'colorpicker' => array(
        'title'      =>  'colorpicker',
        'link'       =>  'documentation/class-doc/index.html#colorpicker-example',
        'class'      =>  'e-colorpicker e-plugins e-input active'
    ),
    'datepicker' => array(
        'title'      =>  'datepicker',
        'link'       =>  'documentation/class-doc/index.html#datepicker-example',
        'class'      =>  'e-datepicker e-plugins e-input active'
    ),
    'timepicker' => array(
        'title'      =>  'timepicker',
        'link'       =>  'documentation/class-doc/index.html#timepicker-example',
        'class'      =>  'e-timepicker e-plugins e-input active'
    ),
    'captcha' => array(
        'title'      =>  'captcha',
        'link'       =>  'documentation/class-doc/index.html#captcha-example',
        'class'      =>  'e-captcha e-plugins e-input active'
    ),
    'passfield' => array(
        'title'      =>  'passfield',
        'link'       =>  'documentation/class-doc/index.html#passfield-example',
        'class'      =>  'e-passfield e-plugins e-input active'
    ),
    'wordcharactercount' => array(
        'title'      =>  'wordcharactercount',
        'link'       =>  'documentation/class-doc/index.html#wordcharactercount-example',
        'class'      =>  'e-wordcharactercount e-plugins e-textarea active'
    ),
    'wordcharactercount-tinymce' => array(
        'title'      =>  'wordcharactercount',
        'link'       =>  'documentation/class-doc/index.html#wordcharactercount-example',
        'class'      =>  'e-tinymce e-wordcharactercount e-plugins e-textarea active'
    )
);

$start_code_sm = '<div class="col-lg-4 col-md-6 grid-element"><div class="form-overlay"><div class="form-element">' . " \n";
$start_code_md = '<div class="col-lg-8 grid-element"><div class="form-element">' . " \n";
$end_code = '</div></div></div>' . " \n";
$e_list = '';

/* input */

$form = new Form('form-elements');
$form->addInput('text', 'user-name', '', 'Name', 'required=required');
$code['input']['element'][] = $form->html;
$code['input']['php'][] = '$form->addInput(\'text\', \'user-name\', \'\', \'Name\', \'required=required\');';
$code['input']['start_code'][] = $start_code_sm;
$code['input']['vertical'][] = false;
$code['input']['desc'][] = '';

/* input */

$form = new Form('form-elements', 'vertical');
$form->addInput('text', 'user-name', '', 'Name ', 'required=required');
$code['input']['element'][] = $form->html;
$code['input']['php'][] = '$form->addInput(\'text\', \'user-name\', \'\', \'Name \', \'required=required\');';
$code['input']['start_code'][] = $start_code_sm;
$code['input']['vertical'][] = true;
$code['input']['desc'][] = 'vertical form';

/* input */

$form = new Form('form-elements');
$options = array(
    'horizontalOffsetCol'  => '',
    'horizontalElementCol' => 'col-sm-12'
);
$form->setOptions($options);
$form->addInput('text', 'user-name', '', '', 'placeholder=Name, required=required');
$code['input']['element'][] = $form->html;
$code['input']['php'][] = '$options = array(
    \'horizontalOffsetCol\'  => \'\',
    \'horizontalElementCol\' => \'col-sm-12\'
);
$form->setOptions($options);
$form->addInput(\'text\', \'user-name\', \'\', \'\', \'placeholder=Name, required=required\');';
$code['input']['start_code'][] = $start_code_sm;
$code['input']['vertical'][] = false;
$code['input']['desc'][] = '';

/* input-group */

$form = new Form('form-elements');
$options = array(
    'horizontalLabelCol'   => 'col-sm-2',
    'horizontalOffsetCol'  => 'col-sm-2',
    'horizontalElementCol' => 'col-sm-4'
);
$form->setOptions($options);
$form->groupInputs('user-name', 'user-email');
$form->addInput('text', 'user-name', '', 'Name', 'required=required');
$form->addInput('email', 'user-email', '', 'Email', 'required=required');
$code['input-group']['element'][] = $form->html;
$code['input-group']['php'][] = '$options = array(
    \'horizontalLabelCol\'   => \'col-sm-2\',
    \'horizontalOffsetCol\'  => \'col-sm-2\',
    \'horizontalElementCol\' => \'col-sm-4\'
);
$form->setOptions($options);
$form->groupInputs(\'user-name\', \'user-email\');
$form->addInput(\'text\', \'user-name\', \'\', \'Name : \', \'required=required\');
$form->addInput(\'email\', \'user-email\', \'\', \'Email : \', \'required=required\');';
$code['input-group']['start_code'][] = $start_code_sm;
$code['input-group']['vertical'][] = false;
$code['input-group']['desc'][] = '';

/* input-group */

$form = new Form('form-elements');
$options = array(
        'horizontalLabelCol'       => '',
        'horizontalOffsetCol'      => '',
        'horizontalElementCol'     => 'col-sm-6',
);
$form->setOptions($options);
$form->addHtml('<label>Full name</label>');
$form->groupInputs('first-name', 'last-name');
$form->addHtml('<span class="help-block">First name</span>', 'first-name', 'after');
$form->addInput('text', 'first-name', '', '', 'required=required');
$form->addHtml('<span class="help-block">Last name</span>', 'last-name', 'after');
$form->addInput('text', 'last-name', '', '', 'required=required');
$code['input-group']['element'][] = $form->html;
$code['input-group']['php'][] = '$options = array(
        \'horizontalLabelCol\'       => \'\',
        \'horizontalOffsetCol\'      => \'\',
        \'horizontalElementCol\'     => \'col-sm-6\',
);
$form->setOptions($options);
$form->addHtml(\'<label>Full name</label>\');
$form->groupInputs(\'first-name\', \'last-name\');
$form->addHtml(\'<span class="help-block">First name</span>\', \'first-name\', \'after\');
$form->addInput(\'text\', \'first-name\', \'\', \'\', \'required=required\');
$form->addHtml(\'<span class="help-block">Last name</span>\', \'last-name\', \'after\');
$form->addInput(\'text\', \'last-name\', \'\', \'\', \'required=required\');';
$code['input-group']['start_code'][] = $start_code_sm;
$code['input-group']['vertical'][] = false;
$code['input-group']['desc'][] = 'input group with help blocks';

/* input group addon */

$form = new Form('form-elements');
$options = array(
    'horizontalLabelCol'   => '',
    'horizontalOffsetCol'  => '',
    'horizontalElementCol' => 'col-xs-12');
$form->setOptions($options);
$form->addInputWrapper('<div class="input-group"></div>', 'user-email');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>', 'user-email', 'before');
$form->addInput('email', 'user-email', '', '', 'required=required, placeholder=Email');
$code['input-group-addon']['element'][] = $form->html;
$code['input-group-addon']['php'][] = '$form->addInputWrapper(\'<div class="input-group"></div>\', \'user-email\');
$form->addHtml(\'<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>\', \'user-email\', \'before\');
$form->addInput(\'email\', \'user-email\', \'\', \'\', \'required=required, placeholder=Email\');';
$code['input-group-addon']['start_code'][] = $start_code_sm;
$code['input-group-addon']['vertical'][] = false;
$code['input-group-addon']['desc'][] = '';

/* input group addon */

$form = new Form('form-elements');
$options = array(
        'horizontalLabelCol'       => '',
        'horizontalOffsetCol'      => '',
        'horizontalElementCol'     => 'col-xs-6',
);
$form->setOptions($options);
$form->groupInputs('user-name', 'user-first-name');
$form->addInputWrapper('<div class="input-group"></div>', 'user-name');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>', 'user-name', 'before');
$form->addInput('text', 'user-name', '', '', 'required=required, placeholder=Name');
$form->addInputWrapper('<div class="input-group"></div>', 'user-first-name');
$form->addHtml('<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>', 'user-first-name', 'before');
$form->addInput('text', 'user-first-name', '', '', 'required=required, placeholder=First Name');
$code['input-group-addon']['element'][] = $form->html;
$code['input-group-addon']['php'][] = '$options = array(
        \'horizontalLabelCol\'       => \'\',
        \'horizontalOffsetCol\'      => \'\',
        \'horizontalElementCol\'     => \'col-xs-6\',
);
$form->setOptions($options);
$form->groupInputs(\'user-name\', \'user-first-name\');
$form->addInputWrapper(\'<div class="input-group"></div>\', \'user-name\');
$form->addHtml(\'<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>\', \'user-name\', \'before\');
$form->addInput(\'text\', \'user-name\', \'\', \'\', \'required=required, placeholder=Name\');
$form->addInputWrapper(\'<div class="input-group"></div>\', \'user-first-name\');
$form->addHtml(\'<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>\', \'user-first-name\', \'before\');
$form->addInput(\'text\', \'user-first-name\', \'\', \'\', \'required=required, placeholder=First Name\');';
$code['input-group-addon']['start_code'][] = $start_code_sm;
$code['input-group-addon']['vertical'][] = false;
$code['input-group-addon']['desc'][] = 'input group with icons';

/* textarea */

$form = new Form('form-elements', 'vertical');
$form->addTextarea('message', '', 'Your message', $attr = 'cols=20,rows=5,required=required');
$code['textarea']['element'][] = $form->html;
$code['textarea']['php'][] = '$form->addTextarea(\'message\', \'\', \'Your message\', $attr = \'cols=20,rows=5,required=required\');';
$code['textarea']['start_code'][] = $start_code_sm;
$code['textarea']['vertical'][] = true;
$code['textarea']['desc'][] = 'basic vertical textarea';

/* select */

$form = new Form('form-elements');
$form->addOption('favourite-animal', 'Dog', 'dog');
$form->addOption('favourite-animal', 'cat', 'Cat');
$form->addOption('favourite-animal', 'lion', 'Lion');
$form->addOption('favourite-animal', 'mouse', 'Mouse');
$form->addOption('favourite-animal', 'mammoth', 'Mammoth');
$form->addOption('favourite-animal', 'duck', 'Duck', '', 'selected=selected');
$form->addOption('favourite-animal', 'rabbit', 'Rabbit');
$form->addSelect('favourite-animal', 'Favourite animal');
$code['select']['element'][] = $form->html;
$code['select']['php'][] = '$form->addOption(\'favourite-animal\', \'Dog\', \'dog\');
$form->addOption(\'favourite-animal\', \'cat\', \'Cat\');
$form->addOption(\'favourite-animal\', \'lion\', \'Lion\');
$form->addOption(\'favourite-animal\', \'mouse\', \'Mouse\');
$form->addOption(\'favourite-animal\', \'mammoth\', \'Mammoth\');
$form->addOption(\'favourite-animal\', \'duck\', \'Duck\', \'\', \'selected=selected\');
$form->addOption(\'favourite-animal\', \'rabbit\', \'Rabbit\');
$form->addSelect(\'favourite-animal\', \'Favourite animal\');';
$code['select']['start_code'][] = $start_code_sm;
$code['select']['vertical'][] = false;
$code['select']['desc'][] = 'basic select';

/* select */

$form = new Form('form-elements');
$form->addOption('favourite-animal', 'Dog', 'dog', 'Pets');
$form->addOption('favourite-animal', 'cat', 'Cat', 'Pets');
$form->addOption('favourite-animal', 'rabbit', 'Rabbit', 'Pets', 'selected=selected');
$form->addOption('favourite-animal', 'lion', 'Lion', 'Wild');
$form->addOption('favourite-animal', 'mouse', 'Mouse', 'Others');
$form->addOption('favourite-animal', 'mammoth', 'Mammoth', 'Others');
$form->addOption('favourite-animal', 'duck', 'Duck', 'Others');
$form->addSelect('favourite-animal', 'Favourite animal');
$code['select']['element'][] = $form->html;
$code['select']['php'][] = '$form->addOption(\'favourite-animal\', \'Dog\', \'dog\', \'Pets\');
$form->addOption(\'favourite-animal\', \'cat\', \'Cat\', \'Pets\');
$form->addOption(\'favourite-animal\', \'rabbit\', \'Rabbit\', \'Pets\', \'selected=selected\');
$form->addOption(\'favourite-animal\', \'lion\', \'Lion\', \'Wild\');
$form->addOption(\'favourite-animal\', \'mouse\', \'Mouse\', \'Others\');
$form->addOption(\'favourite-animal\', \'mammoth\', \'Mammoth\', \'Others\');
$form->addOption(\'favourite-animal\', \'duck\', \'Duck\', \'Others\');
$form->addSelect(\'favourite-animal\', \'Favourite animal\');';
$code['select']['start_code'][] = $start_code_sm;
$code['select']['vertical'][] = false;
$code['select']['desc'][] = 'basic select with option groups';

/* select */

$form = new Form('form-elements');
$form->addOption('favourite-animal[]', 'Dog', 'dog');
$form->addOption('favourite-animal[]', 'cat', 'Cat');
$form->addOption('favourite-animal[]', 'lion', 'Lion');
$form->addOption('favourite-animal[]', 'mouse', 'Mouse');
$form->addOption('favourite-animal[]', 'mammoth', 'Mammoth');
$form->addOption('favourite-animal[]', 'duck', 'Duck');
$form->addOption('favourite-animal[]', 'rabbit', 'Rabbit');
$form->addSelect('favourite-animal[]', 'Favourite animal', 'multiple=multiple');
$form->addHtml('<span class="help-block">(multiple choices)</span>', 'favourite-animal[]', 'after');
$code['select']['element'][] = $form->html;
$code['select']['php'][] = '$form->addOption(\'favourite-animal[]\', \'Dog\', \'dog\');
$form->addOption(\'favourite-animal[]\', \'cat\', \'Cat\');
$form->addOption(\'favourite-animal[]\', \'lion\', \'Lion\');
$form->addOption(\'favourite-animal[]\', \'mouse\', \'Mouse\');
$form->addOption(\'favourite-animal[]\', \'mammoth\', \'Mammoth\');
$form->addOption(\'favourite-animal[]\', \'duck\', \'Duck\');
$form->addOption(\'favourite-animal[]\', \'rabbit\', \'Rabbit\');
$form->addSelect(\'favourite-animal[]\', \'Favourite animal\', \'multiple=multiple\');
$form->addHtml(\'<span class="help-block">(multiple choices)</span>\', \'favourite-animal[]\', \'after\');';

$code['select']['start_code'][] = $start_code_sm;
$code['select']['vertical'][] = false;
$code['select']['desc'][] = 'basic multiple select';

/* select-country */

$form = new Form('form-elements');
$form->addCountrySelect('country', 'Country', '', array('flag_size' => 32));
$code['select-country']['element'][] = $form->html;
$code['select-country']['php'][] = '$form->addCountrySelect(\'country\', \'Country\');';
$code['select-country']['start_code'][] = $start_code_sm;
$code['select-country']['vertical'][] = false;
$code['select-country']['desc'][] = '';

/* select-country */

$form = new Form('form-elements-country');
$form->addCountrySelect('country', 'Country', '', array('flag_size' => 16));
$code['select-country']['element'][] = $form->html;
$code['select-country']['php'][] = '$form->addCountrySelect(\'country\', \'Country\', \'\', array(\'flag_size\' => 16));';
$code['select-country']['start_code'][] = $start_code_sm;
$code['select-country']['vertical'][] = false;
$code['select-country']['desc'][] = 'country list with small flags';

/* radio */

$form = new Form('form-elements');
$form->addRadio('support-rating', 'Excellent', 'Excellent');
$form->addRadio('support-rating', 'Good', 'Good', 'checked=checked');
$form->addRadio('support-rating', 'Fair', 'Fair');
$form->addRadio('support-rating', 'Terrible', 'Terrible');
$form->printRadioGroup('support-rating', 'Please rate our support', false, 'required=required');
$code['radio']['element'][] = $form->html;
$code['radio']['php'][] = '$form->addRadio(\'support-rating\', \'Excellent\', \'Excellent\');
$form->addRadio(\'support-rating\', \'Good\', \'Good\', \'checked=checked\');
$form->addRadio(\'support-rating\', \'Fair\', \'Fair\');
$form->addRadio(\'support-rating\', \'Terrible\', \'Terrible\');
$form->printRadioGroup(\'support-rating\', \'Please rate our support\', false, \'required=required\');';
$code['radio']['start_code'][] = $start_code_sm;
$code['radio']['vertical'][] = false;
$code['radio']['desc'][] = 'basic vertical radio';

/* radio */

$form = new Form('form-elements');
$form->addRadio('support-rating', 'Excellent', 'Excellent');
$form->addRadio('support-rating', 'Good', 'Good', 'checked=checked');
$form->addRadio('support-rating', 'Fair', 'Fair');
$form->addRadio('support-rating', 'Terrible', 'Terrible');
$form->printRadioGroup('support-rating', 'Please rate our support', true, 'required=required');
$code['radio']['element'][] = $form->html;
$code['radio']['php'][] = '$form->addRadio(\'support-rating\', \'Excellent\', \'Excellent\');
$form->addRadio(\'support-rating\', \'Good\', \'Good\', \'checked=checked\');
$form->addRadio(\'support-rating\', \'Fair\', \'Fair\');
$form->addRadio(\'support-rating\', \'Terrible\', \'Terrible\');
$form->printRadioGroup(\'support-rating\', \'Please rate our support\', true, \'required=required\');';
$code['radio']['start_code'][] = $start_code_sm;
$code['radio']['vertical'][] = false;
$code['radio']['desc'][] = 'basic inline radio';

/* checkbox */

$form = new Form('form-elements');
$form->addCheckbox('favourite-animal', 'Dog', 'dog', 'dog');
$form->addCheckbox('favourite-animal', 'cat', 'Cat', 'Cat');
$form->addCheckbox('favourite-animal', 'duck', 'Duck', 'Duck');
$form->addCheckbox('favourite-animal', 'rabbit', 'Rabbit', 'Rabbit');
$form->printCheckboxGroup('favourite-animal', 'Favourite animal');
$code['checkbox']['element'][] = $form->html;
$code['checkbox']['php'][] = '$form->addCheckbox(\'favourite-animal\', \'Dog\', \'dog\', \'dog\');
$form->addCheckbox(\'favourite-animal\', \'cat\', \'Cat\', \'Cat\');
$form->addCheckbox(\'favourite-animal\', \'duck\', \'Duck\', \'Duck\');
$form->addCheckbox(\'favourite-animal\', \'rabbit\', \'Rabbit\', \'Rabbit\');
$form->printCheckboxGroup(\'favourite-animal\', \'Favourite animal\');';
$code['checkbox']['start_code'][] = $start_code_sm;
$code['checkbox']['vertical'][] = false;
$code['checkbox']['desc'][] = 'basic inline checkboxes';

/* checkbox */

$form = new Form('form-elements');
$form->addCheckbox('favourite-animal', 'Dog', 'dog', 'dog');
$form->addCheckbox('favourite-animal', 'cat', 'Cat', 'Cat');
$form->addCheckbox('favourite-animal', 'duck', 'Duck', 'Duck');
$form->addCheckbox('favourite-animal', 'rabbit', 'Rabbit', 'Rabbit');
$form->printCheckboxGroup('favourite-animal', 'Favourite animal', false);
$code['checkbox']['element'][] = $form->html;
$code['checkbox']['php'][] = '$form->addCheckbox(\'favourite-animal\', \'Dog\', \'dog\', \'dog\');
$form->addCheckbox(\'favourite-animal\', \'cat\', \'Cat\', \'Cat\');
$form->addCheckbox(\'favourite-animal\', \'duck\', \'Duck\', \'Duck\');
$form->addCheckbox(\'favourite-animal\', \'rabbit\', \'Rabbit\', \'Rabbit\');
$form->printCheckboxGroup(\'favourite-animal\', \'Favourite animal\', false);';
$code['checkbox']['start_code'][] = $start_code_sm;
$code['checkbox']['vertical'][] = false;
$code['checkbox']['desc'][] = 'basic vertical checkboxes';

/* button */

$form = new Form('form-elements');
$form->addBtn('submit', 'submit-btn', 1, 'Send <span class="glyphicon glyphicon-envelope append"></span>', 'class=btn btn-success');
$code['button']['element'][] = $form->html;
$code['button']['php'][] = '$form->addBtn(\'submit\', \'submit-btn\', 1, \'Send <span class="glyphicon glyphicon-envelope append"></span>\', \'class=btn btn-success\');';
$code['button']['start_code'][] = $start_code_sm;
$code['button']['vertical'][] = false;
$code['button']['desc'][] = 'submit button with icon';

/* button-group */

$form = new Form('form-elements');
$form->addBtn('submit', 'submit-btn', 1, 'Send <span class="glyphicon glyphicon-envelope append"></span>', 'class=btn btn-success', 'my-btn-group');
$form->addBtn('cancel', 'cancel-btn', 1, 'Cancel <span class="glyphicon glyphicon-remove-sign append"></span>', 'class=btn btn-danger', 'my-btn-group');
$form->printBtnGroup('my-btn-group');
$code['button-group']['element'][] = $form->html;
$code['button-group']['php'][] = '$form->addBtn(\'submit\', \'submit-btn\', 1, \'Send <span class="glyphicon glyphicon-envelope append"></span>\', \'class=btn btn-success\', \'my-btn-group\');
$form->addBtn(\'cancel\', \'cancel-btn\', 1, \'Cancel <span class="glyphicon glyphicon-remove-sign append"></span>\', \'class=btn btn-danger\', \'my-btn-group\');
$form->printBtnGroup(\'my-btn-group\');';
$code['button-group']['start_code'][] = $start_code_sm;
$code['button-group']['vertical'][] = false;
$code['button-group']['desc'][] = 'button group with icon';

/* custom-html */

$form = new Form('form-elements');
$form->addHtml('<span class="help-block">Enter your name</span>', 'name', 'after');
$form->addInput('text', 'name', '', 'Name');
$form->addHtml('<p class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign prepend"></span> Please read this !</p>');
$code['custom-html']['element'][] = $form->html;
$code['custom-html']['php'][] = '$form->addHtml(\'<span class="help-block">Enter your name</span>\', \'name\', \'after\');
$form->addInput(\'text\', \'name\', \'\', \'Name\');
$form->addHtml(\'<p class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign prepend"></span> Please read this !</p>\');';
$code['custom-html']['start_code'][] = $start_code_sm;
$code['custom-html']['vertical'][] = false;
$code['custom-html']['desc'][] = '';

/* file-upload */

$form = new Form('form-upload');
$fileUpload_config = array(
'xml'                 => 'default',
'uploader'            => 'defaultFileUpload.php',
'btn-text'            => 'Browse ...',
'max-number-of-files' => 3
);
$form->addHtml('<span class="help-block">3 files max. Accepted File Types : .pdf, .doc[x], .xls[x], .txt</span>', 'cv[]', 'after');
$form->addFileUpload('file', 'cv[]', '', 'Upload your CV <br>&amp; Other Testmonials <br>(e.g Certificates)', 'id=cvFileUpload', $fileUpload_config);
$code['file-upload']['element'][] = $form->html;
$code['file-upload']['php'][] = '$fileUpload_config = array(
\'xml\'                 => \'default\',
\'uploader\'            => \'defaultFileUpload.php\',
\'btn-text\'            => \'Browse ...\',
\'max-number-of-files\' => 3
);
$form->addHtml(\'<span class="help-block">3 files max. Accepted File Types : .pdf, .doc[x], .xls[x], .txt</span>\', \'cv[]\', \'after\');
$form->addFileUpload(\'file\', \'cv[]\', \'\', \'Upload your CV <br>&amp; Other Testmonials <br>(e.g Certificates)\', \'id=cvFileUpload\', $fileUpload_config);';
$code['file-upload']['start_code'][] = $start_code_sm;
$code['file-upload']['vertical'][] = false;
$code['file-upload']['desc'][] = '';

/* tinymce */

$form = new Form('form-elements', 'vertical');
$form->addPlugin('tinymce', '#tinymce-message', 'contact-config');
$form->addTextarea('tinymce-message', '', 'Your message');
$code['tinymce']['element'][] = $form->html;
$code['tinymce']['php'][] = '$form->addPlugin(\'tinymce\', \'#tinymce-message\', \'contact-config\');
$form->addTextarea(\'message\', \'\', \'Your message\');';
$code['tinymce']['start_code'][] = $start_code_sm;
$code['tinymce']['vertical'][] = true;
$code['tinymce']['desc'][] = 'tinymce basic config';

/* bootstrap-select */

$form = new Form('form-elements', 'vertical');
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
$code['bootstrap-select']['element'][] = $form->html;
$code['bootstrap-select']['php'][] = '$form->addOption(\'reservation-type\', \'Dinner\', \'Dinner\', \'\', \'data-icon=fa fa-cutlery\');
$form->addOption(\'reservation-type\', \'Birthday/ Anniversary\', \'Birthday/ Anniversary\', \'\', \'data-icon=fa fa-birthday-cake\');
$form->addOption(\'reservation-type\', \'Nightlife\', \'Nightlife\', \'\', \'data-icon=fa fa-moon-o\');
$form->addOption(\'reservation-type\', \'Private\', \'Private\', \'\', \'data-icon=fa fa-user-secret\');
$form->addOption(\'reservation-type\', \'Wedding\', \'Wedding\', \'\', \'data-icon=fa fa-heart\');
$form->addOption(\'reservation-type\', \'Corporate\', \'Corporate\', \'\', \'data-icon=fa fa-briefcase\');
$form->addOption(\'reservation-type\', \'Other\', \'Other\', \'\', \'data-icon=fa fa-star\');
$form->addSelect(\'reservation-type\', \'Reservation Type\', \'class=selectpicker show-tick\');
$form->addHtml(\'<div class="hidden-wrapper off">\');
$form->addInput(\'text\', \'reservation-type-other\', \'\', \'\', \'placeholder=Please tell more ...\');
$form->addHtml(\'</div>\');
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
<!-- jQuery to show / hide dependant fields -->
    <script type="text/javascript">
        $(document).ready(function () {
            $(\'select[name="reservation-type"]\').on(\'change\', function () {
                if ($(this).val() == \'Other\') {
                    $(\'.hidden-wrapper\').removeClass(\'off\');
                } else {
                    $(\'.hidden-wrapper\').addClass(\'off\');
                }
            });
        });
    </script>
';
$code['bootstrap-select']['start_code'][] = $start_code_sm;
$code['bootstrap-select']['vertical'][] = true;
$code['bootstrap-select']['desc'][] = 'select with icons &amp; dependant field';

/* bootstrap-select */

$form = new Form('form-elements', 'vertical');

$form->addOption('product-choice[]', 'Computers', 'Computers', '', 'data-icon=glyphicon-hdd');
$form->addOption('product-choice[]', 'Games', 'Games', '', 'data-icon=glyphicon-send');
$form->addOption('product-choice[]', 'Books', 'Books', '', 'selected, data-icon=glyphicon-book');
$form->addOption('product-choice[]', 'Music', 'Music', '', 'selected, data-icon=glyphicon-headphones');
$form->addOption('product-choice[]', 'Photos', 'Photos', '', 'data-icon=glyphicon-picture');
$form->addOption('product-choice[]', 'Films', 'Films', '', 'data-icon=glyphicon-film');
$form->addHtml('<span class="help-block">(multiple choices)</span>', 'product-choice[]', 'after');
$form->addSelect('product-choice[]', 'What products are you interested in ?', 'class=selectpicker, required=required, multiple=multiple');
$code['bootstrap-select']['element'][] = $form->html;
$code['bootstrap-select']['php'][] = '$form->addOption(\'product-choice[]\', \'Computers\', \'Computers\', \'\', \'data-icon=glyphicon-hdd\');
$form->addOption(\'product-choice[]\', \'Games\', \'Games\', \'\', \'data-icon=glyphicon-send\');
$form->addOption(\'product-choice[]\', \'Books\', \'Books\', \'\', \'selected, data-icon=glyphicon-book\');
$form->addOption(\'product-choice[]\', \'Music\', \'Music\', \'\', \'selected, data-icon=glyphicon-headphones\');
$form->addOption(\'product-choice[]\', \'Photos\', \'Photos\', \'\', \'data-icon=glyphicon-picture\');
$form->addOption(\'product-choice[]\', \'Films\', \'Films\', \'\', \'data-icon=glyphicon-film\');
$form->addHtml(\'<span class="help-block">(multiple choices)</span>\', \'product-choice[]\', \'after\');
$form->addSelect(\'product-choice[]\', \'What products are you interested in ?\', \'class=selectpicker, required=required, multiple=multiple\');';
$code['bootstrap-select']['start_code'][] = $start_code_sm;
$code['bootstrap-select']['vertical'][] = true;
$code['bootstrap-select']['desc'][] = 'select multiple with icons';

/* bootstrap-select */

$form = new Form('form-elements', 'vertical');
$form->addOption('reservation-type', 'Dinner', 'Dinner', '', 'data-icon=fa fa-cutlery');
$form->addOption('reservation-type', 'Birthday/ Anniversary', 'Birthday/ Anniversary', '', 'data-icon=fa fa-birthday-cake, selected=selected');
$form->addOption('reservation-type', 'Nightlife', 'Nightlife', '', 'data-icon=fa fa-moon-o');
$form->addOption('reservation-type', 'Private', 'Private', '', 'data-icon=fa fa-user-secret');
$form->addOption('reservation-type', 'Wedding', 'Wedding', '', 'data-icon=fa fa-heart');
$form->addOption('reservation-type', 'Corporate', 'Corporate', '', 'data-icon=fa fa-briefcase');
$form->addSelect('reservation-type', 'Reservation Type', 'data-style=btn-info,class=selectpicker show-tick');
$code['bootstrap-select']['element'][] = $form->html;
$code['bootstrap-select']['php'][] = '$form->addOption(\'reservation-type\', \'Dinner\', \'Dinner\', \'\', \'data-icon=fa fa-cutlery\');
$form->addOption(\'reservation-type\', \'Birthday/ Anniversary\', \'Birthday/ Anniversary\', \'\', \'data-icon=fa fa-birthday-cake, selected=selected\');
$form->addOption(\'reservation-type\', \'Nightlife\', \'Nightlife\', \'\', \'data-icon=fa fa-moon-o\');
$form->addOption(\'reservation-type\', \'Private\', \'Private\', \'\', \'data-icon=fa fa-user-secret\');
$form->addOption(\'reservation-type\', \'Wedding\', \'Wedding\', \'\', \'data-icon=fa fa-heart\');
$form->addOption(\'reservation-type\', \'Corporate\', \'Corporate\', \'\', \'data-icon=fa fa-briefcase\');
$form->addSelect(\'reservation-type\', \'Reservation Type\', \'data-style=btn-info,class=selectpicker show-tick\');';
$code['bootstrap-select']['start_code'][] = $start_code_sm;
$code['bootstrap-select']['vertical'][] = true;
$code['bootstrap-select']['desc'][] = 'select styled with icons';

/* icheck */

$form = new Form('form-elements');
$form->addRadio('support-rating', 'Excellent', 'Excellent');
$form->addRadio('support-rating', 'Good', 'Good', 'checked=checked');
$form->addRadio('support-rating', 'Fair', 'Fair');
$form->addRadio('support-rating', 'Terrible', 'Terrible');
$form->printRadioGroup('support-rating', 'Please rate our support', true, 'required=required');
$form->addPlugin('icheck', 'input', 'default', array('%theme%' => 'square-custom', '%color%' => 'blue'));
$code['icheck']['element'][] = $form->html;
$code['icheck']['php'][] = '$form->addRadio(\'support-rating\', \'Excellent\', \'Excellent\');
$form->addRadio(\'support-rating\', \'Good\', \'Good\', \'checked=checked\');
$form->addRadio(\'support-rating\', \'Fair\', \'Fair\');
$form->addRadio(\'support-rating\', \'Terrible\', \'Terrible\');
$form->printRadioGroup(\'support-rating\', \'Please rate our support\', true, \'required=required\');
$form->addPlugin(\'icheck\', \'input\', \'default\', array(\'%theme%\' => \'square-custom\', \'%color%\' => \'blue\'));';
$code['icheck']['start_code'][] = $start_code_sm;
$code['icheck']['vertical'][] = false;
$code['icheck']['desc'][] = 'radio + iCheck plugin square blue';

/* icheck */

$form = new Form('form-elements');
$form->addCheckbox('favourite-animal', 'Dog', 'dog', 'dog');
$form->addCheckbox('favourite-animal', 'cat', 'Cat', 'Cat');
$form->addCheckbox('favourite-animal', 'duck', 'Duck', 'Duck', 'checked=checked');
$form->addCheckbox('favourite-animal', 'rabbit', 'Rabbit', 'Rabbit');
$form->printCheckboxGroup('favourite-animal', 'Favourite animal');
$form->addPlugin('icheck', 'input', 'default', array('%theme%' => 'square-custom', '%color%' => 'blue'));
$code['icheck']['element'][] = $form->html;
$code['icheck']['php'][] = '$form->addCheckbox(\'favourite-animal\', \'Dog\', \'dog\', \'dog\');
$form->addCheckbox(\'favourite-animal\', \'cat\', \'Cat\', \'Cat\');
$form->addCheckbox(\'favourite-animal\', \'duck\', \'Duck\', \'Duck\', \'checked=checked\');
$form->addCheckbox(\'favourite-animal\', \'rabbit\', \'Rabbit\', \'Rabbit\');
$form->printCheckboxGroup(\'favourite-animal\', \'Favourite animal\');
$form->addPlugin(\'icheck\', \'input\', \'default\', array(\'%theme%\' => \'square-custom\', \'%color%\' => \'blue\'));';
$code['icheck']['start_code'][] = $start_code_sm;
$code['icheck']['vertical'][] = false;
$code['icheck']['desc'][] = 'checkbox + iCheck plugin square blue';

/* icheck */

$form = new Form('form-elements');
$form->addRadio('support-rating', 'Excellent', 'Excellent');
$form->addRadio('support-rating', 'Good', 'Good', 'checked=checked');
$form->addRadio('support-rating', 'Fair', 'Fair');
$form->addRadio('support-rating', 'Terrible', 'Terrible');
$form->printRadioGroup('support-rating', 'Please rate our support', true, 'required=required');
$form->addPlugin('icheck', 'input', 'default', array('%theme%' => 'flat', '%color%' => 'red'));
$code['icheck']['element'][] = $form->html;
$code['icheck']['php'][] = '$form->addRadio(\'support-rating\', \'Excellent\', \'Excellent\');
$form->addRadio(\'support-rating\', \'Good\', \'Good\', \'checked=checked\');
$form->addRadio(\'support-rating\', \'Fair\', \'Fair\');
$form->addRadio(\'support-rating\', \'Terrible\', \'Terrible\');
$form->printRadioGroup(\'support-rating\', \'Please rate our support\', true, \'required=required\');
$form->addPlugin(\'icheck\', \'input\', \'default\', array(\'%theme%\' => \'flat\', \'%color%\' => \'red\'));';
$code['icheck']['start_code'][] = $start_code_sm;
$code['icheck']['vertical'][] = false;
$code['icheck']['desc'][] = 'radio with iCheck plugin flat red';

/* icheck */

$form = new Form('form-elements');
$form->addCheckbox('favourite-animal', 'Dog', 'dog', 'dog');
$form->addCheckbox('favourite-animal', 'cat', 'Cat', 'Cat');
$form->addCheckbox('favourite-animal', 'duck', 'Duck', 'Duck', 'checked=checked');
$form->addCheckbox('favourite-animal', 'rabbit', 'Rabbit', 'Rabbit');
$form->printCheckboxGroup('favourite-animal', 'Favourite animal');
$form->addPlugin('icheck', 'input', 'default', array('%theme%' => 'flat', '%color%' => 'red'));
$code['icheck']['element'][] = $form->html;
$code['icheck']['php'][] = '$form->addCheckbox(\'favourite-animal\', \'Dog\', \'dog\', \'dog\');
$form->addCheckbox(\'favourite-animal\', \'cat\', \'Cat\', \'Cat\');
$form->addCheckbox(\'favourite-animal\', \'duck\', \'Duck\', \'Duck\', \'checked=checked\');
$form->addCheckbox(\'favourite-animal\', \'rabbit\', \'Rabbit\', \'Rabbit\');
$form->printCheckboxGroup(\'favourite-animal\', \'Favourite animal\');
$form->addPlugin(\'icheck\', \'input\', \'default\', array(\'%theme%\' => \'flat\', \'%color%\' => \'red\'));';
$code['icheck']['start_code'][] = $start_code_sm;
$code['icheck']['vertical'][] = false;
$code['icheck']['desc'][] = 'checkbox + iCheck plugin flat red';

/* colorpicker */

$form = new Form('form-elements');
$form->addPlugin('colorpicker', '#pick-a-color');
$form->addInput('text', 'pick-a-color', '', 'Pick a color', '');
$code['colorpicker']['element'][] = $form->html;
$code['colorpicker']['php'][] = '$form->addPlugin(\'colorpicker\', \'#pick-a-color\');
$form->addInput(\'text\', \'pick-a-color\', \'\', \'Pick a color\', \'\');';
$code['colorpicker']['start_code'][] = $start_code_sm;
$code['colorpicker']['vertical'][] = false;
$code['colorpicker']['desc'][] = '';

/* datepicker */

$form = new Form('form-elements');
$form->addPlugin('datepicker', '#pick-a-date');
$form->addInput('text', 'pick-a-date', '06/09/2015', 'Pick a date', '');
$code['datepicker']['element'][] = $form->html;
$code['datepicker']['php'][] = '$form->addPlugin(\'datepicker\', \'#pick-a-date\');
$form->addInput(\'text\', \'pick-a-date\', \'06/09/2015\', \'Pick a date\', \'\');';
$code['datepicker']['start_code'][] = $start_code_sm;
$code['datepicker']['vertical'][] = false;
$code['datepicker']['desc'][] = '';

/* datepicker */

$form = new Form('form-elements');
$form->addPlugin('datepicker', '#date-custom-format', 'Y-m-d');
$form->addInput('text', 'date-custom-format', '2015-06-09', 'Pick a date (Y-m-d)');
$code['datepicker']['element'][] = $form->html;
$code['datepicker']['php'][] = '$form->addPlugin(\'datepicker\', \'#date-custom-format\', \'Y-m-d\');
$form->addInput(\'text\', \'date-custom-format\', \'2015-06-09\', \'Pick a date (Y-m-d)\');';
$code['datepicker']['start_code'][] = $start_code_sm;
$code['datepicker']['vertical'][] = false;
$code['datepicker']['desc'][] = 'date picker with custom format';

/* timepicker */

$form = new Form('form-elements');
$form->addPlugin('timepicker', '#pick-a-time');
$form->addInput('text', 'pick-a-time', '6:30am', 'Pick a time');
$code['timepicker']['element'][] = $form->html;
$code['timepicker']['php'][] = '$form->addPlugin(\'timepicker\', \'#pick-a-time\');
$form->addInput(\'text\', \'pick-a-time\', \'6:30am\', \'Pick a time\');';
$code['timepicker']['start_code'][] = $start_code_sm;
$code['timepicker']['vertical'][] = false;
$code['timepicker']['desc'][] = '';

/* captcha */

$form = new Form('form-elements');
$options = array(
        'horizontalLabelCol'       => 'col-sm-3',
        'horizontalOffsetCol'      => 'col-sm-offset-3',
        'horizontalElementCol'     => 'col-sm-9',
);
$form->setOptions($options);
$form->addInput('text', 'captcha', '', 'Type the following characters :', 'size=15');
$form->addPlugin('captcha', '#captcha');
$code['captcha']['element'][] = $form->html;
$code['captcha']['php'][] = '$form->addInput(\'text\', \'captcha\', \'\', \'Type the following characters :\', \'size=15\');
$form->addPlugin(\'captcha\', \'#captcha\');';
$code['captcha']['start_code'][] = $start_code_sm;
$code['captcha']['vertical'][] = false;
$code['captcha']['desc'][] = '';

/* passfield */

$form = new Form('form-elements');
$form->addPlugin('passfield', '#user-password-1');
$form->addHtml('<span class="help-block">password must contain lowercase letters and be 8 characters long</span>', 'user-password-1', 'after');
$form->addInput('password', 'user-password-1', '', 'password', 'required=required');
$code['passfield']['element'][] = $form->html;
$code['passfield']['php'][] = '$form->addPlugin(\'passfield\', \'#user-password-1\');
$form->addHtml(\'<span class="help-block">password must contain lowercase + uppercase letters + number + symbol and be 8 characters long</span>\', \'user-password-1\', \'after\');
$form->addInput(\'password\', \'user-password-1\', \'\', \'password\', \'required=required\');';
$code['passfield']['start_code'][] = $start_code_sm;
$code['passfield']['vertical'][] = false;
$code['passfield']['desc'][] = 'password with default format';

/* passfield */

$form = new Form('form-elements');
$form->addPlugin('passfield', '#user-password-2', 'lower-upper-number-symbol-min8');
$form->addHtml('<span class="help-block">password must contain lowercase + uppercase letters + number + symbol and be 8 characters long</span>', 'user-password-2', 'after');
$form->addInput('password', 'user-password-2', '', 'password', 'required=required');
$code['passfield']['element'][] = $form->html;
$code['passfield']['php'][] = '$form->addPlugin(\'passfield\', \'#user-password-2\', \'lower-upper-number-symbol-min8\');
$form->addHtml(\'<span class="help-block">password must contain lowercase + uppercase letters + number + symbol and be 8 characters long</span>\', \'user-password-2\', \'after\');
$form->addInput(\'password\', \'user-password-2\', \'\', \'password\', \'required=required\');';
$code['passfield']['start_code'][] = $start_code_sm;
$code['passfield']['vertical'][] = false;
$code['passfield']['desc'][] = 'password custom format';

/* wordcharactercount */

$form = new Form('form-elements');
$form->addTextarea('message-max-100', '', 'Your message', 'required=required');
$form->addPlugin('word-character-count', '#message-max-100', 'default', array('%maxAuthorized%' => 100));
$code['wordcharactercount']['element'][] = $form->html;
$code['wordcharactercount']['php'][] = '$form->addPlugin(\'word-character-count\', \'#message-max-100\', \'default\', array(\'%maxAuthorized%\' => 100));';
$code['wordcharactercount']['start_code'][] = $start_code_sm;
$code['wordcharactercount']['vertical'][] = false;
$code['wordcharactercount']['desc'][] = 'word / char counter';

/* wordcharactercount-tinymce */

$form = new Form('form-elements', 'vertical');
$form->addTextarea('tinymce-word-char-count', '', 'tinymce : ', 'cols=10, rows=1, class=tinyMce');
$form->addPlugin('tinymce', '#tinymce-word-char-count', 'word_char_count', array('%maxAuthorized%' => 200));
$code['wordcharactercount-tinymce']['element'][] = $form->html;
$code['wordcharactercount-tinymce']['php'][] = '$form->addTextarea(\'tinymce-word-char-count\', \'\', \'tinymce : \', \'cols=100, rows=20, class=tinyMce\');
$form->addPlugin(\'tinymce\', \'#tinymce-word-char-count\', \'word_char_count\', array(\'%maxAuthorized%\' => 200));';
$code['wordcharactercount-tinymce']['start_code'][] = $start_code_sm;
$code['wordcharactercount-tinymce']['vertical'][] = true;
$code['wordcharactercount-tinymce']['desc'][] = 'word / char counter + tinyMce';

foreach ($code as $e => $array) {
    for ($i=0; $i < count($code[$e]['element']); $i++) {
        $form_html = $code[$e]['element'][$i];
        $form_php = $code[$e]['php'][$i];
        $e_list .= preg_replace('`grid-element`', 'grid-element ' . $elements[$e]['class'], $code[$e]['start_code'][$i]);
        $e_list .= '<div class="e-header col-sm-12 clearfix">' . " \n";
        $e_list .= '<span class="e-title">' . $elements[$e]['title'] . '</span>' . " \n";
        $form_class = 'form-horizontal';
        if ($code[$e]['vertical'][$i] == true) {
            $form_class = '';
        }
        if (!empty($code[$e]['desc'][$i])) {
            $e_list .= '<span class="e-info">' . $code[$e]['desc'][$i] . '</span>' . " \n";
        }
        $e_list .= '<a href="' . $elements[$e]['link'] . '" class="e-link clearfix" target="_blank">documentation<span class="icon-arrow-right append"></span></a>' . " \n";
        $e_list .= '</div>' . " \n";
        $e_list .= '<div class="e-form clearfix">' . " \n";
        if (preg_match('`fileUpload`', $form_php)) {
            $e_list .= '<form class="' . $form_class . '" name="form-upload" id="form-upload">' . $form_html . '</form>' . " \n";
        } elseif (preg_match('`tinymce-word-char-count`', $form_php)) {
            $e_list .= '<form class="' . $form_class . ' e-tinymce-word-char-count">' . $form_html . '</form>' . " \n";
        } elseif (preg_match('`tinymce`', $form_php)) {
            $e_list .= '<form class="' . $form_class . ' e-tinymce">' . $form_html . '</form>' . " \n";
        } elseif (preg_match('`icheck`', $form_php) && preg_match('`square`', $form_php)) {
            $e_list .= '<form class="' . $form_class . ' e-icheck-square">' . $form_html . '</form>' . " \n";
        } elseif (preg_match('`icheck`', $form_php) && preg_match('`flat`', $form_php)) {
            $e_list .= '<form class="' . $form_class . ' e-icheck-flat">' . $form_html . '</form>' . " \n";
        } else {
            $e_list .= '<form class="' . $form_class . '">' . $form_html . '</form>' . " \n";
        }
        $e_list .= '</div>' . " \n";
        $e_list .= '<div class="e-code">' . " \n";
        $e_list .= '<pre class="prettyprint">' . htmlspecialchars($form_php) . '</pre>' . " \n";
        $e_list .= '</div>' . " \n";
        $e_list .= $end_code;
    }
}

/* register all plugins for demo */

$form = new Form('form-elements');
$form->addPlugin('bootstrap-select', '', 'countries-flags-16');
$form->addPlugin('bootstrap-select', '', 'countries-flags-32');
$form->addPlugin('captcha', '#captcha');
$form->addPlugin('colorpicker', '#pick-a-color');
$form->addPlugin('datepicker', '#pick-a-date');
$form->addPlugin('datepicker', '#date-custom-format', 'Y-m-d');
$form->addPlugin('icheck', '.e-icheck-square input', 'default', array('%theme%' => 'square-custom', '%color%' => 'blue'));
$form->addPlugin('icheck', '.e-icheck-flat input', 'default', array('%theme%' => 'flat', '%color%' => 'red'));
$form->addPlugin('passfield', '#user-password-1');
$form->addPlugin('passfield', '#user-password-2', 'lower-upper-number-symbol-min8');
$form->addPlugin('timepicker', '#pick-a-time');
$form->addPlugin('tinymce', '#tinymce-message', 'contact-config');
$form->addPlugin('word-character-count', '#message-max-100', 'default', array('%maxAuthorized%' => 100));
$form->addPlugin('tinymce', '#tinymce-word-char-count', 'word_char_count', array('%maxAuthorized%' => 200));

// file upload needs a new form

$form_upload = new Form('form-upload');
$fileUpload_config = array(
'xml'                 => 'default',
'uploader'            => 'defaultFileUpload.php',
'btn-text'            => 'Browse ...',
'max-number-of-files' => 3
);
$form_upload->addFileUpload('file', 'cv[]', '', 'Upload your CV <br>&amp; Other Testmonials <br>(e.g Certificates)', 'id=cvFileUpload', $fileUpload_config);

$toggle_elements = new Form('toggle-elements', 'vertical');
$toggle_elements->addPlugin('icheck', 'input', 'default', array('%theme%' => 'square-custom', '%color%' => 'blue'));
$toggle_elements->addCheckbox('e-chk', 'input', 'e-input', 'e-input', 'checked');
$toggle_elements->addCheckbox('e-chk', 'input group', 'e-input-group', 'e-input-group', 'checked');
$toggle_elements->addCheckbox('e-chk', 'input group addon', 'e-input-group-addon', 'e-input-group-addon', 'checked');
$toggle_elements->addCheckbox('e-chk', 'textarea', 'e-textarea', 'e-textarea', 'checked');
$toggle_elements->addCheckbox('e-chk', 'select', 'e-select', 'e-select', 'checked');
$toggle_elements->addCheckbox('e-chk', 'select country', 'e-select-country', 'e-select-country', 'checked');
$toggle_elements->addCheckbox('e-chk', 'radio', 'e-radio', 'e-radio', 'checked');
$toggle_elements->addCheckbox('e-chk', 'checkbox', 'e-checkbox', 'e-checkbox', 'checked');
$toggle_elements->addCheckbox('e-chk', 'button', 'e-button', 'e-button', 'checked');
$toggle_elements->addCheckbox('e-chk', 'button group', 'e-button-group', 'e-button-group', 'checked');
$toggle_elements->addCheckbox('e-chk', 'custom html', 'e-custom-html', 'e-custom-html', 'checked');
$toggle_elements->addCheckbox('e-chk', 'file upload', 'e-file-upload', 'e-file-upload', 'checked');
$toggle_elements->addCheckbox('e-chk', 'tinymce', 'e-tinymce', 'e-tinymce', 'checked');
$toggle_elements->addCheckbox('e-chk', 'bootstrap select', 'e-bootstrap-select', 'e-bootstrap-select', 'checked');
$toggle_elements->addCheckbox('e-chk', 'icheck', 'e-icheck', 'e-icheck', 'checked');
$toggle_elements->addCheckbox('e-chk', 'colorpicker', 'e-colorpicker', 'e-colorpicker', 'checked');
$toggle_elements->addCheckbox('e-chk', 'datepicker', 'e-datepicker', 'e-datepicker', 'checked');
$toggle_elements->addCheckbox('e-chk', 'timepicker', 'e-timepicker', 'e-timepicker', 'checked');
$toggle_elements->addCheckbox('e-chk', 'captcha', 'e-captcha', 'e-captcha', 'checked');
$toggle_elements->addCheckbox('e-chk', 'passfield', 'e-passfield', 'e-passfield', 'checked');
$toggle_elements->addCheckbox('e-chk', 'wordcharactercount', 'e-wordcharactercount', 'e-wordcharactercount', 'checked');
$toggle_elements->printCheckboxGroup('e-chk', '', false);
?>
<html>
<head>
    <meta charset="utf-8">
    <title>PhpForms - PHP Form Class For Bootstrap</title>
    <meta name="description" content="A simple but powerfull class to create forms, validate posted values, send emails or record results to database easily">
    <meta name="author" content="Gilles Migliori">
    <meta name="copyright" content="Gilles Migliori">
    <link href="templates/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="documentation/assets/css/documenter.css" media="screen">
    <link rel="stylesheet" href="templates/assets/css/demo-style.css" media="screen">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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
    <link rel="stylesheet" href="documentation/assets/js/google-code-prettify/prettify.css" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,500' rel='stylesheet' type='text/css'>
    <link href="plugins/icheck/skins/square-custom/blue.css" rel="stylesheet" media="screen">
    <?php
    $form->printIncludes('css');
    $form_upload->printIncludes('css');
    ?>
    <link rel="shortcut icon" type="image/x-icon" href="documentation/favicon.ico" />
</head>
<body class="documenter-project-phpforms">
    <div id="navbar">
        <a href="#documenter_cover" id="documenter_logo"></a>
        <ul id="navbar-links-wrapper">
            <li><a href="#forms-templates" class="doc-link active">Form Templates</a></li>
            <li><a href="#forms-elements" class="doc-link">Form Elements <small>with code</small></a></li>
            <li><a href="documentation/index.html" class="doc-link">Quick Start Guide</a></li>
            <li><a href="documentation/class-doc/index.html" class="doc-link">Complete Class Doc</a></li>
        </ul>
    </div>
    <div id="documenter_sidebar">
        <div id="filter-forms">
            <h3>Filter Forms List</h3>
            <a href="#" id="toggle-all-forms" class="btn btn-grey btn-toggle"><span class="icon-checkbox-unchecked prepend"></span>Toggle All Forms</a>
            <?php echo $toggle_templates->html; ?>
        </div>
        <div id="filter-elements">
            <h3>Filter Elements List</h3>
            <a href="#" id="toggle-all-elements" class="btn btn-grey btn-toggle"><span class="icon-checkbox-unchecked prepend"></span>Toggle All Elements</a>
            <?php echo $toggle_elements->html; ?>
        </div>
    </div>
    <div id="documenter_content">
        <h1 id="forms-templates">Forms Templates</h1>
        <div class="grid" id="grid-forms">
            <?php echo $list; ?>
        </div>
        <h1 id="forms-elements">Forms Elements</h1>
        <div class="grid row" id="grid-elements">
            <?php echo $e_list; ?>
        </div>
    </div>
    <script src="documentation/assets/js/jquery.js"></script>
    <script src="documentation/assets/js/jquery.scrollTo.js"></script>
    <script src="documentation/assets/js/jquery.easing.js"></script>
    <script src="documentation/assets/js/bootstrap.min.js"></script>
    <script src="templates/assets/js/isotope.pkgd.min.js"></script>
    <script src="templates/assets/js/hoverIntent.minified.js"></script>
    <script src="documentation/assets/js/google-code-prettify/prettify.js"></script>
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
    <?php
        $form->printIncludes('js');
        $form_upload->printIncludes('js');
        $form->printJsCode();
        $form_upload->printJsCode();
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            /* jshint jquery: true, browser: true */
            'use strict';
            var gridForms = $('#navbar a[href="#grid-forms"]'),
                gridElements = $('#navbar a[href="#grid-elements"]');
            var showElements = function () {
                $('#filter-forms').fadeOut(500);
                $('#filter-elements').fadeIn(500);
            };
            var showForms = function () {
                $('#filter-forms').fadeIn(500);
                $('#filter-elements').fadeOut(500);
            };
            $('#filter-forms, #filter-elements').css({'position': 'absolute', 'top': 0});
            // show right filters onload
            $('#filter-elements').hide();
            // code slide toggle
            $('.e-code').css('display', 'none');
            $('.e-form').each(function () {
                var eForm = this,
                    formElement = $(eForm).parent('.form-element'),
                    overlay = $(formElement).parent('.form-overlay');
                $(eForm).hoverIntent({
                    over: function () {
                        $(eForm).next('.e-code').css('z-index', 20).slideDown(200);
                        $(overlay).css('z-index', 30).on('mouseleave', function () {
                            $(overlay).css('z-index', 10);
                            $(eForm).next('.e-code').css('z-index', 10).slideUp(200);
                        });
                    },
                    out: function () {
                        return false;
                    }
                });
            });
            // isotope
            $('#grid-forms').isotope({
              itemSelector: '.grid-item',
              layoutMode: 'masonry'
            });
            $('#grid-elements').isotope({
              itemSelector: '.grid-element',
              layoutMode: 'fitRows'
            });
            // scrollspy smoothscroll
            $('#navbar a[href^="#"]').on('click', function (e) {
               e.preventDefault();
               var hash = $(this).attr('href');
               $('#navbar a[href^="#"]').removeClass('active');
               $(this).addClass('active');
               $('html, body').animate({
                   scrollTop: ($(hash).offset().top)
                 }, 500);
            });
            $('#grid-forms').css('min-height', $('#grid-forms').height());
            $(window).on('scroll', function () {
                if ($('#grid-elements').position().top - $('body').scrollTop() <= 350) {
                    if (gridForms.hasClass('active')) {
                        gridForms.removeClass('active');
                        gridElements.addClass('active');
                    }
                    showElements();
                } else {
                    if (gridElements.hasClass('active')) {
                        gridElements.removeClass('active');
                        gridForms.addClass('active');
                    }
                    showForms();
                }
            });
            $(window).trigger('scroll');
            $('#filter-forms input, #filter-elements input').iCheck({
                checkboxClass: 'icheckbox_square-custom-blue',
                radioClass: 'iradio_square-custom-blue'
            });
            // Filter forms
            $('#toggle-all-forms').on('click', function (e) {
                e.preventDefault();
                if ($('#grid-forms').find('.active')[0]) {
                    $('#filter-forms input').iCheck('uncheck');
                } else {
                    $('#filter-forms input').iCheck('check');
                }
                updateToggleFormsBtn();
            });
            $('#filter-forms input').on('ifToggled', function () {
                if (this.checked) {
                    $('#grid-forms').find('.' + $(this).val()).addClass('active');
                } else {
                    $('#grid-forms').find('.' + $(this).val()).removeClass('active');
                }
                $('#grid-forms').isotope({filter: '.grid-item.active'});
                updateToggleFormsBtn();
            });
            var updateToggleFormsBtn = function () {
                if ($('#grid-forms').find('.active')[0]) {
                    $('#toggle-all-forms span').removeClass('icon-check-square-o').addClass('icon-checkbox-unchecked');
                } else {
                    $('#toggle-all-forms span').addClass('icon-check-square-o').removeClass('icon-checkbox-unchecked');
                }
            };
            // Filter elements
            $('#toggle-all-elements').on('click', function (e) {
                e.preventDefault();
                if ($('#grid-elements').find('.active')[0]) {
                    $('#filter-elements input').iCheck('uncheck');
                } else {
                    $('#filter-elements input').iCheck('check');
                }
                updateToggleElementsBtn();
            });
            function scrollElements()
            {
                if ($('#grid-elements').find('.active')[0]) {
                    if ($('#grid-elements').find('.active:last').offset().top - $(window).scrollTop() < 200) {
                        $('html, body').animate({
                            scrollTop: $('#grid-elements').find('.active:last').offset().top - $('#grid-elements').find('.active:last').height() - 200
                        }, 500);
                    }
                }
            }
            $('#filter-elements input').on('ifToggled', function () {
                if (this.checked) {
                    $('#grid-elements').find('.' + $(this).val()).addClass('active');
                } else {
                    $('#grid-elements').find('.' + $(this).val()).removeClass('active');
                }
                $('#grid-elements').isotope({filter: '.grid-element.active'});
                $('#grid-elements').isotope('on', 'arrangeComplete', scrollElements);
                updateToggleElementsBtn();
            });
            var updateToggleElementsBtn = function () {
                if ($('#grid-elements').find('.active')[0]) {
                    $('#toggle-all-elements span').removeClass('icon-check-square-o').addClass('icon-checkbox-unchecked');
                } else {
                    $('#toggle-all-elements span').addClass('icon-check-square-o').removeClass('icon-checkbox-unchecked');
                }
            };
            // dependant field
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
