<?php
    require_once dirname(__FILE__) .'/../config.php';

    $con = mysql_connect("$PROJECT_HOST:$PROJECT_PORT", $PROJECT_USER, $PROJECT_PASS);
    if(!$con)
        return false;
    mysql_select_db($PROJECT_BASE, $con);

    function isMember() {
        $query = "SELECT * FROM members WHERE usernameLDAP = '%s'";
        return (mysql_num_rows(mysql_query(sprintf($query, $_SESSION['iXD_UId']))) != 0);
    }
    
    function getStudentCourses() {
        $query = "SELECT course.courseCode, course.courseName FROM (courseHistory INNER JOIN courseTaker USING (courseHistoryCode)) INNER JOIN course USING(courseCode) WHERE courseTaker.usernameLDAP = '%s'";
        return mysql_query(sprintf($query, $_SESSION['iXD_UId']));
    }
    
    function getInstructorCourses() {
        $query = "SELECT i.usernameLDAP,i.realFullName,cH.courseCode as cCode,c.CourseName as cName FROM instructor as i,courseTeacher as cT,courseHistory as cH,course as c WHERE i.usernameLDAP=cT.usernameLDAP and cT.courseHistoryCode=cH.courseHistoryCode and cH.courseCode=c.courseCode and i.usernameLDAP= '%s'";
        return mysql_query(sprintf($query, $_SESSION['iXD_UId']));
    }
    
    function addCourses($CC,$CN) {
        $query = "INSERT INTO course VALUES('%s', '%s')";
        return mysql_query(sprintf($query, $CC, $CN));
    }
    
    function addCourseHistory($CHC, $CC, $S) {
        $query = "INSERT INTO courseHistory VALUES(%d, '%s', %d, YEAR(NOW()))";
        return mysql_query(sprintf($query, $CHC, $CC, $S));
    }
    
    function addInstructorCourse($CHC, $UID) {
        $query = "INSERT INTO courseTeacher VALUES(%d, '%s')";
        return mysql_query(sprintf($query, $CHC, $UID));
    }
    
    function maxHistoryCode() {
        $query = "SELECT max(courseHistoryCode) as maxCHC FROM courseHistory";
        return mysql_query($query);
    }
    
    function maxStudentNumber() {
        $query = "SELECT max(employeeNumber) as maxSN FROM student";
        return mysql_query($query);
    }
    
    function insertStudentInfo($EN, $UID, $FN, $MAIL) {
        $query = "INSERT INTO student VALUES('%s', '%s', '%s', '%s')";
        return mysql_query(sprintf($query, $EN, $UID, $FN, $MAIL));
    }
    
    function insertStudentCourse($CHC, $UID) {
        $query = "INSERT INTO courseTaker VALUES(%d, '%s')";
        return mysql_query(sprintf($query, $CHC, $UID));
    }
    
    
    
