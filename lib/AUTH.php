<?php
    @session_start();
    @date_default_timezone_set("Asia/Kolkata");

    function activateUser($USER, $userName, $type) {
        @session_regenerate_id();
        $_SESSION['iXD_UId']   = $USER;
        $_SESSION['iXD_UName'] = $userName;
        $_SESSION['iXD_Type']  = $type;
        $_SESSION['iXD_UA']    = md5($_SERVER['HTTP_USER_AGENT'] . $USER . $type, "..XD\m/");
    }

    function isLoggedIn($type) {
        @session_regenerate_id();
        if(isset($_SESSION['iXD_UId']))
            if(isset($_SESSION['iXD_UName']))
                if(isset($_SESSION['iXD_Type']))
                    if(isset($_SESSION['iXD_UA']))
                        if($_SESSION['iXD_UA'] == md5($_SERVER['HTTP_USER_AGENT'] . $_SESSION['iXD_UId'] . $type, "..iXD\m/"))
                            return true;
        return false;
    }

    function ensureLoggedIn($type) {
        if(!isLoggedIn($type))
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
