<?php

namespace Helpers\AdminLTE;

/*
 * Assets
 *
 * @author David Kinders
 * @version 1.0
 * @date 13 Januari 2015 
 */

class Assets extends AdminLTE {

    private static $HeaderCss = [];
    private static $HeaderJs = [];
    private static $FooterCss = [];
    private static $FooterJs = [];
    private static $FooterScript = [];
    private static $error = null;

    public static function setError($message) {
        self::$error = $message;
    }

    public static function getError() {
        if (self::$error <> null) {
        //return "<script>bootbox.alert(\"".self::$error."\");</script>";    
        return "<script>bootbox.alert({message: \"".self::$error."\",animate: true, className: \"medium\"});</script>";
        }
    }

    public static function addFooterScript($script) {
        self::$FooterScript[] = $script;
    }

    public static function renderFooterScript() {
        $memory = "";
        foreach (self::$FooterScript as &$code) {
            $memory .= $code;
        }
        return $memory;
    }

    public static function addToHeader($type, $path) {
        if (strtolower($type) == 'css') {
            self::$HeaderCss[] = $path;
        }
        if (strtolower($type) == 'js') {
            self::$HeaderJs[] = $path;
        }
    }

    public static function renderHeader($type) {
        if (strtolower($type) == 'css') {
            return self::Generate('css', self::$HeaderCss);
        }
        if (strtolower($type) == 'js') {
            return self::Generate('js', self::$HeaderJs);
        }
    }

    public static function addToFooter($type, $path) {
        if (strtolower($type) == 'css') {
            self::$FooterCss[] = $path;
        }
        if (strtolower($type) == 'js') {
            self::$FooterJs[] = $path;
        }
    }

    public static function renderFooter($type) {
        if (strtolower($type) == 'css') {
            return self::Generate('css', self::$FooterCss);
        }
        if (strtolower($type) == 'js') {
            return self::Generate('js', self::$FooterJs);
        }
    }

    private function Generate($type, $array) {
        $memory = "";
        foreach ($array as &$line) {
            if (strtolower($type) == 'css') {
                $memory .= "<link href=\"$line\" rel=\"stylesheet\" type=\"text/css\"> \r\n";
            }
            if (strtolower($type) == 'js') {
                $memory .= "<script src=\"$line\" type=\"text/javascript\"></script> \r\n";
            }
        }
        return $memory;
    }

}
