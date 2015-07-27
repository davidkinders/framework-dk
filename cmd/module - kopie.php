<?php
$usr = "david";
$grp = "david";

echo "Enter the name for your module: ";

$handle = fopen ("php://stdin","r");

$name = str_ireplace("\n","",fgets($handle));

$name = ucwords($name);
$name = str_ireplace(" ","",$name);

$PathModules = str_ireplace("cmd", "app/Modules/", getcwd());
$PathThisModule =  $PathModules . trim($name);
$PathThisModuleController = $PathThisModule . "/Controllers";
$PathThisModuleView = $PathThisModule . "/views";
$PathThisModuleModels = $PathThisModule . "/Models";

// Aanmaken de module map
mkdir($PathThisModule, 0755);
chown($PathThisModule, $usr);
chgrp($PathThisModule, $grp);
// Aanmaken de controller map
mkdir($PathThisModuleController, 0755);
chown($PathThisModuleController, $usr);
chgrp($PathThisModuleController, $grp);
// Aanmaken de modules map
mkdir($PathThisModuleModels, 0755);
chown($PathThisModuleModels, $usr);
chgrp($PathThisModuleModels, $grp);
// Aanmaken de view name
mkdir($PathThisModuleView, 0755);
chown($PathThisModuleView, $usr);
chgrp($PathThisModuleView, $grp);



$module = fopen($PathThisModule . "/" . strtolower("$name.module.php"), "w") or die("Unable to open file!");
$txt = "<?php"."\n";
$txt .= "\n";
$txt .= "use Helpers\Hooks;"."\n";
$txt .= "Hooks::addHook('routes', 'Modules\\$name\\Controllers\\$name@routes');"."\n";
fwrite($module, $txt);
fclose($module);
chown($PathThisModule . "/" . strtolower("$name.module.php"), $usr);
chgrp($PathThisModule . "/" . strtolower("$name.module.php"), $grp);

$module = fopen($PathThisModuleController."/$name.php", "w") or die("Unable to open file!");
$txt = "<?php"."\n";
$txt .= "\n";
$txt .= "namespace Modules\\$name\\Controllers;"."\n";
$txt .= ""."\n";
$txt .= "use Core\\Controller;"."\n";
$txt .= "use Core\\View;"."\n";
$txt .= "use Core\\Router;"."\n";
$txt .= ""."\n";
$txt .= "class $name extends Controller"."\n";
$txt .= "{"."\n";
$txt .= ""."\n";
$txt .= "\tprivate \$My".$name."Model;"."\n";
$txt .= ""."\n";
$txt .= "\tpublic function __construct()"."\n";
$txt .= "\t{"."\n";
$txt .= "\t\tparent::__construct();"."\n";
$txt .= "\t\t\$this->My".$name."Model = new \\Modules\\$name\\Models\\$name();"."\n";
$txt .= "\t}"."\n";
$txt .= ""."\n";
$txt .= "\tpublic function routes()"."\n";
$txt .= "\t{"."\n";
$txt .= "\t\tRouter::any('".strtolower($name)."', 'Modules\\$name\\Controllers\\$name@index');"."\n";
$txt .= "\t}"."\n";
$txt .= ""."\n";
$txt .= "\tpublic function index()"."\n";
$txt .= "\t{"."\n";
$txt .= "\t\t\$data['title'] = '$name';"."\n";
$txt .= "\t\t\$data['modeldata'] = \$this->My".$name."Model->my".$name."();"."\n";
$txt .= "\t\tView::renderTemplate('header', \$data);"."\n";
$txt .= "\t\tView::renderModule('$name/views/index', \$data);"."\n";
$txt .= "\t\tView::renderTemplate('footer', \$data);"."\n";
$txt .= "\t}"."\n";
$txt .= "}"."\n";

fwrite($module, $txt);
fclose($module);
chown($PathThisModuleController."/$name.php", $usr);
chgrp($PathThisModuleController."/$name.php", $grp);


$module = fopen($PathThisModuleView."/index.php", "w") or die("Unable to open file!");
$txt = "<div class=\"page-header\">"."\n";
$txt .= "\t<h1><?php echo \$data['title'] ?></h1>"."\n";
$txt .= "</div>"."\n";
$txt .= ""."\n";
$txt .= "<p>Hello from model: <?php echo \$data['modeldata'] ?></p>"."\n";
$txt .= ""."\n";
$txt .= ""."\n";

fwrite($module, $txt);
fclose($module);
chown($PathThisModuleView."/index.php", $usr);
chgrp($PathThisModuleView."/index.php", $grp);


$module = fopen($PathThisModuleModels."/$name.php", "w") or die("Unable to open file!");
$txt = "<?php"."\n";
$txt .= "\n";
$txt .= "namespace Modules\\$name\\Models;"."\n";
$txt .= ""."\n";
$txt .= "use Core\\Model;"."\n";
$txt .= ""."\n";
$txt .= "class $name extends Model"."\n";
$txt .= "{"."\n";
$txt .= "\tpublic function my$name()"."\n";
$txt .= "\t{"."\n";
$txt .= "\t\treturn \"$name\";"."\n";
$txt .= "\t}"."\n";
$txt .= "}"."\n";

fwrite($module, $txt);
fclose($module);
chown($PathThisModuleModels."/$name.php", $usr);
chgrp($PathThisModuleModels."/$name.php", $grp);

?>