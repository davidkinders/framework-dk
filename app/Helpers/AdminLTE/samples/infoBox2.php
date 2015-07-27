<?php
use Helpers\DkRbac;
use Helpers\AdminLTE\InfoBox2;

$box = new InfoBox2();
$box->text = "text";
$box->content = "content";
$box->witdh = 3; // min 2 max 12
$box->color = "light-blue";
$box->icon = "fa fa-info";
$box->progress = 25; // min 0 max 100
$box->description = "description"
?>

<div class="row">
    <?=$box->render();?>
</div>