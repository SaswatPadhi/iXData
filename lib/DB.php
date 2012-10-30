<?php
    require_once dirname(__FILE__) .'/../config.php';

    $con = @mysql_connect("$PROJECT_HOST:$PROJECT_PORT", $PROJECT_USER, $PROJECT_PASS);
    if(!$con)
        return false;
    @mysql_select_db($PROJECT_BASE, $con);

    function isMember() {
        $query = "SELECT * FROM members WHERE usernameLDAP = '%s'";
        return (@mysql_num_rows(@mysql_query(sprintf($query, $_SESSION['iXD_UId']))) != 0);
    }

    function getStudentCourses() {
        $query = "SELECT course.courseCode, course.courseName, courseHistory.courseHistoryCode FROM (courseHistory INNER JOIN courseTaker USING (courseHistoryCode)) INNER JOIN course USING(courseCode) WHERE courseTaker.usernameLDAP = '%s'";
        return @mysql_query(sprintf($query, $_SESSION['iXD_UId']));
    }

    function getInstructorCourses() {
        $query = "SELECT usernameLDAP, realFullName, courseCode, courseName FROM ((instructor INNER JOIN courseTeacher USING(usernameLDAP)) INNER JOIN (courseHistory INNER JOIN course USING(courseCode)) USING(courseHistoryCode)) WHERE usernameLDAP= '%s'";
        return @mysql_query(sprintf($query, $_SESSION['iXD_UId']));
    }

    function addCourse($CC,$CN) {
        $query = "INSERT INTO course VALUES('%s', '%s')";
        return @mysql_query(sprintf($query, $CC, $CN));
    }

    function addCourseHistory($CHC) {
        $query = "SELECT MAX(courseHistoryCode) FROM courseHistory";
        $result = @mysql_query($query);
        while($row = @mysql_fetch_array($result))
            $maxHistoryCode = $row[0]+1;
        $query = "INSERT INTO courseHistory VALUES(%d, '%s', CEIL(MONTH(NOW())/6), YEAR(NOW()))";
        if(@mysql_query(sprintf($query, $maxHistoryCode, $CHC)))
            return $maxHistoryCode;
        return false;
    }

    function addInstructorCourse($CHC) {
        $query = "INSERT INTO courseTeacher VALUES(%d, '%s')";
        return @mysql_query(sprintf($query, $CHC, $_SESSION['iXD_UId']));
    }

    function addStudentInfo($EN, $UID, $FN, $MAIL) {
        $query = "INSERT INTO student VALUES('%s', '%s', '%s', '%s')";
        return @mysql_query(sprintf($query, $EN, $UID, $FN, $MAIL));
    }

    function addStudentCourse($CHC, $UID) {
        $query = "INSERT INTO courseTaker VALUES(%d, '%s')";
        return mysql_query(sprintf($query, $CHC, $UID));
    }
    
    function displayCourses($CHC) {
        $query = "SELECT * FROM exercise WHERE courseHistoryCode = '%s'";
        return @mysql_query(sprintf($query, $CHC));
    }
