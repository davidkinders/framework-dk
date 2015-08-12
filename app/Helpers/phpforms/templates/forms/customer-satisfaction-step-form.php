<?php
use phpforms\Form;

/* =============================================
    start session and include form class
============================================= */

session_start();
include_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpforms/Form.php';
define('NUMBER_OF_STEPS', 5);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Step Customer Satisfaction Slide Form</title>

    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        #ajax-form {
            width: 100%;
            overflow: hidden;
        }
        #slide {
            width: <?php echo 100 * NUMBER_OF_STEPS ?>%;
        }
        .step {
            width: <?php echo 100 / NUMBER_OF_STEPS ?>%;
        }
        .step:not(#step-1) {
            opacity: 0;
        }
        .radio-label-vertical-wrapper {
            padding-bottom: 13px;
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }
        .radio-label-vertical-wrapper:before {
            content: ' ';
            display: block;
            width: 100%;
            height: 30px;
            background: #efefef;
            position: absolute;
            bottom: 0;
        }
        .radio-label-vertical-wrapper label:not(.radio-label-vertical) {
          display: block;
          width: 100%;
        }
        .radio-label-vertical {
            position: relative;
            display: inline-block;
            vertical-align: middle;
            padding: 0 20px;
            text-align: center;
        }
        .radio-label-vertical input {
            position: absolute;
            top: 28px;
            left: 50%;
            margin-left: -6px;
            display: block;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Step Customer Satisfaction Slide Form</h1>
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
                <legend>Customer Satisfaction Slide Step Form</legend>
                <div id="ajax-form">
                    <div id="slide">
                        <div class="step pull-left" id="step-1"></div>
                        <div class="step pull-left" id="step-2"></div>
                        <div class="step pull-left" id="step-3"></div>
                        <div class="step pull-left" id="step-4"></div>
                        <div class="step pull-left clearfix" id="step-5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajax({
                url: 'customer-satisfaction-step-form/cs-steps.php'
            })
            .done(function (data) {
                $('#step-1').html(data);
            });
        });
    </script>
</body>
</html>
