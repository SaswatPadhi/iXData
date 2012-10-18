<?php
    require_once dirname(__FILE__) .'/DB.php';
    require_once dirname(__FILE__) .'/AUTH.php';
    require_once dirname(__FILE__) .'/LDAP.php';

    $returnValue = array("message" => "Invalid Username or Password!", "result" => false);
    if(isset($_POST)) {
        if(isset($_POST["ldapUser"]) && isset($_POST["ldapPass"])) {
            if(($ldapRes = @ldap_authenticate($_POST["ldapUser"], $_POST["ldapPass"])) != false) {
                $returnValue["message"] = "Login Successful!";
                $returnValue["result"] = true;
            }
        }
    }

    if($returnValue["result"]) {
        if($ldapRes['employeetype'][0] == 'fac')
            activateUser($ldapRes['uid'][0], $ldapRes['givenname'][0], "I");
        else
            activateUser($ldapRes['uid'][0], $ldapRes['givenname'][0], "S");

        if(!isMember($ldapRes['uid'][0]))
            $_SESSION['member'] = false;
    }

    echo json_encode($returnValue);
