<?php

namespace Helpers\phpforms;

/**
 * Form Class
 *
 * @version 1.2.7
 * @author Gilles Migliori - gilles.migliori@gmail.com
 *
 */

class Form
{
    /* general */

    private $form_ID        = '';
    private $form_attr      = '';
    private $action         = '';
    private $add_get_vars   = true;

    /*  options :
    *   wrappers and classes styled with Bootstrap 3
    *   each can be individually updated with $form->setOptions();
    */

    private $options = array(
        'formInlineClass'          => 'form-inline',
        'formHorizontalClass'      => 'form-horizontal',
        'formVerticalClass'        => '',
        'elementsWrapper'          => '<div class="form-group"></div>',
        'checkboxWrapper'          => '<div class="checkbox"></div>',
        'radioWrapper'             => '<div class="radio"></div>',
        'wrapElementsIntoLabels'   => false,
        'elementsClass'            => 'form-control',
        'wrapperErrorClass'        => 'has-error',
        'elementsErrorClass'       => '',
        'textErrorClass'           => 'text-danger',
        'horizontalLabelClass'     => 'control-label',
        'horizontalLabelCol'       => 'col-sm-4',
        'horizontalOffsetCol'      => 'col-sm-offset-4',
        'horizontalElementCol'     => 'col-sm-8',
        'inlineCheckboxLabelClass' => 'checkbox-inline---',
        'inlineRadioLabelClass'    => 'radio-inline',
        'inputGroupAddonClass'     => 'input-group-addon',
        'btnGroupClass'            => 'btn-group',
        'requiredMark'             => '<sup class="text-danger">* </sup>',
        'openDomReady'             => '$(document).ready(function () {',
        'closeDomReady'            => '});'
    );

    /* error fields + messages */

    private $errors   = array();
    private $error_fields = array();

    /* layout */

    private $layout; /* horizontal | vertical | inline */

    /* init (no need to change anything here) */

    private $error_dir_msg          = ''; // if we can't locate PLUGINS_DIR
    private $btn_reset              = '';
    private $btn_cancel             = '';
    private $checkbox               = array();
    private $end_fieldset           = '';
    private $group_name             = array();
    private $has_file               = false;
    private $hidden_fields          = '';
    public $html                    = '';
    private $input_grouped          = array();
    private $input_wrapper          = array();
    private $optiongroup_ID         = array();
    private $option                 = array();
    private $btn_submit             = '';
    private $radio                  = array();
    private $txt                    = '';
    private $elements_start_wrapper = '';
    private $elements_end_wrapper   = '';
    private $checkbox_start_wrapper = '';
    private $checkbox_end_wrapper   = '';
    private $radio_start_wrapper    = '';
    private $radio_end_wrapper      = '';
    private $html_element_content   = array(); // ex : $this->html_element_content[$element_name][$pos][] = $html

    /* plugins (colorpicker, datepicker, timepicker, captcha, fileupload) */

    private $js_plugins          = array();

    private $css_includes       = array();
    private $js_includes        = array();
    private $js_code            = '';
    private $fileupload_js_code = '';

    /**
     * Defines the layout (horizontal | vertical | inline).
     * Default is 'horizontal'
     * Clears values from session if self::clear has been called before
     * Catches posted errors
     * Adds hidden field with form ID
     * Sets elements wrappers
     *
     * @param string $form_ID The ID of the form
     * @param string $layout  (Optional) Can be 'horizontal', 'vertical' or 'inline'
     * @param string $attr    (Optional) Can be any HTML input attribute or js event EXCEPT class
     *                        (class is defined in layout param).
     *                        attributes must be listed separated with commas.
     *                        Example : novalidate=true,onclick=alert(\'clicked\');
     */

    public function __construct($form_ID, $layout = 'horizontal', $attr = '')
    {
        $this->form_ID   = $form_ID;
        $this->form_attr = $attr;
        $this->layout    = $layout;
        $this->action  = htmlspecialchars($_SERVER["PHP_SELF"]);
        if (!isset($_SESSION['clear_form'][$form_ID])) {
            $_SESSION['clear_form'][$form_ID] = false;
        } elseif ($_SESSION['clear_form'][$form_ID] === true) {
            $_SESSION['clear_form'][$form_ID] = false; // reset after clearing

        } elseif (isset($_POST[$form_ID])) {
            self::registerValues($form_ID);
        }
        if (isset($_SESSION['errors'][$form_ID])) {
            $this->registerErrors();
            unset($_SESSION['errors'][$form_ID]);
        }
        $this->elements_start_wrapper = $this->defineWrapper($this->options['elementsWrapper'], 'start');
        $this->elements_end_wrapper   = $this->defineWrapper($this->options['elementsWrapper'], 'end');
        $this->checkbox_start_wrapper = $this->defineWrapper($this->options['checkboxWrapper'], 'start');
        $this->checkbox_end_wrapper   = $this->defineWrapper($this->options['checkboxWrapper'], 'end');
        $this->radio_start_wrapper    = $this->defineWrapper($this->options['radioWrapper'], 'start');
        $this->radio_end_wrapper      = $this->defineWrapper($this->options['radioWrapper'], 'end');
        $this->addInput('hidden', $form_ID, true, '');
    }

    /**
     * Sets form layout options to match your framework
     *
     * @param array $user_options (Optional) An associative array containing the
     *                            options names as keys and values as data.
     */

    public function setOptions($user_options = array())
    {
        $formClassOptions = array('formInlineClass', 'formHorizontalClass', 'formVerticalClass', 'elementsWrapper', 'checkboxWrapper', 'radioWrapper', 'wrapElementsIntoLabels', 'elementsClass', 'wrapperErrorClass', 'elementsErrorClass', 'textErrorClass', 'horizontalLabelClass', 'horizontalLabelCol', 'horizontalOffsetCol', 'horizontalElementCol', 'inlineCheckboxLabelClass', 'inlineRadioLabelClass', 'btnGroupClass', 'requiredMark', 'openDomReady', 'closeDomReady');
        foreach ($user_options as $key => $value) {
            if (in_array($key, $formClassOptions)) {
                $this->options[$key] = $value;

                /* redefining starting & ending wrappers if needed */

                if ($key == 'elementsWrapper') {
                    $this->elements_start_wrapper = $this->defineWrapper($this->options['elementsWrapper'], 'start');
                    $this->elements_end_wrapper   = $this->defineWrapper($this->options['elementsWrapper'], 'end');
                } elseif ($key == 'checkboxWrapper') {
                    $this->checkbox_start_wrapper = $this->defineWrapper($this->options['checkboxWrapper'], 'start');
                    $this->checkbox_end_wrapper   = $this->defineWrapper($this->options['checkboxWrapper'], 'end');
                } elseif ($key == 'radioWrapper') {
                    $this->radio_start_wrapper = $this->defineWrapper($this->options['radioWrapper'], 'start');
                    $this->radio_end_wrapper   = $this->defineWrapper($this->options['radioWrapper'], 'end');
                }
            }
        }
    }

    /**
    * Redefines form action
    *
    * @param boolean $add_get_vars (Optional) If $add_get_vars is set to false,
    *                              url vars will be removed from destination page.
    *                              Example : www.myUrl.php?var=value => www.myUrl.php
    */

    public function setAction($url, $add_get_vars = true)
    {
        $this->action = $url;
        $this->add_get_vars = $add_get_vars;
    }

    /**
     * Adds HTML code at any place of the form
     *
     * @param string $html         The html code to add.
     * @param string $element_name (Optional) If not empty, the html code will be inserted.
     *                             just before or after the element.
     * @param string $pos          (Optional) If $element_name is not empty, defines the position
     *                             of the inserted html code.
     *                             Values can be 'before' or 'after'.
     */

    public function addHtml($html, $element_name = '', $pos = 'after')
    {
        if (!empty($element_name)) {
            if (!isset($this->html_element_content[$element_name])) {
                $this->html_element_content[$element_name] = array('before', 'after');
            }
            $this->html_element_content[$element_name][$pos][] = $html;
        } else {
            $this->html .= $html . "\n";
        }
    }

    /**
     * Wraps the element with html code.
     *
     * @param string $html         The html code to wrap the element with.
     *                             The html tag must be opened and closed.
     *                             Example : <div class="my-class"></div>
     * @param string $element_name The form element to wrap.
     */

    public function addInputWrapper($html, $element_name)
    {
        $this->input_wrapper[$element_name] = $html;
    }

    /*=================================
    Elements
    =================================*/

    /**
     * Adds input to the form
     *
     * @param string $type  Accepts all input html5 types except checkbox and radio :
     *                      button, color, date, datetime, datetime-local,
     *                      email, file, hidden, image, month, number, password,
     *                      range, reset, search, submit, tel, text, time, url, week
     * @param string $name  The input name
     * @param string $value (Optional) The input default value
     * @param string $label (Optional) The input label
     * @param string $attr  (Optional) Can be any HTML input attribute or js event.
     *                      attributes must be listed separated with commas.
     *                      If you don't specify any ID as attr, the ID will be the name of the input.
     *                      Example : class=my-class,placeholder=My Text,onclick=alert(\'clicked\');
     */

