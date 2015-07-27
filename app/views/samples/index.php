<?php
use Core\Rbac;
use Helpers\AdminLTE\Box;
?>
    
<?php
$content = "Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren '60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.";
$content2 = "In tegenstelling tot wat algemeen aangenomen wordt is Lorem Ipsum niet zomaar willekeurige tekst. het heeft zijn wortels in een stuk klassieke latijnse literatuur uit 45 v.Chr. en is dus meer dan 2000 jaar oud. Richard McClintock, een professor latijn aan de Hampden-Sydney College in Virginia, heeft één van de meer obscure latijnse woorden, consectetur, uit een Lorem Ipsum passage opgezocht, en heeft tijdens het zoeken naar het woord in de klassieke literatuur de onverdachte bron ontdekt. Lorem Ipsum komt uit de secties 1.10.32 en 1.10.33 van \"de Finibus Bonorum et Malorum\" (De uitersten van goed en kwaad) door Cicero, geschreven in 45 v.Chr. Dit boek is een verhandeling over de theorie der ethiek, erg populair tijdens de renaissance. De eerste regel van Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", komt uit een zin in sectie 1.10.32.
Het standaard stuk van Lorum Ipsum wat sinds de 16e eeuw wordt gebruikt is hieronder, voor wie er interesse in heeft, weergegeven. Secties 1.10.32 en 1.10.33 van \"de Finibus Bonorum et Malorum\" door Cicero zijn ook weergegeven in hun exacte originele vorm, vergezeld van engelse versies van de 1914 vertaling door H. Rackham.";


$box = new Box();
$box->footer = "The footer";
$box->title = "Lorem Ipsum";
$box->body = "$content";
$box->witdh = 4; // min 2 max 12
$box->color = "info";
$box->addTool('<span data-toggle="tooltip" title="ToolTip" class="badge bg-red">3</span>');
$box->addTool('<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>');
$box->addTool('<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>');
$box->border = false;

$box2 = new Box();
$box2->title = "Lorem Ipsum";
$box2->body = "<p>$content</p><p>$content</p>";
$box2->witdh = 8; // min 2 max 12
$box2->color = "warning";

$box2->addTool('<span data-toggle="tooltip" title="Tooltip" class="label bg-red">Warning</span>');
$box2->addTool('<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>');
$box2->addTool('<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>');
$box2->border = false;
?>

<h1>Standard Box</h1>
<div class="row">
    <?=$box->render();?>
    <?=$box2->render();?>
</div>

<?php
use Helpers\AdminLTE\InfoBox;

$box = new InfoBox();
$box->text = "Lorem Ipsum";
$box->content = "14.200";
$box->witdh = 2; // min 2 max 12
$box->color = "light-blue";
$box->icon = "fa fa-info";

$box2 = new InfoBox();
$box2->text = "New messages";
$box2->content = "33";
$box2->witdh = 4; // min 2 max 12
$box2->color = "light-blue";
$box2->icon = "fa fa-envelope";

$box3 = new InfoBox();
$box3->text = "Lorem Ipsum";
$box3->content = "14.200";
$box3->witdh = 6; // min 2 max 12
$box3->color = "light-blue";
$box3->icon = "fa fa-gear";
?>

<h1>Info Box</h1>
<div class="row">
    <?=$box->render();?>
    <?=$box2->render();?>
    <?=$box3->render();?>
</div>

<?php
use Helpers\AdminLTE\InfoBox2;

$box = new InfoBox2();
$box->text = "text";
$box->content = "content";
$box->witdh = 3; // min 2 max 12
$box->color = "light-blue";
$box->icon = "fa fa-info";
$box->progress = 25; // min 0 max 100
$box->description = "description";

$box2 = new InfoBox2();
$box2->text = "text";
$box2->content = "content";
$box2->witdh = 4; // min 2 max 12
$box2->color = "red";
$box2->icon = "fa fa-info";
$box2->progress = 33; // min 0 max 100
$box2->description = "description";

$box3 = new InfoBox2();
$box3->text = "text";
$box3->content = "content";
$box3->witdh = 5; // min 2 max 12
$box3->color = "green";
$box3->icon = "fa fa-info";
$box3->progress = 66; // min 0 max 100
$box3->description = "description";

?>

<h1>Info Box 2</h1>
<div class="row">
    <?=$box->render();?>
    <?=$box2->render();?>
    <?=$box3->render();?>
</div>