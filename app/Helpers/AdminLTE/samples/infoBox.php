<?php
use Helpers\DkRbac;
use Helpers\AdminLTE\InfoBox;

$box = new InfoBox();
$box->text = "Hello Box";
$box->content = "14.200";
$box->witdh = 2; // min 2 max 12
$box->color = "light-blue";
$box->icon = "fa fa-envelope"
?>

<div class="row">
    <?=$box->render();?>
</div>