    public function addInput($type, $name, $value = '', $label = '', $attr = '')
    {
        if ($type == 'file') {
            $this->has_file = true;
        }
        $attr         = $this->getAttributes($attr); // returns linearised attributes (with ID)
        $array_values = $this->getID($name, $attr); // if $attr contains no ID, field ID will be $name.
        $id           = $array_values['id'];
        $attr         = $array_values['attributs']; // if $attr contains an ID, we remove it.
        $attr         = $this->addElementClass($name, $attr);
        $value        = $this->getValue($name, $value);
        if ($type == 'hidden') {
            $this->hidden_fields .= '<input name="' . $name . '" type="hidden" value="' . $value . '" ' . $attr . '>';
        } else {
            if (!empty($this->options['elementsWrapper'])) { // form-group
                $this->html .= $this->addWrapperErrorClass($this->setInputGroup($name, 'start'), $name) . " \n";
            }
            if (!empty($label)) {
                $this->html .= '<label for="' . $id . '"' . $this->getLabelClass() . '>' . $this->getRequired($label, $attr);
                if ($this->options['wrapElementsIntoLabels'] !== true) {
                    $this->html .= '</label>';
                }
                $this->html .= " \n";
            }
            $this->html .= $this->getElementCol('start', $label); // col-sm-8
            $this->html .= $this->getErrorInputWrapper($name, $label, 'start'); // has-error
            $this->html .= $this->getHtmlElementContent($name, 'before', 'outside_wrapper');
            if (isset($this->input_wrapper[$name])) {
                $this->html .= $this->defineWrapper($this->input_wrapper[$name], 'start'); // input-group
            }
            $this->html .= $this->getHtmlElementContent($name, 'before', 'inside_wrapper');
            $this->html .= '<input id="' . $id . '" name="' . $name . '" type="' . $type . '" value="' . $value . '" ' . $attr . '>' . " \n";
            $this->html .= $this->getHtmlElementContent($name, 'after', 'inside_wrapper');
            if (isset($this->input_wrapper[$name])) {
                $this->html .= $this->defineWrapper($this->input_wrapper[$name], 'end'); // end input-group
            }
            $this->html .= $this->getHtmlElementContent($name, 'after', 'outside_wrapper');
            $this->html .= $this->getErrorInputWrapper($name, $label, 'end'); // end has-error
            $this->html .= $this->getError($name);
            $this->html .= $this->getElementCol('end'); // end col-sm-8
            if (!empty($label) && $this->options['wrapElementsIntoLabels'] === true) {
                $this->html .= '</label>' . " \n";
            }
            if (!empty($this->options['elementsWrapper'])) { // end form-group
                $this->html .= $this->setInputGroup($name, 'end') . " \n";
            }
        }
        $this->registerField($name);
    }

    /**
     * Creates an input with fileupload plugin.
     *
     * The fileupload plugin generates complete html, js and css code.
     * You'll just have to call printIncludes('css') and printIncludes('js')
     * where you wants to put your css/js codes (generaly in <head> and just before </body>).
     *
     * @param string $type              The node of the plugins-config/fileupload.xml file where is your code.
     *                                  For example : 'default' or 'images'
     * @param string $name              The upload field name.
     *                                  Use an array (ex : name[]) to allow multiple files upload
     * @param string $value             (Optional) The input default value
     * @param string $label             (Optional) The input label
     * @param string $attr              (Optional) Can be any HTML input attribute or js event.
     *                                  attributes must be listed separated with commas.
     *                                  If you don't specify any ID as attr, the ID will be the name of the input.
     *                                  Example : class=my-class,placeholder=My Text,onclick=alert(\'clicked\');.
     * @param array  $fileUpload_config (Optional) An associative array containing :
     *                                  'xml'                 => The xml node where your plugin code is
     *                                  in plugins-config/fileupload.xml,
     *                                  'uploader'            => The php uploader file in
     *                                  plugins/jQuery-File-Upload-9.5.8/server/php/ folder
     *                                  'btn-text'            => The text of the upload button,
     *                                  'max-number-of-files' => The max number of files to upload
     *
     */

    public function addFileUpload($type, $name, $value = '', $label = '', $attr = '', $fileUpload_config = '')
    {
        $this->has_file = true;
        $attr           = $this->getAttributes($attr); // returns linearised attributes (with ID)
        $array_values   = $this->getID($name, $attr); // if $attr contains no ID, field ID will be $name.
        $attr           = $array_values['attributs']; // if $attr contains an ID, we remove it.
        $attr           = $this->addElementClass($name, $attr);
        $value          = $this->getValue($name, $value);

        /* adding plugin */

        if (!isset($fileUpload_config['xml'])) {
            $fileUpload_config['xml'] = 'default';
        }
        if (!isset($fileUpload_config['uploader'])) {
            $fileUpload_config['uploader'] = 'defaultFileUpload.php';
        }
        if (!isset($fileUpload_config['btn-text'])) {
            $fileUpload_config['btn-text'] = 'Select files...';
        }
        if (!isset($fileUpload_config['max-number-of-files'])) {
            $fileUpload_config['max-number-of-files'] = 1;
        }
        if (!defined('PLUGINS_DIR')) {
            include_once dirname(__FILE__) . '/plugins-path.php';
        }

        /* remove [] from name if array of files */

        if (preg_match('`\[\]`', $name)) {
            $uploaderId = preg_replace('`\[\]`', '', $name);
        } else {
            $uploaderId = $name;
        }
        $xml_replacements = array('%uploader%' => $fileUpload_config['uploader'], '%max-number-of-files%' => $fileUpload_config['max-number-of-files'], '%PLUGINS_DIR%' => PLUGINS_DIR, '%file-input%' => $name, '%uploader-id%' => $uploaderId);
        $this->addPlugin('fileupload', '#' . $this->form_ID, $fileUpload_config['xml'], $xml_replacements);
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->elements_start_wrapper . " \n";
        }
        if (!empty($label)) {
            $this->html .= '<label for="' . $name . '"' . $this->getLabelClass() . '>';
            if (in_array($name, array_keys($this->error_fields))) {
                $this->html .= '<span class="text-danger">' . $this->getRequired($label, $attr) . '</span>';
            } else {
                $this->html .=$this->getRequired($label, $attr);
            }
            if ($this->options['wrapElementsIntoLabels'] === false) {
                $this->html .= '</label>';
            }
            $this->html .= " \n";
        }
        $this->html .= $this->getElementCol('start', $label);
        if (isset($this->input_wrapper[$name])) {
            $this->html .= $this->defineWrapper($this->input_wrapper[$name], 'start');
        }
        $this->html .= $this->getHtmlElementContent($name, 'before');

        /* getting html_code from xml */

