<?php
    if(!isset($_POST['ajaxFunction']))
        die();

    require_once dirname(__FILE__) .'/DB.php';
    require_once dirname(__FILE__) .'/AUTH.php';
    require_once dirname(__FILE__) .'/LDAP.php';

    if($_POST['ajaxFunction'] == "CHK_LOGIN") {
        $returnValue = array("message" => "Invalid Username or Password!", "result" => false);

        if(isset($_POST["ldapUser"]) && isset($_POST["ldapPass"])) {
            if(($ldapRes = @ldap_authenticate($_POST["ldapUser"], $_POST["ldapPass"])) != false) {
                $returnValue["message"] = "Login Successful!";
                $returnValue["result"] = true;
            }
        }

        if($returnValue["result"]) {
            if($ldapRes['employeetype'][0] == 'fac')
                activateUser($ldapRes['uid'][0], $ldapRes['givenname'][0], "I");
            else
                activateUser($ldapRes['uid'][0], $ldapRes['givenname'][0], "S");

            if(!isMember())
                addMember($ldapRes['employeenumber'][0], $ldapRes['uid'][0], $ldapRes['givenname'][0], $ldapRes['mail'][0], $_SESSION['iXD_Type']);
        }
    } else if($_POST['ajaxFunction'] == "CHK_COURSE") {
        $returnValue = array("message" => "Invalid course code provided!", "result" => false);

        if(isset($_POST["courseCode"])) {
            if(courseExists($_POST["courseCode"]) != false) {
                $returnValue["message"] = "This course code already exists!";
                $returnValue["result"] = false;
            } else {
                $returnValue["message"] = "This course code looks like a new one!";
                $returnValue["result"] = true;
            }
        }
    } else if($_POST['ajaxFunction'] == "CHK_SEMESTER") {
        $returnValue = array("message" => "Invalid course code provided!", "result" => false);

        if(isset($_POST["courseCode"])) {
            if(isCourseRunningThisSem($_POST["courseCode"]) != false) {
                $returnValue["message"] = "This course is already running this semester!";
                $returnValue["result"] = false;
            } else {
                $returnValue["message"] = "This course code looks like a new one!";
                $returnValue["result"] = true;
            }
        }
    }

    echo json_encode($returnValue);
?>
