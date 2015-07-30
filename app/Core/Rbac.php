<?php

namespace Core;

use Helpers\Password;
use Helpers\Session;

/**
 * David K. version 20150724
 * * */
class Rbac {

    /**
     *
     * @var type 
     */
    private static $db = "";

    /**
     * 
     */
    static function init() {
        self::$db = \Helpers\Database::get();
    }

    /**
     * 
     * @return type
     */
    public static function getUsers() {
        self::init();
        return self::$db->select('SELECT * FROM rbac_users');
    }

    /**
     * 
     * @param type $username
     * @return type
     */
    public static function getUser($username) {
        self::init();

        $user = self::$db->select("SELECT username, surname, givenname, email FROM rbac_users WHERE username = '" . strtolower($username) . "'");
        return $user[0];
    }

    /**
     * Add a new user
     * @param type $username
     * @param type $surname
     * @param type $givename
     * @param type $email
     * @param type $password
     * @return boolean|string
     */
    public static function newUser($username, $surname, $givename, $email, $password = false) {

        self::init();
        // look if the user exists

        $count = self::$db->select("SELECT count(*) AS count FROM rbac_users WHERE username = '" . strtolower($username) . "'");

        if ($count[0]->count <> 1) {
            self::$db->insert('rbac_users', [
                "username" => strtolower($username),
                "surname" => $surname,
                "givenname" => $givename,
                "email" => $email
            ]);
            if ($password <> false) {
                self::setPassword($username, $password);
            }
            return true;
        } else {
            return "user already exists";
        }
    }

    /**
     * Delete the user and all his rights
     * @param type $username
     */
    public static function deleteUser($username) {
        self::init();
        self::$db->delete('rbac_assignment', ['username' => strtolower($username)]);
        self::$db->delete('rbac_users', ['username' => strtolower($username)]);
    }

    /**
     * 
     * @param type $username
     * @param type $surname
     * @param type $givename
     * @param type $email
     * @param type $password
     */
    public static function setUser($username, $surname, $givename, $email, $password = false) {
        self::init();

        self::$db->update('rbac_users', [
            "surname" => $surname,
            "givenname" => $givename,
            "email" => $email
                ], ["username" => trim($username)]);

        if ($password <> false) {
            self::setPassword($username, $password);
        }
    }

    /**
     * 
     * @param type $username
     * @param type $password
     * @return type
     */
    public static function setPassword($username, $password) {
        self::init();
        $password = Password::make($password);
        return self::$db->update("rbac_users", ["password" => $password], ["username" => trim($username)]);
    }

    /**
     * 
     * @param type $username
     * @param type $password
     * @param type $session
     * @return boolean
     */
    public static function login($username, $password, $session = true) {
        self::init();
        $dbPassword = self::$db->select("SELECT password FROM rbac_users WHERE username = '" . strtolower($username) . "'");

        if (Password::verify($password, $dbPassword[0]->password)) {
            // user OK
            $userDb = self::$db->select("SELECT username, surname, givenname, email, avatar, title FROM rbac_users WHERE username = '" . strtolower($username) . "'");
            $user = $userDb[0];

            if ($session == true) {
                Session::set("islogon", true);
                Session::set("username", $user->username);
                Session::set("surname", $user->surname);
                Session::set("givenname", $user->givenname);
                Session::set("email", $user->email);
                Session::set("title", $user->title);
                Session::set("avatar", $user->avatar);
                return $user;
            } else {
                return $user;
            }
        } else {
            // user NOK destroy session
            Session::destroy();
            return false;
        }
    }

// rights *********************************************

    /**
     * 
     * @return boolean
     */
    public static function isGuest() {
        if (Session::get("islogon") == true) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 
     * @param type $function
     * @param type $username
     * @return boolean
     */
    public static function canUser($function, $username = null) {
        self::init();
        if ($username == null) {
            $username = Session::get("username");
        }

        $assignedRights = self::$db->select("SELECT * FROM rbac_assignment WHERE username = '$username'");

        foreach ($assignedRights as $assignedRight) {
            if ($function == $assignedRight->rbac_items_keyname OR $assignedRight->rbac_items_keyname == 'role-admin') {
                return true;
            }
            $rechten[$assignedRight->rbac_items_keyname] = self::authItemChild($assignedRight->rbac_items_keyname);
        }

        if (self::in_array_r($function, $rechten)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $username
     * @param type $item
     * @return string
     */
    public static function giveUser($username, $item) {
        self::init();
        // look if the item exists

        $count = self::$db->select("SELECT count(*) AS count FROM rbac_items WHERE keyname = '$item'");

        if ($count[0]->count == 1) {
            // The item exists
            // look if the user already had the item
            $count = self::$db->select("SELECT count(*) AS count FROM rbac_assignment WHERE username = '" . strtolower($username) . "' AND rbac_items_keyname = '$item'");

            if ($count[0]->count <> 1) {
                self::$db->insert('rbac_assignment', [
                    "username" => strtolower($username),
                    "rbac_items_keyname" => $item
                ]);
            } else {
                return "user has already that item";
            }
        } else {
            return "item not exists";
        }
    }

    /**
     * remove the item from the user
     * @param type $username
     * @param type $item
     */
    public static function revokeUser($username, $item) {
        self::init();
        self::$db->delete('rbac_assignment', ['username' => strtolower($username), 'rbac_items_keyname' => $item]);
    }

    /**
     * 
     * @param type $name
     * @return type
     */
    private function authItemChild($name) {
        $data = self::$db->select("SELECT * FROM rbac_child_items WHERE rbac_items_parent = '$name'");

        foreach ($data as $row) {
            $rechten[] = $row->rbac_items_child;
            if (is_array(self::authItemChild($row->rbac_items_child))) {
                $rechten[] = self::authItemChild($row->rbac_items_child);
            }
        }
        return $rechten;
    }

    /**
     * Functie voor het opzoeken in een array
     * @param type $needle
     * @param type $haystack
     * @param type $strict
     * @return boolean
     */
    private function in_array_r($needle, $haystack, $strict = false) {
        if (is_array($haystack)) {
            foreach ($haystack as $item) {
                if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && self::in_array_r($needle, $item, $strict))) {
                    return true;
                }
            }
        }
        return false;
    }

}