        $xml       = simplexml_load_file(dirname(__FILE__) . '/plugins-config/fileupload.xml');
        $html_code = $xml->$fileUpload_config['xml']->html_code;
        $search    = array('`%input_name%`', '`%btn-text%`');
        $replace   = array($name, $fileUpload_config['btn-text']);
        $this->html .= preg_replace($search, $replace, $html_code);
        $this->html .= $this->getHtmlElementContent($name, 'after');
        if (isset($this->input_wrapper[$name])) {
            $this->html .= $this->defineWrapper($this->input_wrapper[$name], 'end');
        }
        $this->html .= $this->getElementCol('end');
        if (!empty($label) && $this->options['wrapElementsIntoLabels'] === true) {
            $this->html .= '</label>' . " \n";
        }
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->elements_end_wrapper . " \n";
        }
        $this->registerField($name);
    }

    /**
     * Adds textarea to the form
     * @param string $name  The textarea name
     * @param string $value (Optional) The textarea default value
     * @param string $label (Optional) The textarea label
     * @param string $attr  (Optional) Can be any HTML input attribute or js event.
     *                      attributes must be listed separated with commas.
     *                      If you don't specify any ID as attr, the ID will be the name of the textarea.
     *                      Example : cols=30, rows=4;.
     */

    public function addTextarea($name, $value = '', $label = '', $attr = '')
    {
        $attr         = $this->getAttributes($attr); // returns linearised attributes (with ID)
        $array_values = $this->getID($name, $attr); // if $attr contains no ID, field ID will be $name.
        $id           = $array_values['id'];
        $attr         = $array_values['attributs']; // if $attr contains an ID, we remove it.
        $attr         = $this->addElementClass($name, $attr);
        $value        = $this->getValue($name, $value);
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->addWrapperErrorClass($this->elements_start_wrapper, $name) . " \n";
        }
        if (!empty($label)) {
            $this->html .= '<label for="' . $id . '"' . $this->getLabelClass() . '>' . $this->getRequired($label, $attr);
            if ($this->options['wrapElementsIntoLabels'] === false) {
                $this->html .= '</label>';
            }
            $this->html .= " \n";
        }
        $this->html .= $this->getElementCol('start', $label);
        $this->html .= $this->getErrorInputWrapper($name, $label, 'start');
        $this->html .= $this->getHtmlElementContent($name, 'before');
        $this->html .= '<textarea id="' . $id . '" name="' . $name . '" ' . $attr . '>' . $value . '</textarea>' . " \n";
        $this->html .= $this->getHtmlElementContent($name, 'after');
        $this->html .= $this->getError($name);
        $this->html .= $this->getErrorInputWrapper($name, $label, 'end');
        $this->html .= $this->getElementCol('end');
        if (!empty($label) && $this->options['wrapElementsIntoLabels'] === true) {
            $this->html .= '</label>' . " \n";
        }
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->elements_end_wrapper . " \n";
        }
        $this->registerField($name);
    }

    /**
     * Adds option to the $select_name element
     *
     * IMPORTANT : Always add your options BEFORE creating the select element
     *
     * @param string $select_name The name of the select element
     * @param string $value       The option value
     * @param string $txt         The text that will be displayed
     * @param string $group_name  (Optional) the optgroup name
     * @param string $attr        (Optional) Can be any HTML input attribute or js event.
     *                            attributes must be listed separated with commas.
     *                            If you don't specify any ID as attr, the ID will be the name of the option.
     *                            Example : class=my-class
     */

    public function addOption($select_name, $value, $txt, $group_name = '', $attr = '')
    {
        $optionValues = array('value' => $value, 'txt' => $txt, 'attributs' => $attr);
        if (!empty($group_name)) {
            $this->option[$select_name][$group_name][] = $optionValues;
            if (!isset($this->group_name[$select_name])) {
                $this->group_name[$select_name] = array();
            }
            if (!in_array($group_name, $this->group_name[$select_name])) {
                $this->group_name[$select_name][] = $group_name;
            }
        } else {
            $this->option[$select_name][] = $optionValues;
        }
    }

    /**
     * Adds a select element
     *
     * IMPORTANT : Always add your options BEFORE creating the select element
     *
     * @param string $select_name        The name of the select element
     * @param string $label              (Optional) The select label
     * @param string $attr               (Optional)  Can be any HTML input attribute or js event.
     *                                   attributes must be listed separated with commas.
     *                                   If you don't specify any ID as attr, the ID will be the name of the input.
     *                                   Example : class=my-class
     * @param string $displayGroupLabels (Optional) True or false.
     *                                   Default is true.
     */

    public function addSelect($select_name, $label = '', $attr = '', $displayGroupLabels = true)
    {
        $attr         = $this->getAttributes($attr); // returns linearised attributes (with ID)
        $array_values = $this->getID($select_name, $attr); // if $attr contains no ID, field ID will be $select_name.
        $id           = $array_values['id'];
        $attr         = $array_values['attributs']; // if $attr contains an ID, we remove it.
        $attr         = $this->addElementClass($select_name, $attr);
        $form_ID = $this->form_ID;
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->addWrapperErrorClass($this->setInputGroup($select_name, 'start'), $select_name) . " \n";
        }
        if (!empty($label)) {
            $this->html .= '<label for="' . $id . '"' . $this->getLabelClass() . '>' . $this->getRequired($label, $attr);
            if ($this->options['wrapElementsIntoLabels'] === false) {
                $this->html .= '</label>';
            }
            $this->html .= " \n";
        }
        $this->html .= $this->getElementCol('start', $label);
        $this->html .= $this->getErrorInputWrapper($select_name, $label, 'start');
        $this->html .= $this->getHtmlElementContent($select_name, 'before', 'outside_wrapper');
        if (isset($this->input_wrapper[$select_name])) {
            $this->html .= $this->defineWrapper($this->input_wrapper[$select_name], 'start');
        }
        $this->html .= $this->getHtmlElementContent($select_name, 'before', 'inside_wrapper');
        $this->html .= '<select id="' . $id . '" name="' . $select_name . '" ' . $attr . '>' . " \n";
        if (isset($this->group_name[$select_name])) {
            foreach ($this->group_name[$select_name] as $group_name) {
                $nbreOptions = count($this->option[$select_name][$group_name]);
                $groupLabel = '';
                if ($displayGroupLabels == true) {
                    $groupLabel = ' label="' . $group_name . '"';
                }
                $this->html .= '<optgroup' . $groupLabel . '>' . " \n";
                for ($i=0; $i<$nbreOptions; $i++) {
                    $txt = $this->option[$select_name][$group_name][$i]['txt'];
                    $value = $this->option[$select_name][$group_name][$i]['value'];
                    $option_attr = $this->option[$select_name][$group_name][$i]['attributs'];
                    $option_attr = $this->getAttributes($option_attr);
                    $this->html .= '<option value="' . $value . '"';
                    $option_attr = $this->getCheckedOrSelected($select_name, $value, $option_attr, 'select');
                    $this->html .= ' ' . $option_attr . '>' . $txt . "</option> \n";
                }
                $this->html .= '</optgroup>' . " \n";
            }
        } else {
            $nbreOptions = count($this->option[$select_name]);
            for ($i=0; $i<$nbreOptions; $i++) {
                $txt = $this->option[$select_name][$i]['txt'];
                $value = $this->option[$select_name][$i]['value'];
                $option_attr = $this->option[$select_name][$i]['attributs'];
                $option_attr = $this->getAttributes($option_attr);
                $this->html .= '<option value="' . $value . '"';
                $option_attr = $this->getCheckedOrSelected($select_name, $value, $option_attr, 'select');
                $this->html .= ' ' . $option_attr . '>' . $txt . "</option> \n";
            }
        }
        $this->html .= "</select> \n";
        $this->html .= $this->getHtmlElementContent($select_name, 'after', 'inside_wrapper');
        if (isset($this->input_wrapper[$select_name])) {
            $this->html .= $this->defineWrapper($this->input_wrapper[$select_name], 'end');
        }
        $this->html .= $this->getHtmlElementContent($select_name, 'after', 'outside_wrapper');
        $this->html .= $this->getErrorInputWrapper($select_name, $label, 'end');
        $this->html .= $this->getError($select_name);
        $this->html .= $this->getElementCol('end');
        if (!empty($label) && $this->options['wrapElementsIntoLabels'] === true) {
            $this->html .= '</label>' . " \n";
        }
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->setInputGroup($select_name, 'end') . " \n";
        }
        if (preg_match('`selectpicker`', $attr)) {
            $this->addPlugin('bootstrap-select', '.selectpicker', 'default-selectpicker');
        }
        $this->registerField($select_name);
    }

    /**
     * adds a country select list with flags
     * @param array  $select_name
     * @param string $label        (Optional) The select label
     * @param string $attr         (Optional)  Can be any HTML input attribute or js event.
     *                             attributes must be listed separated with commas.
     *                             If you don't specify any ID as attr, the ID will be the name of the input.
     *                             Example : class=my-class
     * @param array  $user_options (Optional) :
     *                             lang            : MUST correspond to one subfolder of [PLUGINS_DIR]countries/country-list/country/cldr/
     *                             *** for example 'en', or 'fr_FR'                 Default : 'en'
     *                             flags           : true or false.                 Default : true
     *                             *** displays flags into option list
     *                             flag_size       : 16 or 32                       Default : 32
     *                             return_value    : 'name' or 'code'               Default : 'name'
     *                             *** type of the value that will be returned
     *                             show_tick       : true or false
     *                             *** shows a checkmark beside selected options    Default : true
     *                             live_search     : true or false                  Default : true
    */
    public function addCountrySelect($select_name, $label = '', $attr = '', $user_options = array())
    {

        /* define options*/

        $options = array(
            'lang' => 'en',
            'flags' => true,
            'flag_size' => 32,
            'return_value' => 'name',
            'show_tick' => true,
            'live_search' => true
        );
        foreach ($user_options as $key => $value) {
            if (in_array($key, $options)) {
                $options[$key] = $value;
            }
        }
        if (!defined('PLUGINS_DIR')) {
            include_once dirname(__FILE__) . '/plugins-path.php';
        }
        $countries = include PLUGINS_ROOT . 'countries/country-list/country/cldr/' . $options['lang'] . '/country.php';
        $class = '';
        if (preg_match('`class(\s)?=(\s)?([^,])+`', $attr, $out)) {
            $class = $out[3] . ' ';
        }
        $class .= 'selectpicker ' . $this->options['elementsClass'];
        if ($options['flags'] == true) {
            $class .= ' f' . $options['flag_size'];
            $xml_node = 'countries-flags-' . $options['flag_size'];
        } else {
            $xml_node = 'default-selectpicker';
        }
        if ($options['show_tick'] == true) {
            $class .= ' show-tick';
        }
        $live_search = '';
        if ($options['live_search'] == true) {
            $live_search .= ' data-live-search="true" ';
        }
        $attr         = $this->getAttributes($attr); // returns linearised attributes (with ID)
        $array_values = $this->getID($select_name, $attr); // if $attr contains no ID, field ID will be $select_name.
        $id           = $array_values['id'];
        $attr         = $array_values['attributs']; // if $attr contains an ID, we remove it.
        $attr         = $this->removeAttr('class', $attr);
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->addWrapperErrorClass($this->setInputGroup($select_name, 'start'), $select_name) . " \n";
        }
        if (!empty($label)) {
            $this->html .= '<label for="' . $id . '"' . $this->getLabelClass() . '>' . $this->getRequired($label, $attr);
            if ($this->options['wrapElementsIntoLabels'] === false) {
                $this->html .= '</label>';
            }
            $this->html .= " \n";
        }
        $this->html .= $this->getElementCol('start', $label);
        $this->html .= $this->getErrorInputWrapper($select_name, $label, 'start');
        $this->html .= $this->getHtmlElementContent($select_name, 'before');
        $this->html .= '<select name="' . $select_name . '" id="' . $id . '" class="' . $class . '"' . $live_search . $attr . '>' . " \n";
        $option_list = '';
        if ($options['return_value'] == 'name') {
            foreach ($countries as $country_code => $country_name) {
                $option_list .= '<option value="' . $country_name . '" class="flag ' . mb_strtolower($country_code) . '">' . $country_name . '</option>' . " \n";
            }
        } else {
            foreach ($countries as $country_code => $country_name) {
                $option_list .= '<option value="' . $code . '" class="flag ' . mb_strtolower($country_code) . '">' . $country_name . '</option>' . " \n";
            }
        }
        $this->html .= $option_list;
        $this->html .= '</select>' . " \n";
        $this->html .= $this->getHtmlElementContent($select_name, 'after');
        $this->html .= $this->getError($select_name);
        $this->html .= $this->getErrorInputWrapper($select_name, $label, 'end');
        $this->html .= $this->getElementCol('end');
        if (!empty($label) && $this->options['wrapElementsIntoLabels'] === true) {
            $this->html .= '</label>' . " \n";
        }
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->setInputGroup($select_name, 'end') . " \n";
        }
        $this->addPlugin('bootstrap-select', '.selectpicker', $xml_node);
        $this->registerField($select_name);
    }

    /**
     * Adds radio button to $group_name element
     *
     * @param string $group_name The radio button groupname
     * @param string $label      The radio button label
     * @param string $value      The radio button value
     * @param string $attr       (Optional) Can be any HTML input attribute or js event.
     *                           attributes must be listed separated with commas.
     *                           Example : checked=checked
     */

    public function addRadio($group_name, $label, $value, $attr = '')
    {
        $this->radio[$group_name]['label'][]  = $label;
        $this->radio[$group_name]['value'][]  = $value;
        $this->radio[$group_name]['attr'][]  = $attr;
    }

    /**
     * Prints radio buttons group.
     *
     * @param string $group_name The radio button group name
     * @param string $label      (Optional) The radio buttons group label
     * @param string $inline     (Optional) True or false.
     *                           Default is true.
     * @param string $attr       (Optional) Can be any HTML input attribute or js event.
     *                           attributes must be listed separated with commas.
     *                           If you don't specify any ID as attr, the ID will be the name of the input.
     *                           Example : class=my-class
     */

    public function printRadioGroup($group_name, $label = '', $inline = true, $attr = '')
    {
        $form_ID = $this->form_ID;
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->addWrapperErrorClass($this->elements_start_wrapper, $group_name) . " \n";
        }
        if (!empty($label)) {
            $this->html .= '<label' . $this->getLabelClass() . '>' . $this->getRequired($label, $attr);
            if ($this->options['wrapElementsIntoLabels'] === false) {
                $this->html .= '</label>';
            }
            $this->html .= " \n";
        }
        $required = '';
        if (preg_match('`required`', $attr)) {
            $required = ' required';
        }
        $this->html .= $this->getElementCol('start', $label);
        $this->html .= $this->getErrorInputWrapper($group_name, $label, 'start');
        $this->html .= $this->getHtmlElementContent($group_name, 'before');
        for ($i=0; $i < count($this->radio[$group_name]['label']); $i++) {
            if (!empty($this->options['radioWrapper']) && $inline !== true) {
                $this->html .= $this->radio_start_wrapper . " \n";
            }
            $radio_label  = $this->radio[$group_name]['label'][$i];
            $radio_value  = $this->radio[$group_name]['value'][$i];
            $radio_attr   = $this->getAttributes($this->radio[$group_name]['attr'][$i]); // returns linearised attributes (with ID)
            $this->html .= '<label' . $this->getLabelClass('radio', $inline) . '><input type="radio" id="' . $group_name . '_' . $i . '" name="' . $group_name . '" value="' . $radio_value . '"';
            if (isset($_SESSION[$form_ID][$group_name])) {
                if ($_SESSION[$form_ID][$group_name] == $radio_value) {
                    if (!preg_match('`checked`', $radio_attr)) {
                        $this->html .= ' checked="checked"';
                    }
                } else { // we remove 'checked' from $radio_attr as user has previously checked another, memorized in session.
                    $radio_attr = $this->removeAttr('checked', $radio_attr);
                }
            }
            $this->html .= $required . ' ' . $radio_attr . '>' . $radio_label . '</label>' . " \n";
            if (!empty($this->options['radioWrapper']) && $inline !== true) {
                $this->html .= $this->radio_end_wrapper . " \n";
            }
        }
        $this->html .= $this->getHtmlElementContent($group_name, 'after');
        $this->html .= $this->getError($group_name);
        $this->html .= $this->getErrorInputWrapper($group_name, $label, 'end');
        $this->html .= $this->getElementCol('end');
        if (!empty($label) && $this->options['wrapElementsIntoLabels'] === true) {
            $this->html .= '</label>' . " \n";
        }
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->elements_end_wrapper . " \n";
        }
        $this->registerField($group_name);
    }

    /**
     * Adds checkbox to $group_name
     *
     * @param string $group_name The checkbox button groupname
     * @param string $label      The checkbox label
     * @param string $value      The checkbox value
     *
     *
     */

    public function addCheckbox($group_name, $label, $name, $value, $attr = '')
    {
        $form_ID                                             = $this->form_ID;
        $this->checkbox[$group_name]['label'][]              = $label;
        $this->checkbox[$group_name]['name'][]               = $name;
        $this->checkbox[$group_name]['value'][]              = $value;
        $this->checkbox[$group_name]['attr'][]               = $attr;
        $this->registerField($name);
    }

    /**
     * Prints checkbox group.
     *
     * @param string $var (Optional) description
     *
     * @param string $group_name The checkbox button group name
     * @param string $label      (Optional) The checkbox group label
     * @param string $inline     (Optional) True or false.
     *                           Default is true.
     * @param string $attr       (Optional) Can be any HTML input attribute or js event.
     *                           attributes must be listed separated with commas.
     *                           If you don't specify any ID as attr, the ID will be the name of the input.
     *                           Example : class=my-class
     */

    public function printCheckboxGroup($group_name, $label = '', $inline = true, $attr = '')
    {
        $form_ID = $this->form_ID;
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->addWrapperErrorClass($this->elements_start_wrapper, $group_name) . " \n";
        }
        if (!empty($label)) {
            $this->html .= '<label' . $this->getLabelClass() . '>' . $this->getRequired($label, $attr);
            if ($this->options['wrapElementsIntoLabels'] === false) {
                $this->html .= '</label>';
            }
            $this->html .= " \n";
        }
        $this->html .= $this->getElementCol('start', $label);
        $this->html .= $this->getErrorInputWrapper($group_name, $label, 'start');
        $this->html .= $this->getHtmlElementContent($group_name, 'before');
        for ($i=0; $i < count($this->checkbox[$group_name]['label']); $i++) {
            if (!empty($this->options['checkboxWrapper']) && $inline !== true) {
                $this->html .= $this->checkbox_start_wrapper . " \n";
            }
            $checkbox_label = $this->checkbox[$group_name]['label'][$i];
            $checkbox_name  = $this->checkbox[$group_name]['name'][$i];
            $checkbox_value = $this->checkbox[$group_name]['value'][$i];
            $checkbox_attr = $this->checkbox[$group_name]['attr'][$i];
            $this->html .= '<label' . $this->getLabelClass('checkbox', $inline) . '><input type="checkbox" class="icheck" id="' . $checkbox_name . '" name="' . $checkbox_name . '" value="' . $checkbox_value . '"';

            $attr = $this->getCheckedOrSelected($checkbox_name, $checkbox_value, $checkbox_attr, 'checkbox');
            $this->html .= ' ' . $checkbox_attr . '>' . $checkbox_label . '</label>' . " \n";
            if (!empty($this->options['checkboxWrapper']) && $inline !== true) {
                $this->html .= $this->checkbox_end_wrapper . " \n";
            }
        }
        $this->html .= $this->getHtmlElementContent($group_name, 'after');
        $this->html .= $this->getError($group_name);
        $this->html .= $this->getErrorInputWrapper($group_name, $label, 'end');
        $this->html .= $this->getElementCol('end');
        if (!empty($label) && $this->options['wrapElementsIntoLabels'] === true) {
            $this->html .= '</label>' . " \n";
        }
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->elements_end_wrapper . " \n";
        }
    }

    /**
     * Adds button to the form
     *
     * If $btnGroupName is empty, the button will be automaticly displayed.
     * Otherwise, you'll have to call printBtnGroup to display your btnGroup.
     *
     * @param string $type         The html button type
     * @param string $name         The button name
     * @param string $value        The button value
     * @param string $text         The button text
     * @param string $attr         (Optional) Can be any HTML input attribute or js event.
     *                             attributes must be listed separated with commas.
     *                             If you don't specify any ID as attr, the ID will be the name of the input.
     *                             Example : class=my-class,onclick=alert(\'clicked\');
     * @param string $btnGroupName (Optional) If you wants to group several buttons, group them then call printBtnGroup.
     *
     */

    public function addBtn($type, $name, $value, $text, $attr = '', $btnGroupName = '')
    {

        /*  if $btnGroupName isn't empty, we just store values
        *   witch will be called back by printBtnGroup($btnGroupName)
        *   else we store the values in a new array, then call immediately printBtnGroup($btnGroupName)
        */

        if (empty($btnGroupName)) {
            $btnGroupName = 'btn-alone';
            $this->btn[$btnGroupName] = array();
        }

        $this->btn[$btnGroupName]['type'][] = $type;
        $this->btn[$btnGroupName]['name'][] = $name;
        $this->btn[$btnGroupName]['value'][] = $value;
        $this->btn[$btnGroupName]['text'][] = $text;
        $this->btn[$btnGroupName]['attr'][] = $attr;

        /*  if $btnGroupName was empty the button is displayed. */

        if ($btnGroupName == 'btn-alone') {
            $this->printBtnGroup($btnGroupName);
        }
    }

    /**
     * Prints buttons group.
     *
     * @param string $btnGroupName The buttons group name
     * @param string $label        (Optional) The buttons group label
     *
     */

    public function printBtnGroup($btnGroupName, $label = '')
    {
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->elements_start_wrapper . " \n";
        }
        if (!empty($label)) {
            $this->html .= '<label' . $this->getLabelClass() . '>' . $label;
            if ($this->options['wrapElementsIntoLabels'] !== true) {
                $this->html .= '</label>';
            }
            $this->html .= " \n";
        }
        $this->html .= $this->getElementCol('start', $label);
        if (!empty($this->options['btnGroupClass']) && $btnGroupName !== 'btn-alone') {
            $this->html .= '<div class="' . $this->options['btnGroupClass'] . '">' . " \n";
        }
        $this->html .= $this->getHtmlElementContent($btnGroupName, 'before');
        for ($i=0; $i < count($this->btn[$btnGroupName]['type']); $i++) {
            $btn_type     = $this->btn[$btnGroupName]['type'][$i];
            $btn_name     = $this->btn[$btnGroupName]['name'][$i];
            $btn_value    = $this->btn[$btnGroupName]['value'][$i];
            $btn_text     = $this->btn[$btnGroupName]['text'][$i];
            $btn_attr     = $this->btn[$btnGroupName]['attr'][$i];
            $btn_attr     = $this->getAttributes($btn_attr); // returns linearised attributes (with ID)
            $array_values = $this->getID($btn_name, $btn_attr); // if $btn_attr contains no ID, field ID will be $btn_name.
            $id           = $array_values['id'];
            $btn_attr     = $array_values['attributs']; // if $btn_attr contains an ID, we remove it.
            $btn_value    = $this->getValue($btn_name, $btn_value);
            $this->html .= '<button type="' . $btn_type . '" name="' . $btn_name . '" value="' . $btn_value . '" ' . $btn_attr . '>' . $btn_text . '</button>' . " \n";
        }
        $this->html .= $this->getHtmlElementContent($btnGroupName, 'after');
        if (!empty($this->options['btnGroupClass']) && $btnGroupName !== 'btn-alone') {
            $this->html .= '</div>' . " \n";
        }
        $this->html .= $this->getElementCol('end');
        if (!empty($this->options['elementsWrapper'])) {
            $this->html .= $this->elements_end_wrapper . " \n";
        }
    }

    /**
     * Starts a fieldset tag.
     * @param string $legend (Optional) Legend of the fieldset.
     */

    public function startFieldset($legend = '')
    {
        $this->html .= '<fieldset>' . " \n";
        if (!empty($legend)) {
            $this->html .= '<legend>' . $legend . '</legend>' . " \n";
        }
    }

    /**
     * Ends a fieldset tag.
     */

    public function endFieldset()
    {
        if (!empty($this->btn_submit)) {
            // si endFieldset en fin de formulaire
            $this->end_fieldset .= '</fieldset>' . " \n";
        } else {
            $this->html .= '</fieldset>' . " \n";
        }
    }

    /**
     * Allows to group inputs in the same wrapper
     * @param string $input1 The name of the first input of the group
     * @param string $input2 The name of the second input of the group
     * @param string $input3 [optional] The name of the third input of the group
     */
    public function groupInputs($input1, $input2, $input3 = '')
    {
        if (empty($input3)) {
            $this->input_grouped[] = array('input_1' => $input1, 'input_2' => $input2);
        } else {
            $this->input_grouped[] = array('input_1' => $input1, 'input_2' => $input2, 'input_3' => $input3);
        }
    }

    /*=================================
    js-plugins
    =================================*/

    /**
     * Gets and tests plugins absolute path (PLUGINS_DIR).
     * Adds a javascript plugin to the selected field(s)
     * @param string $plugin_name     The name of the plugin,
     *                                must be the name of the xml file
     *                                in plugins-config dir
     *                                without extension.
     *                                Example : colorpicker
     * @param string $selector        The jQuery style selector.
     *                                Examples : #colorpicker
     *                                .colorpicker
     * @param string $js_content      (Optional) The xml node where your plugin code is
     *                                in plugins-config/[your-plugin.xml] file
     * @param array  $js_replacements (Optional) An associative array containing
     *                                the strings to search as keys
     *                                and replacement values as data.
     *                                Strings will be replaced with data
     *                                in <js_code> xml node of your
     *                                plugins-config/[your-plugin.xml] file.
     */

    public function addPlugin($plugin_name, $selector, $js_content = 'default', $js_replacements = '')
    {
        if (!defined('PLUGINS_DIR')) {
            include_once dirname(__FILE__) . '/plugins-path.php';
        }
        $headers = @get_headers(PLUGINS_DIR);
        if (strpos($headers[0], '404') !== false) {
            $this->error_dir_msg = '<div style="line-height:30px;border-radius:5px;border-bottom:1px solid #ac2925;background-color: #c9302c;margin:10px auto;"><p style="color:#fff;text-align:center;font-size:16px;margin:0">' . PLUGINS_DIR . '<br>Can\'t locate the \'plugins\' directory. Please configure plugins path in plugins-path.php</p></div>';
        }
        if (!in_array($plugin_name, $this->js_plugins)) {
            $this->js_plugins[] = $plugin_name;
        }
        $this->js_fields[$plugin_name][]       = $selector;
        $this->js_content[$plugin_name][]      = $js_content;
        $this->js_replacements[$plugin_name][] = $js_replacements;
    }

    /**
     * Prints html code to include css or js files needed by plugins.
     *
     * @param string $type value : 'css' or 'js'
     *
     */

    public function printIncludes($type, $debug = false)
    {
        $this->getIncludes($type);
        $out = '';
        if ($type == 'css') {
            $already_included_css_files = array();
            foreach ($this->css_includes as $plugin_name) {
                foreach ($plugin_name as $css_file) {
                    if (!in_array($css_file, $already_included_css_files)) {
                        $already_included_css_files[] = $css_file;
                        if (preg_match('`http(s)?://`', $css_file)) { // if absolute path in XML
                            $out .= '<link href="' . $css_file . '" rel="stylesheet" media="screen">' . " \n";
                        } elseif (strlen($css_file) > 0) { // if relative path in XML
                            $out .= '<link href="' . PLUGINS_DIR . $css_file . '" rel="stylesheet" media="screen">' . " \n";
                        }
                    }
                }
            }
        } elseif ($type == 'js') {
            $already_included_js_files = array();
            foreach ($this->js_includes as $plugin_name) {
                foreach ($plugin_name as $js_file) {
                    if (!in_array($js_file, $already_included_js_files)) {
                        $already_included_js_files[] = $js_file;
                        if (preg_match('`http(s)?://`', $js_file)) { // if absolute path in XML
                            $out .= '<script src="' . $js_file . '"></script>' . " \n";
                        } elseif (strlen($js_file) > 0) { // if relative path in XML
                            $out .= '<script src="' . PLUGINS_DIR . $js_file . '"></script>' . " \n";
                        }
                    }
                }
            }
        }
        if ($debug == true) {
            echo '<pre class="prettyprint">' . htmlspecialchars($out) . '</pre>';
        } else {
            echo $out;
        }
    }

    /**
     * Prints js code generated by plugins.
     */

    public function printJsCode($debug = false)
    {
        $this->getJsCode();
        if ($debug == true) {
            echo '<pre class="prettyprint">' . htmlspecialchars($this->js_code) . '</pre>';
            echo '<pre class="prettyprint">' . htmlspecialchars($this->fileupload_js_code) . '</pre>';
        } else {
            echo $this->js_code;
            echo $this->fileupload_js_code;
        }
    }

    /*=================================
    render
    =================================*/

    /**
     * Renders the html code of the form.
     *
     * @param string $debug (Optional) True or false.
     *                      If true, the html code will be displayed
     *
     */

    public function render($debug = false)
    {
        $html = '';
        if (!empty($this->error_dir_msg)) { // if we can't locate PLUGINS_DIR
            echo $this->error_dir_msg;
        }
        if (!empty($_SERVER['QUERY_STRING'])) {
            $get = '?' . $_SERVER['QUERY_STRING'];
        }
        if (empty($this->action)) {
            $this->action = htmlspecialchars($_SERVER["PHP_SELF"]);
        }
        if ($this->btn_reset != '') {
            $html .= $this->btn_reset;
        }
        $html .= '<form ';
        if (!empty($this->form_ID)) {
            $html .= 'id="' . $this->form_ID . '" ';
        }
        $html .= 'action="' . $this->action;
        if (isset($get) and $this->add_get_vars === true) {
            $html .= $get;
        }
        $html .= '" method="post"';
        if ($this->has_file === true) {
            $html .= ' enctype="multipart/form-data"';
        }

        /* layout */

        if ($this->layout == 'horizontal' && !empty($this->options['formHorizontalClass'])) {
            $html .= ' class="' . $this->options['formHorizontalClass'] . '"';
        } elseif ($this->layout == 'inline' && !empty($this->options['formInlineClass'])) {
            $html .= ' class="' . $this->options['formInlineClass'] . '"';
        } elseif (!empty($this->options['formVerticalClass'])) {
            $html .= ' class="' . $this->options['formVerticalClass'] . '"';
        }
        if (!empty($this->form_attr)) {
            $html .= $this->getAttributes($this->form_attr);
        }
        $html .= '  role="form">' . " \n";
        if (!empty($this->hidden_fields)) {
            $html .= '<div>' . $this->hidden_fields . '</div>' . " \n";
        }
        $html .= $this->html;
        $html .= $this->btn_submit;
        if (!empty($this->btn_cancel)) {
            $html .= $this->btn_cancel;
        }
        if (!empty($this->txt)) {
            $html .= $this->txt;
        }
        if (!empty($this->end_fieldset)) {
            $html .= $this->end_fieldset;
        }
        $html .= '</form>' . " \n";
        if ($debug == true) {
            echo '<pre class="prettyprint">' . htmlspecialchars($html) . '</pre>';
        } else {
            return $html;
        }
    }

    /*=================================
    email sending
    =================================*/

    /**
     * Simplest way to send email with posted values
     *
     * Detects posted values to send ; removes unwanted values ($filter_values)
     * Tests and secures values to prevent attacks (phpmailer/extras/htmlfilter.php => HTMLFilter)
     * Creates an automatic html table with vars/values based on default template
     * (phpforms/mailer/email-templates/basic-template.[html|css])
     * Merges html/css to inline style
     * Sends email and catches errors
     *
     * @param string $from_email    e-mail adress of the sender
     * @param string $adress        e-mail adress destination
     * @param string $subject       e-mail subject
     * @param string $filter_values posted values you don't want to include in the e-mail,
     *                              separated with commas
     * @param string $values        array of merged values (see Form::mergeValues function)
     *
     * @return string success or error message
     */

    public static function sendMail($from_email, $adress, $subject, $filter_values = '', $values = '')
    {
        $mergedHtml = self::createMailContent($filter_values, $values);
        require_once 'mailer/phpmailer/PHPMailerAutoload.php';
        $mail = new \PHPMailer();
        $mail->From = $from_email;
        $mail->FromName = $from_email;
        $mail->addReplyTo($from_email, $from_email);
        $mail->addAddress($adress);
        $mail->Subject = $subject;
        $mail->msgHTML($mergedHtml, dirname(__FILE__), true);
        $charset = mb_detect_encoding($mergedHtml);
        $mail->CharSet = $charset;
        if (!$mail->send()) {
            return '<p class="alert alert-danger">Mailer Error: ' . $mail->ErrorInfo . '</p>' . " \n";
        } else {
            return '<p class="alert alert-success">Your message has been successfully sent !</p>' . " \n";
        }
    }

    /**
     * Advanced way to send email with posted values
     *
     * Tests and secures values to prevent attacks (phpmailer/extras/htmlfilter.php => HTMLFilter)
     * Uses custom html/css template and replaces {fields} in template with posted values
     * OR Creates an automatic html table with vars/values based on default template
     * (phpforms/mailer/email-templates/basic-template.[html|css])
     * Merges html/css to inline style
     * Sends email and catches errors
     * @param  array  $options
     *                         from_name [optional]            : the name of the sender
     *                         from_email                      : the email of the sender
     *                         reply_to [optional]             : the email for reply
     *                         adress                          : the email destination(s), separated with commas
     *                         cc [optional]                   : the email(s) of copies to send, separated with commas
     *                         bcc [optional]                  : the email(s) of blind copies to send, separated with commas
     *                         subject                         : The email subject
     *                         attachments [optional]          : file(s) to attach : separated with commas, or array (see details inside function)
     *                         html_template [optional]        : url of the html template to use
     *                         css_template [optional]         : url of the css template to use
     *                         filter_values [optional]        : if html_template leaved empty, posted values you don't want to include in the e-mail based on the default template
     *                         custom_replacements [optional]  : array to replace shortcodes in email template. ex : array('mytext' => 'Hello !') will replace {mytext} with Hello !
     *                         sent_message [optional]         : message to display when email is sent
     *                         display_errors [optional]       : displays sending errors
     * @return string sent_message          success or error message to display on the page
     */

    public static function sendAdvancedMail($options, $values = '')
    {
        $default_options = array(
            'from_name'           =>  '',
            'from_email'          =>  '',
            'reply_to'            =>  '',
            'adress'              =>  '',
            'cc'                  =>  '',
            'bcc'                 =>  '',
            'subject'             =>  'Contact',
            'attachments'         =>  '',
            'html_template'       => '',
            'css_template'        => '',
            'filter_values'       => '',
            'custom_replacements' => array(),
            'sent_message'        =>  '<p class="alert alert-success">Your message has been successfully sent !</p>',
            'display_errors'      =>  false,
        );

        if (empty($values) || !is_array($values)) {
            $values = $_POST;
        }

        /* replace default options with user's */

        foreach ($default_options as $key => $value) {
            if (isset($options[$key])) {
                $$key = $options[$key];
            } else {
                $$key = $value;
            }
        }
        require_once 'mailer/phpmailer/PHPMailerAutoload.php';
        require_once 'mailer/pelago/Emogrifier.php';
        require_once 'mailer/phpmailer/extras/htmlfilter.php';
        $mail = new \PHPMailer();
        try {
            if ($from_name != '') {
                $mail->addReplyTo($from_email, $from_name);
                $mail->From = $from_email;
                $mail->FromName = $from_name;
            } else {
                $mail->addReplyTo($from_email);
                $mail->From = $from_email;
                $mail->FromName = $from_email;
            }
            $indiAdress = explode(",", $adress);
            foreach ($indiAdress as $key => $value) {
                $mail->addAddress(trim($value));
            }
            if ($bcc != '') {
                $indiBCC = explode(",", $bcc);
                foreach ($indiBCC as $key => $value) {
                    $mail->addBCC(trim($value));
                }
            }
            if ($cc != '') {
                $indiCC = explode(",", $cc);
                foreach ($indiCC as $key => $value) {
                    $mail->addCC(trim($value));
                }
            }
            if ($attachments != '') {

                /*

                    =============================================
                    single file :
                    =============================================

                    $attachments = 'path/to/file';

                    =============================================
                    multiple files separated with commas :
                    =============================================

                    $attachments = 'path/to/file_1, path/to/file_2';

                    =============================================
                    single file with file_path + file_name :
                    (specially for posted files)
                    =============================================

                    $attachments =  arrray(
                                        'file_path' => 'path/to/file.jpg', // complete path with filename
                                        'file_name' => 'my-file.jpg'
                                    )

                    =============================================
                    multiple files array containing :
                        sub-arrays with file_path + file_name
                        or file_name strings
                    =============================================

                    $attachments =  arrray(
                                        'path/to/file_1',
                                        'path/to/file_2',
                                        arrray(
                                            'file_path' => 'path/to/file.jpg', // complete path with filename
                                            'file_name' => 'my-file.jpg'
                                        ),
                                        ...
                                    )
                 */

                if (is_array($attachments)) {
                    if (isset($attachments['file_path'])) {
                        $mail->addAttachment($attachments['file_path'], $attachments['file_name']);
                    } else {
                        foreach ($attachments as $key => $value) {
                            if (is_array($value)) {
                                $mail->addAttachment($value["file_path"], $value["file_name"]);
                            } else {
                                $attach = explode(",", $attachments);
                                foreach ($attach as $key => $value) {
                                    $mail->addAttachment(trim($value));
                                }
                            }
                        }
                    }
                } else {
                    $attach = explode(",", $attachments);
                    foreach ($attach as $key => $value) {
                        $mail->addAttachment(trim($value));
                    }
                }
            }
            $mail->Subject = $subject;
        } catch (phpmailerException $e) { //Catch all kinds of bad addressing
            throw new phpmailerAppException($e->getMessage());
        }
        try {
            if ($html_template != '') {
                if (!$html = file_get_contents($html_template)) {
                    throw new \Exception('Html template file doesn\'t exists');
                }

                /* replacing posted values in html template */

                $filter = explode(",", $filter_values);
                for ($i = 0; $i < count($filter); $i++) {
                    $filter[$i] = trim(mb_strtolower($filter[$i]));
                }
                $replacements = array_merge($values, $custom_replacements);
                foreach ($replacements as $key => $value) {
                    if (!in_array(mb_strtolower($key), $filter) && !is_array($value)) {
                        $html = str_replace('{' . $key . '}', $replacements[$key], $html);
                    }
                }
                preg_replace('`{(.*)+}`', 'false', $html);

                if ($css_template != '') {
                    if (!$css = file_get_contents($css_template)) {
                        throw new \Exception('Css template file doesn\'t exists');
                    }
                    $emogrifier = new \Emogrifier();
                    $emogrifier->setHtml($html);
                    $emogrifier->setCss($css);
                    $mergedHtml = $emogrifier->emogrify();
                } else {
                    $mergedHtml = $html;
                }
                HTMLFilter($mergedHtml, '', false);
            } else {
                $mergedHtml = self::createMailContent($filter_values, $values);
            }
        } catch (\Exception $e) { //Catch all content errors

            return '<p class="alert alert-danger">' . $e->getMessage() . '</p>' . " \n";
        }
        $mail->msgHTML($mergedHtml, dirname(__FILE__), true);
        $charset = mb_detect_encoding($mergedHtml);
        $mail->CharSet = $charset;
        if (!$mail->send()) {
            if ($display_errors === true) {
                return '<p class="alert alert-danger">Mailer Error: ' . $mail->ErrorInfo . '</p>' . " \n";
            }
        } else {
            return $sent_message;
        }
    }

    /**
     * stores the ID of the form to be cleared.
     * when next instance is created it will not store posted values in session
     * unsets all sessions vars attached to the form
     * @param string $form_ID
     */
    public static function clear($form_ID)
    {
        $_SESSION['clear_form'][$form_ID] = true;
        foreach ($_SESSION[$form_ID]['fields'] as $key => $name) {
            unset($_SESSION[$form_ID]['fields'][$key]);
            unset($_SESSION[$form_ID][$name]);
        }
    }

    /*=================================
    private functions
    =================================*/

    /**
     * wrap element itself with error div if input is grouped or if $label is empty
     * @param  string $name
     * @param  string $label
     * @param  string $pos   'start' | 'end'
     * @return string div start | end
     */
    private function getErrorInputWrapper($name, $label, $pos)
    {
        $isGrouped = $this->isGrouped($name);
        if ($isGrouped == true || $label == '') {
            if (in_array($name, array_keys($this->error_fields))) {
                if ($pos == 'start') {
                    return '<div class="' . $this->options['wrapperErrorClass'] . '">' . " \n";
                } else {
                    return '</div>' . " \n";
                }
            }
        }
    }

    /**
     * check if name belongs to a group input
     * @param  string  $name
     * @return boolean
     */
    private function isGrouped($name)
    {
        foreach ($this->input_grouped as $input_grouped) {
            if (in_array($name, $this->input_grouped)) {
                return true;
            }
        }

        return false;
    }

    /**
     * [createMailContent description]
     * @param  string $filter_values posted values you don't want to include in the e-mail,
     *                               separated with commas
     * @return string body html of the e-mail = table with posted vars/values
     */
    private static function createMailContent($filter_values, $values)
    {
        if (empty($values) || !is_array($values)) {
            $values = $_POST;
        }
        $filter = explode(",", $filter_values);
        for ($i = 0; $i < count($filter); $i++) {
            $filter[$i] = trim(mb_strtolower($filter[$i]));
        }
        $email_table = '<table class="table table-bordered table-striped">' . " \n";
        $email_table .= '<tbody>' . " \n";
        foreach ($values as $key => $value) {
            if (!is_array($value)) {
                if (!in_array(mb_strtolower($key), $filter)) {
                    $email_table .= '<tr>' . " \n";
                    $email_table .= '<th>' . ucfirst($key) . ' : ' . '</th>' . " \n";
                    $email_table .= '<td>' . $value . '</td>' . " \n";
                    $email_table .= '</tr>' . " \n";
                }
            } else {
                foreach ($value as $key_array => $value_array) {
                    if (!in_array(mb_strtolower($key_array), $filter)) {
                        $email_table .= '<tr>' . " \n";
                        $email_table .= '<th>' . ucfirst($key) . ' ' . ucfirst($key_array) . ' : ' . '</th>' . " \n";
                        $email_table .= '<td>' . $value_array . '</td>' . " \n";
                        $email_table .= '</tr>' . " \n";
                    }
                }
            }
        }
        $email_table .= '</tbody>' . " \n";
        $email_table .= '</table>' . " \n";
        try {
            require_once 'mailer/pelago/Emogrifier.php';
            require_once 'mailer/phpmailer/extras/htmlfilter.php';
            $html_basic_template = str_replace('\\', DIRECTORY_SEPARATOR, __DIR__ . '/mailer/email-templates/basic-template.html');
            $css_basic_template = str_replace('\\', DIRECTORY_SEPARATOR, __DIR__ . '/mailer/email-templates/basic-template.css');
            // $html_basic_template = __DIR__ . 'mailer/email-templates/basic-template.html';
            // $css_basic_template = __DIR__ . 'mailer/email-templates/basic-template.css';
            if (!$html = file_get_contents($html_basic_template)) {
                    throw new \Exception('basic-template.html : Html basic template file doesn\'t exists');
            }
            if (!$css = file_get_contents($css_basic_template)) {
                throw new \Exception('basic-template.css : Css basic template file doesn\'t exists');
            }
            $email_content = str_replace('{table}', $email_table, $html);
            $emogrifier = new \Emogrifier();
            $emogrifier->setHtml($email_content);
            $emogrifier->setCss($css);
            $mergedHtml = $emogrifier->emogrify();
            HTMLFilter($mergedHtml, '', false);

            return $mergedHtml;
        } catch (\Exception $e) { //Catch all content errors

            return '<p class="alert alert-danger">' . $e->getMessage() . '</p>' . " \n";
        }
    }

    /**
     * Allows to group inputs in the same wrapper (3 inputs max.)
     * @param string $name        The input name
     * @param string $wrapper_pos start | end
     */

    private function setInputGroup($name, $wrapper_pos)
    {
        $grouped = false;
        $input_pos = ''; // start | middle | end
        $pattern_2_wrappers = '`<([^>]+)><([^>]+)></([^>]+)></([^>]+)>`';
        if ($wrapper_pos == 'start') {
            foreach ($this->input_grouped as $input_grouped) {
                // $this->input_grouped[] = array('input_1' => $input1, 'input_2' => $input2[, 'input_3' => $input3]);
                if ($name == $input_grouped['input_2']) {
                    $grouped = true;
                    $input_pos = 'middle';
                } elseif (isset($input_grouped['input_3']) && $name == $input_grouped['input_3']) {
                    $grouped = true;
                    $input_pos = 'end';
                }
            }
            if ($grouped == true && $input_pos == 'middle' || $input_pos == 'end') {
                if (preg_match($pattern_2_wrappers, $this->options['elementsWrapper'], $out)) {
                    return '<' . $out[2] . '>' . " \n";
                } else {
                    return '';
                }
            } else {
                return $this->elements_start_wrapper;
            }
        } elseif ($wrapper_pos == 'end') {
            foreach ($this->input_grouped as $input_grouped) {
                // $this->input_grouped[] = array('input_1' => $input1, 'input_2' => $input2[, 'input_3' => $input3]);
                if ($name == $input_grouped['input_1']) {
                    $grouped = true;
                    $input_pos = 'start';
                } elseif (isset($input_grouped['input_2']) && $name == $input_grouped['input_2'] && isset($input_grouped['input_3'])) {
                    $grouped = true;
                    $input_pos = 'middle';
                }
            }
            if ($grouped == true && $input_pos == 'start' || $input_pos == 'middle') {
                if (preg_match($pattern_2_wrappers, $this->options['elementsWrapper'], $out)) {
                    return '</' . $out[3] . '>' . " \n";
                } else {
                    return '';
                }
            } else {
                return $this->elements_end_wrapper;
            }
        }
    }

    /**
    * When the form is posted, values are passed in session
    * to be keeped and displayed again if posted values aren't correct.
    */

    private function registerField($name)
    {
        $form_ID = $this->form_ID;
        if (!isset($_SESSION[$form_ID])) {
            $_SESSION[$form_ID]           = array();
            $_SESSION[$form_ID]['fields'] = array();
        }
        $name = preg_replace('`(.*)\[\]`', '$1', $name); // if $name is an array, we register without hooks ([])
        if (!in_array($name, $_SESSION[$form_ID]['fields'])) {
            $_SESSION[$form_ID]['fields'][] = $name;
        }
    }

    /**
     * register posted values in session
     * @param string $form_ID
     */
    public static function registerValues($form_ID)
    {
        if (!isset($_SESSION[$form_ID])) {
            $_SESSION[$form_ID]           = array();
            $_SESSION[$form_ID]['fields'] = array();
        }
        foreach ($_SESSION[$form_ID]['fields'] as $index => $name) {
            if (isset($_POST[$name])) {
                $value = $_POST[$name];
                if (!is_array($value)) {
                    $_SESSION[$form_ID][$name] = trim($value);
                    // echo $name . ' => ' . $value . '<br>';
                } else {
                    $_SESSION[$form_ID][$name] = array();
                    foreach ($value as $array_key => $array_value) {
                        $_SESSION[$form_ID][$name][$array_key] = trim($array_value);
                        // echo $name . ' ' . $array_key . ' ' . $array_value . '<br>';
                    }
                }
            } else { // if checkbox unchecked, it hasn't been posted => we store empty value
                $_SESSION[$form_ID][$name] = '';
            }
        }
    }

    /**
     * merge previously registered session vars => values of each registered form
     * @param  array $forms_array array of forms IDs to merge
     * @return array pairs of names => values
     *                           ex : $values[$field_name] = $value
     */
    public static function mergeValues($form_names_array)
    {
        $values = array();
        foreach ($form_names_array as $form_name) {
            $fields = $_SESSION[$form_name]['fields'];
            foreach ($fields as $key => $field_name) {
                if (isset($_SESSION[$form_name][$field_name])) {
                    $values[$field_name] = $_SESSION[$form_name][$field_name];
                }
            }
        }

        return $values;
    }

    /**
    * Gets errors stored in session
    */

    private function registerErrors()
    {
        $formID = $this->form_ID;
        foreach ($_SESSION['errors'][$formID] as $field => $message) {

            /* replace dot syntax with array (field.index => field[] */

            $field = preg_replace('`\.(.*)+`', '[]', $field);
            $this->error_fields[$field] = $message;
        }
    }

    /**
    * Gets html code to start | end elements wrappers
    *
    * @param string $html The html wrapper code
    * @param string $pos 'start' or 'end'
    * @return string Starting or ending html tag
    */

    private function defineWrapper($html, $pos)
    {
        /* if 2 wrappers */

        $pattern_2_wrappers = '`<([^>]+)><([^>]+)></([^>]+)></([^>]+)>`';
        if (preg_match($pattern_2_wrappers, $html, $out)) {
            if ($pos == 'start') {
                return '<' . $out[1] . '>' . " \n" . '<' . $out[2] . '>' . " \n";
            } else {
                return '</' . $out[3] . '>' . " \n" . '</' . $out[4] . '>' . " \n";
            }
        }

        /* if only 1 wrapper */

        $pattern_1_wrapper = '`<([^>]+)></([^>]+)>`';
        if (preg_match($pattern_1_wrapper, $html, $out)) {
            if ($pos == 'start') {
                return '<' . $out[1] . '>';
            } else {
                return '</' . $out[2] . '>';
            }
        }
    }

    /**
    * Adds warnings class to elements wrappers
    *
    * @param string $start_wrapper The html wrapper code
    * @param string $name The element name
    * @return string Wrapper Html tag with or without error class
    */

    private function addWrapperErrorClass($start_wrapper, $name)
    {
        if (!preg_match('`' . $this->options['wrapperErrorClass'] . '`', $start_wrapper)) { // if input group, we may already have registered error for other input
            if (in_array($name, array_keys($this->error_fields)) && !empty($this->options['wrapperErrorClass'])) {
                if (preg_match('`class="`', $start_wrapper)) {
                    $start_wrapper = preg_replace('`class="`', 'class="' . $this->options['wrapperErrorClass'] . ' ', $start_wrapper);
                } else {
                    $start_wrapper = preg_replace('`>`', ' class="' . $this->options['wrapperErrorClass'] . '">', $start_wrapper);
                }
            }
        }

        return $start_wrapper;
    }

    /**
    * Gets element value
    *
    * Returns default value if not empty
    * Else returns session value if it exists
    * Else returns an emplty string
    *
    * @param string $name The element name
    * @param string $value The default value
    * @return string The element value
    */

    private function getValue($name, $value)
    {
        $form_ID = $this->form_ID;
        if (!empty($value)) {
            return $value;
        } elseif (isset($_SESSION[$form_ID][$name])) {
            return $_SESSION[$form_ID][$name];
        } elseif (preg_match('`([^\\[]+)\[([^\\]]+)\]`', $name, $out)) { // arrays
            $array_name = $out[1];
            $array_key = $out[2];
            if (isset($_SESSION[$form_ID][$array_name][$array_key])) {
                return $_SESSION[$form_ID][$array_name][$array_key];
            } else {
                return $_SESSION[$form_ID][$name];
            }
        } else {
            return '';
        }
    }

    /**
    * Adds warnings if the form was posted with errors
    *
    * Warnings are stored in session, and will be displayed
    * even if your form was called back with header function.
    *
    * @param string $name The element name
    * @return string The html error
    */

    private function getError($name)
    {
        if (in_array($name, array_keys($this->error_fields))) {
            return '<p class="' . $this->options['textErrorClass'] . '">' . $this->error_fields[$name] . '</p>' . " \n";
        }
    }

    /**
    * Automaticaly adds requiredMark (see options) to labels's required fields
    * @param string $label The element label
    * @param string $attr The element attributes
    * @return string The element label if required html markup if needed
    */

    private function getRequired($label, $attr)
    {
        if (preg_match('`required`', $attr)) {
            preg_match('`([^:]+)(: )*(.*)`', $label, $out);

            return $out[1] . $this->options['requiredMark'] . $out[2] . $out[3];

        } else {
            return $label;
        }
    }

    /**
    * Returns linearised attributes.
    * @param string $attr The element attributes
    * @return string Linearised attributes
    *                Exemple : size=30, required=required => size="30" required="required"
    */

    private function getAttributes($attr)
    {
        if (empty($attr)) {
            return '';
        } else {
            // $attr = preg_replace('`id(\s)*=(\s)*[^,]+,*`i', '', $attr); // removing the ID
            $attr = preg_replace('`\s*=\s*`', '="', $attr) .  '"'; // adding quotes
            $attr = preg_replace_callback('`(.){1},\s*`', array($this, 'replaceCallback'), $attr);

            return $attr;
        }
    }

    /**
    * Used for getAttributes regex.
    */

    private function replaceCallback($motif)
    {
        /* if there's no antislash before the comma */
        if (preg_match('`[^\\\]`', $motif[1])) {
            return $motif[1] . '" ';
        } else {
            return ',';
        }
    }

    /**
     * used for chexkboxes | select options only.
     * adds or remove 'checked' or 'selected' according to default / session values.
     * @param  string $field_name
     * @param  string $value
     * @param  string $attr       ex : checked="checked", class="my-class"
     * @param  string $field_type select | checkbox
     * @return string $attr
     */
    private function getCheckedOrSelected($field_name, $value, $attr, $field_type)
    {
        $form_ID = $this->form_ID;
        $name_without_hook = preg_replace('`(.*)\[\]`', '$1', $field_name);
        if ($field_type == 'select') {
            $attr_selected = 'selected';
        } else {
            $attr_selected = 'checked';
        }
        if (isset($_SESSION[$form_ID][$name_without_hook])) {
            if (!is_array($_SESSION[$form_ID][$name_without_hook])) {
                if ($_SESSION[$form_ID][$name_without_hook] == $value) {
                    if (!preg_match('`' . $attr_selected . '`', $attr)) {
                        // $this->html .= ' selected="selected"';
                        $attr = $this->addAttribute($attr_selected, $attr);
                    }
                } else { // we remove 'selected' from $checkbox_attr as user has previously selected another, memorized in session.
                    $attr = $this->removeAttr($attr_selected, $attr);
                }
            } else {
                if (in_array($value, $_SESSION[$form_ID][$name_without_hook])) {
                    if (!preg_match('`' . $attr_selected . '`', $attr)) {
                        $attr = $this->addAttribute($attr_selected, $attr);
                    }
                } else { // we remove 'selected' from $attr as user has previously selected another, memorized in session.
                    $attr = $this->removeAttr('selected', $attr);
                }
            }
        }

        return $attr;
    }

    /**
     * used to add 'checked="checked"' | 'selected="selected"' to select options or checkboxes
     * @param  string $attr_to_add
     * @param  string $attr_string
     * @return string attributes with the added one
     */
    private function addAttribute($attr_to_add, $attr_string)
    {
        if (empty($attr_string)) {
            $attr_string = ' ' . $attr_to_add . '="' . $attr_to_add . '"';
        } else {
            $attr_string = ' ' . $attr_to_add . '="' . $attr_to_add . '",' . $attr_string;
        }

        return $attr_string;
    }

    /**
     * removes specific attribute from list (ex : removes 'checked="checked"' from radio in other than default has been stored in session)
     * @param  string $attr_to_remove ex : checked
     * @param  string $attr_string    ex : checked="checked", required
     * @return string attributes without the removed one
     */

    private function removeAttr($attr_to_remove, $attr_string)
    {
        if (preg_match('`,(\s)?' . $attr_to_remove . '((\s)?=(\s)?([\'|"])?' . $attr_to_remove . '([\'|"])?)?`', $attr_string)) { // beginning comma
            $attr_string = preg_replace('`,(\s)?' . $attr_to_remove . '((\s)?=(\s)?([\'|"])?' . $attr_to_remove . '([\'|"])?)?`', '', $attr_string);
        } elseif (preg_match('`' . $attr_to_remove . '((\s)?=(\s)?([\'|"])?' . $attr_to_remove . '([\'|"])?(\s)?)?,`', $attr_string)) { // ending comma
            $attr_string = preg_replace('`' . $attr_to_remove . '((\s)?=(\s)?([\'|"])?' . $attr_to_remove . '([\'|"])?(\s)?)?,`', '', $attr_string);
        } elseif (preg_match('`' . $attr_to_remove . '((\s)?=(\s)?([\'|"])?' . $attr_to_remove . '([\'|"])?(\s)?)?`', $attr_string)) { // no comma
            $attr_string = preg_replace('`' . $attr_to_remove . '((\s)?=(\s)?([\'|"])?' . $attr_to_remove . '([\'|"])?(\s)?)?`', '', $attr_string);
        }

        return $attr_string;
    }

    /**
    * Gets element ID.
    *
    * @param string $name The element name
    * @param string $attr The element attributes
    * @return string returns ID present in $attr if any,
    *                else returns field's name
    */

    private function getID($name, $attr)
    {
        if (empty($attr)) {  //
            $array_values['id'] = preg_replace('`\[\]`', '', $name); // if $name is an array, we delete '[]'
            $array_values['attributs'] = '';
        } else {
            if (preg_match('` id="([a-zA-Z0-9_-]+)"`', $attr, $out)) {
                $array_values['id'] = $out[1];
                $array_values['attributs'] = preg_replace('` id="([a-zA-Z0-9_-]+)"`', '', $attr);
            } else {
                $array_values['id'] = preg_replace('`\[\]`', '', $name);
                $array_values['attributs'] = $attr;
            }
        }

        return $array_values;
    }

    /**
    * Adds warnings class to elements wrappers
    *
    * @param string $name The element name
    * @return string The element start_wrapper html code with or without error class
    */

    private function addElementErrorClass($name)
    {
        if (in_array($name, array_keys($this->error_fields))) {
            if (preg_match('`class="`', $start_wrapper)) {
                $start_wrapper = preg_replace('`class="`', 'class="' . $this->options['wrapperErrorClass'] . ' ', $start_wrapper);
            } else {
                $start_wrapper = preg_replace('`>`', ' class="' . $this->options['wrapperErrorClass'] . '">', $start_wrapper);
            }
        }

        return $start_wrapper;
    }

    /**
    * Adds default element class to $attr.(see options).
    *
    * @param string $name The element name
    * @param string $attr The element attributes
    * @return string The element class with the one defined in options added.
    */

    private function addElementClass($name, $attr)
    {

        /* we retrieve error if any */

        $error_class = '';
        if (in_array($name, array_keys($this->error_fields)) && !empty($this->options['elementsErrorClass'])) {
            $error_class = ' ' . $this->options['elementsErrorClass'];
        }

        /* if $attr already contains a class we keep it and add elementClass */

        if (preg_match('`class="([^"]+)"`', $attr, $out)) {
            $new_class =  'class="' . $out[1] . ' ' . $this->options['elementsClass'] . $error_class . '"';

            return preg_replace('`class="([^"]+)"`', $new_class, $attr);
        } else { /* if $attr contains no class we add elementClass */
            if (empty($this->options['elementsClass'])) {
                if (empty($error_class)) {
                    return false;
                } else {
                    return ' class="' . $error_class . '"';
                }
            } else {
                return $attr . ' class="' . $this->options['elementsClass'] . $error_class . '"';
            }
        }
    }

    /**
    * Gets label class. (see options).
    *
    * @param string $element (Optional) 'standardElement', 'radio' or 'checkbox'
    * @param string $inline True or false
    * @return string The element class defined in form options.
    */

    private function getLabelClass($element = 'standardElement', $inline = '')
    {
        if ($element == 'standardElement') { // input, textarea, select
            if ($this->layout == 'horizontal') {
                if (!empty($this->options['horizontalLabelCol']) && !empty($this->options['horizontalLabelClass'])) {
                    return ' class="' . $this->options['horizontalLabelCol'] . ' ' . $this->options['horizontalLabelClass'] . '"';
                } elseif (!empty($this->options['horizontalLabelClass'])) {
                    return ' class="' . $this->options['horizontalLabelClass'] . '"';
                } elseif (!empty($this->options['horizontalLabelClass'])) {
                    return ' class="' . $this->options['horizontalLabelClass'] . '"';
                } else {
                    return '';
                }
            }
        } elseif ($element == 'radio') {
            if ($inline === true) {
                return ' class="' . $this->options['inlineRadioLabelClass'] . '"';
            }
        } elseif ($element == 'checkbox') {
            if ($inline === true) {
                return ' class="' . $this->options['inlineCheckboxLabelClass'] . '"';
            }
        }
    }

    /**
    * Wrapps element with bootstrap's col if needed (see options).
    *
    * @param string $pos 'start' or 'end'
    * @param string $label The element label
    * @return string The html code of the element wrapper.
    */

    private function getElementCol($pos, $label = '')
    {
        if ($this->layout == 'horizontal' && !empty($this->options['horizontalElementCol'])) {
            if ($pos == 'start') {
                if (empty($label)) {
                    return '<div class="' . $this->options['horizontalOffsetCol'] . ' ' . $this->options['horizontalElementCol'] . '">' . " \n";
                } else {
                    return '<div class="' . $this->options['horizontalElementCol'] . '">' . " \n";
                }
            } else { // end

                return '</div>' . " \n";
            }
        } else {
            return '';
        }
    }

    /**
     * Gets html code to insert just berore or after the element
     *
     * @param  string $name                    The element name
     * @param  string $pos                     'start' or 'end'
     * @param  string $pos_relative_to_wrapper 'inside_wrapper' or 'outside_wrapper' (input groups are inside wrapper, help blocks are outside). Only for inputs.
     * @return string $return                 The html code to insert just before or after the element, inside or outside element wrapper
     *
     */
    private function getHtmlElementContent($name, $pos, $pos_relative_to_wrapper = '')
    {
        $return = '';
        if (isset($this->html_element_content[$name][$pos])) {
            for ($i=0; $i < count($this->html_element_content[$name][$pos]); $i++) {
                $html = $this->html_element_content[$name][$pos][$i];
                if (empty($pos_relative_to_wrapper)) {
                    $return .= $html . " \n";
                } else {
                    if ($pos_relative_to_wrapper == 'outside_wrapper' && !preg_match('`' . $this->options['inputGroupAddonClass'] . '`', $html)) {
                        $return .= $html . " \n";
                    } elseif ($pos_relative_to_wrapper == 'inside_wrapper' && preg_match('`' . $this->options['inputGroupAddonClass'] . '`', $html)) {
                        $return .= $html . " \n";
                    }
                }
            }

            return $return;
        } else {
            return '';
        }
    }

    /**
    * Gets css or js files needed for js plugins
    *
    * @param string $type 'css' or 'js'
    * @return html code to include needed files
    */

    private function getIncludes($type)
    {
        foreach ($this->js_plugins as $plugin_name) {
            $xml = simplexml_load_file(dirname(__FILE__) . '/plugins-config/' . $plugin_name . '.xml');
            for ($i=0; $i < count($this->js_content[$plugin_name]); $i++) {
                $js_content      = $this->js_content[$plugin_name][$i]; // default, custom, ...
                $js_replacements = $this->js_replacements[$plugin_name][$i];

                /* if custom include path doesn't exist, we keep default path */

                $path = '/root/' . $js_content . '/includes/' . $type . '/file';
                if ($xml->xpath($path) == false) {
                    $path = '/root/default/includes/' . $type . '/file';
                }
                $files = $xml->xpath($path);
                if (!isset($this->css_includes[$plugin_name])) {
                    $this->css_includes[$plugin_name] = array();
                }
                if (!isset($this->js_includes[$plugin_name])) {
                    $this->js_includes[$plugin_name] = array();
                }
                foreach ($files as $file) {
                    if (is_array($js_replacements)) {
                        foreach ($js_replacements as $key => $value) {
                            $file = preg_replace('`' . $key . '`', $value, $file);
                        }
                    }
                    if ($type == 'css' && !in_array($file, $this->css_includes[$plugin_name])) {
                        $this->css_includes[$plugin_name][] = (string) $file;
                    } elseif ($type == 'js' && !in_array($file, $this->js_includes[$plugin_name])) {
                        $this->js_includes[$plugin_name][] = (string) $file;
                    }
                }
            }
        }
    }

    /**
     * Gets js code generated by js plugins
     */

    private function getJsCode()
    {
        $nbre_plugins = count($this->js_plugins);
        if (!empty($nbre_plugins)) {
            $this->js_code = '<script type="text/javascript">' . " \n";
            $this->js_code .= $this->options['openDomReady'] . " \n";
        }
        for ($i=0; $i < $nbre_plugins; $i++) {
            $plugin_name = $this->js_plugins[$i]; // ex : colorpicker
            $nbre = count($this->js_fields[$plugin_name]);
            $xml = simplexml_load_file(dirname(__FILE__) . '/plugins-config/' . $plugin_name . '.xml');
            for ($j=0; $j < $nbre; $j++) {
                $selector = $this->js_fields[$plugin_name][$j];
                $js_replacements = $this->js_replacements[$plugin_name][$j];
                $js_content    = $this->js_content[$plugin_name][$j];
                if ($plugin_name == 'fileupload') { // fileupload
                    $this->fileupload_js_code .= preg_replace('`%selector%`', $selector, $xml->$js_content->js_code);
                } else { // others
                    $this->js_code .= preg_replace('`%selector%`', $selector, $xml->$js_content->js_code);
                }
                if (is_array($js_replacements)) {
                    foreach ($js_replacements as $key => $value) {
                        if ($plugin_name == 'fileupload') { // fileupload
                            $this->fileupload_js_code = preg_replace('`' . $key . '`', $value, $this->fileupload_js_code);
                        } else { // others
                            $this->js_code = preg_replace('`' . $key . '`', $value, $this->js_code);
                        }
                    }
                }
            }
        }
        if (!empty($nbre_plugins)) {
            $this->js_code .= $this->options['closeDomReady'] . " \n";
            $this->js_code .= '</script>' . " \n";
        }
    }
}
