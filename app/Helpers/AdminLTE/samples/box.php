<?php
use Helpers\DkRbac;
use Helpers\AdminLTE\Box;

$box = new Box();
$box->footer = "df";
$box->title = "Hello Box";
$box->body = "d<br>ee";
$box->witdh = 2; // min 2 max 12
$box->color = "info";
$box->addTool('<span data-toggle="tooltip" title="ToolTip" class="badge bg-red">3</span>');
$box->addTool('<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>');
$box->addTool('<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>');
$box->border = false;

$box2 = new Box();
$box2->title = "Hello Box";
$box2->body = "d<br>ee";
$box2->witdh = 10; // min 2 max 12
$box2->color = "info";

$box2->addTool('<span data-toggle="tooltip" title="Tooltip" class="label bg-red">Warning</span>');
$box2->addTool('<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>');
$box2->addTool('<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>');
$box2->border = false;
?>

<div class="row">
    <?=$box->render();?>
    <?=$box2->render();?>
</div>