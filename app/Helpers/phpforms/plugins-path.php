<?php

/* =============================================
	DEFINES THE 'plugins' ABSOLUTE DIR PATH
	NEEDED TO CALL PLUGINS CSS AND JS FILES
============================================= */

$localhost = array('127.0.0.1', "::1");
if (in_array($_SERVER['REMOTE_ADDR'], $localhost)) { // PATH FOR LOCALHOST'S PLUGINS DIR, REPLACE WITH YOUR OWN.
    define('PLUGINS_DIR', '/phpforms/plugins/');
} else { // PATH FOR PRODUCTION SERVER - DON'T USE THIS ADRESS PLEASE, REPLACE WITH YOUR OWN.
    define('PLUGINS_DIR', 'http://codecanyon.creation-site.org/phpforms/plugins/');
}

/* =============================================
    Don't modify the lines below
============================================= */

/**
 * removes url sheme and url host from PLUGINS_DIR
 * ex : http://codecanyon.creation-site.org/phpforms/plugins/ => /phpforms/plugins/
 * @param  [type] $path [description]
 * @return [type]       [description]
 */
function getRoot($path)
{
    $path_parsed = parse_url($path);
    if (empty($path_parsed['scheme'])) { // path is relative

        return rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . $path;
    } else { // path is absolute => we remove 'http://www.my-domain.com'
        $find = array('`' . $path_parsed['scheme'] . '://`', '`' . $path_parsed['host'] . '`');
        $replace = array('', '');

        return rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . preg_replace($find, $replace, $path);
    }
}

define('PLUGINS_ROOT', getRoot(PLUGINS_DIR));
