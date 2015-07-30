<?php

use Helpers\AdminLTE\Assets;

echo "<ol class=\"breadcrumb\">";
foreach (Assets::getBreadcrumbs() as &$breadcrumb) {
    if ($_SERVER['REQUEST_URI'] == $breadcrumb['link']) {
        $active = "active";
    } else {
        $active = "";
    };
    echo "<li class=\"$active\"><a href=\"$breadcrumb[link]\">";
    if ($breadcrumb['icon'] <> "") {
        echo "<i class=\"$breadcrumb[icon]\"></i>";
    }
    echo "$breadcrumb[caption]</a></li>";
}
echo "</ol>";
?>