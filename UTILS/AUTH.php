<?php
    @session_start();
    @date_default_timezone_set("Asia/Kolkata");

    function activateUser($USER, $UserName,$Type) {
        @session_regenerate_id();
        $_SESSION['XD_UId'] = $USER;
        $_SESSION['XD_UName'] = $UserName;
        $_SESSION['XD_Type'] = $Type;
        $_SESSION['XD_UA'] = md5($_SERVER['HTTP_USER_AGENT'] . $USER . $Type, "..XD\m/");
    }

    function isLoggedIn() {
        @session_regenerate_id();
        if(isset($_SESSION['XD_UId']))
            if(isset($_SESSION['XD_UName']))
                if(isset($_SESSION['XD_UA']))
                    if($_SESSION['XD_UA'] == md5($_SERVER['HTTP_USER_AGENT'] . $_SESSION['XD_UId'] . $_SESSION['XD_Type'], "..XD\m/"))
                        return true;

        logoutUser();
        return false;
    }

    function ensureLoggedIn() {
        if(!isLoggedIn())
        {
            $currentLocation = "./";
            while(!file_exists($currentLocation . "config.php"))
                $currentLocation = $currentLocation . "../";
            header("Location: " . $currentLocation);
            die();
        }
    }

    function logoutUser() {
        $_SESSION = array();
        @session_destroy();
    }

    function getClientIPAddress() {
       foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
          if (array_key_exists($key, $_SERVER) === true) {
             foreach (explode(',', $_SERVER[$key]) as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                   return $ip;
               }
            }
         }
        }
    }
?>
