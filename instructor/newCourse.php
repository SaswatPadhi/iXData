<?php
    require_once("../lib/DB.php");
    require_once("../lib/AUTH.php");
    require_once("../lib/LDAP.php");

    ensureLoggedIn("I");
    if(isset($_SESSION['member'])) {
        if($_SESSION['member'] == false) {
            header('Location: register.php');
            die();
        }
    }

    $courseCode = $_POST['courseCode'];
    $courseName = $_POST['courseName'];
    $rollnoPRE  = $_POST['rollnoPRE'];
    $rollnoLL   = $_POST['rollnoLL'];
    $rollnoUL   = $_POST['rollnoUL'];
    $rollno     = $_POST['rollno'];

    $courseAdded = addCourse($courseCode, $courseName);
    $courseHistoryAdded = addCourseHistory($courseCode);
    $courseInstructorAdded = addInstructorCourse($courseHistoryAdded);

    $LL = (int)$rollnoLL;
    $UL = (int)$rollnoUL;
    $studentAddedLog = array();
    $studentCourseLog = array();
    $intWidth = strlen($rollnoUL);

    for($i = $LL; $i <= $UL; ++$i) {
        $roll = $rollnoPRE . sprintf("%0" . $intWidth . "d", $i);
        $result = @ldap_find($roll);
        if($result) {
            $studentAddedLog[$roll] = addStudentInfo($result['employeenumber'][0], $result['uid'][0], $result['givenname'][0], $result['mail'][0]);
            $studentCourseLog[$roll] = addStudentCourse($courseHistoryAdded, $result['uid'][0]);
        } else {
            $studentAddedLog[$roll] = false;
            $studentCourseLog[$roll] = false;
        }
    }
?>
