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
