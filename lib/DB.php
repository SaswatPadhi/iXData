<?php
    require_once dirname(__FILE__) .'/../config.php';

    $con = @mysql_connect("$PROJECT_HOST:$PROJECT_PORT", $PROJECT_USER, $PROJECT_PASS);
    if(!$con)
        return false;
    @mysql_select_db($PROJECT_BASE, $con);

    function mkdt($DT) {
        return date('Y-m-d H:i:s', strtotime($DT));
    }

    function bkdt($DT) {
        return date('m/d/Y H:i', strtotime($DT));
    }




    function isMember() {
        $query = "SELECT * FROM members WHERE usernameLDAP = '%s'";
        return (@mysql_num_rows(@mysql_query(sprintf($query, mysql_escape_string($_SESSION['iXD_UId'])))) != 0);
    }

    function addMember($EN, $UID, $FN, $MAIL, $T) {
        if($T == "I")
            addInstructorInfo($EN, $UID, $FN, $MAIL);
        else
            addStudentInfo($EN, $UID, $FN, $MAIL);
    }

    function getCourseCodeForHistoryCode($CHC) {
        $query = "SELECT courseCode FROM courseHistory WHERE courseHistoryCode = %s";
        $histRow = @mysql_fetch_array(@mysql_query(sprintf($query, $CHC)));
        return $histRow[0];
    }

    function getStudentCourses() {
        $query = "SELECT course.courseCode, course.courseName, courseHistory.courseHistoryCode FROM (courseHistory INNER JOIN courseTaker USING (courseHistoryCode)) INNER JOIN course USING(courseCode) WHERE courseTaker.usernameLDAP = '%s'";
        return @mysql_query(sprintf($query, mysql_escape_string($_SESSION['iXD_UId'])));
    }

    function getInstructorCourses() {
        $query = "SELECT usernameLDAP, realFullName, courseCode, courseName,courseHistoryCode FROM ((instructor INNER JOIN courseTeacher USING(usernameLDAP)) INNER JOIN (courseHistory INNER JOIN course USING(courseCode)) USING(courseHistoryCode)) WHERE usernameLDAP= '%s'";
        return @mysql_query(sprintf($query, mysql_escape_string($_SESSION['iXD_UId'])));
    }

    function getCourseExercises($CHC) {
        $query = "SELECT * FROM exercise WHERE courseHistoryCode = %s";
        return @mysql_query(sprintf($query, $CHC));
    }

    function addCourse($CC,$CN) {
        $query = "INSERT INTO course VALUES('%s', '%s')";
        return @mysql_query(sprintf($query, mysql_escape_string($CC), mysql_escape_string($CN)));
    }

    function addCourseHistory($CC) {
        $query = "SELECT MAX(courseHistoryCode) FROM courseHistory";
        $result = @mysql_query($query);
        while($row = @mysql_fetch_array($result))
            $maxHistoryCode = $row[0]+1;
        $query = "INSERT INTO courseHistory VALUES(%d, '%s', CEIL(MONTH(NOW())/6), YEAR(NOW()))";
        if(@mysql_query(sprintf($query, $maxHistoryCode, mysql_escape_string($CC))))
            return $maxHistoryCode;
        return false;
    }

    function addInstructorCourse($CHC) {
        $query = "INSERT INTO courseTeacher VALUES(%d, '%s')";
        return @mysql_query(sprintf($query, $CHC, mysql_escape_string($_SESSION['iXD_UId'])));
    }

    function addStudentInfo($EN, $UID, $FN, $MAIL) {
        $query = "INSERT INTO student VALUES('%s', '%s', '%s', '%s')";
        return @mysql_query(sprintf($query, mysql_escape_string($EN), mysql_escape_string($UID), mysql_escape_string($FN), mysql_escape_string($MAIL)));
    }

    function addInstructorInfo($EN, $UID, $FN, $MAIL) {
        $query = "INSERT INTO instructor VALUES('%s', '%s', '%s', '%s')";
        return @mysql_query(sprintf($query, mysql_escape_string($EN), mysql_escape_string($UID), mysql_escape_string($FN), mysql_escape_string($MAIL)));
    }

    function addStudentCourse($CHC, $UID) {
        $query = "INSERT INTO courseTaker VALUES(%d, '%s')";
        return mysql_query(sprintf($query, $CHC, mysql_escape_string($UID)));
    }

    function isCourseRunningThisSem($CC) {
        $query = "SELECT courseHistoryCode FROM courseHistory WHERE courseCode = '%s' AND year = YEAR(NOW()) AND semester = CEIL(MONTH(NOW())/6)";
        $result = @mysql_query(sprintf($query, mysql_escape_string($CC)));
        while($row = @mysql_fetch_array($result))
            return true;
        return false;
    }

    function courseExists($CC) {
        $query = "SELECT * FROM course WHERE courseCode = '%s'";
        $result = @mysql_query(sprintf($query, mysql_escape_string($CC)));
        while($row = @mysql_fetch_array($result))
            return true;
        return false;
    }

    function addExerciseCode($CHC, $createdBy, $question, $MM, $DA, $DB, $DC, $response) {
        $query = "SELECT MAX(exerciseCode) FROM exercise WHERE courseHistoryCode=%d";
        $result = @mysql_query(sprintf($query,$CHC));
        $maxEN = 1;
        while($row = @mysql_fetch_array($result))
            $maxEN = $row[0]+1;
        $query = "INSERT INTO exercise VALUES(%d, %s, '%s', '%s', NOW(), %s, '%s', '%s', '%s', '%s', 0)";
        return @mysql_query(sprintf($query, $maxEN, $CHC, mysql_escape_string($createdBy), mysql_escape_string($question), $MM, mkdt($DA), mkdt($DB), mkdt($DC), $response));
    }

    function updateExerciseCode($EN, $CHC, $createdBy, $question, $MM, $DA, $DB, $DC, $response) {
        $query = "DELETE FROM exercise WHERE exerciseCode = %d AND courseHistoryCode = %d";
        @mysql_query(sprintf($query, $EN, $CHC));
        $query = "INSERT INTO exercise VALUES(%d, %s, '%s', '%s', NOW(), %s, '%s', '%s', '%s', '%s', 0)";
        return @mysql_query(sprintf($query, $EN, $CHC, mysql_escape_string($createdBy), mysql_escape_string($question), $MM, mkdt($DA), mkdt($DB), mkdt($DC), $response));
    }

    function getQuestion($CHC,$EXN) {
        $query = "SELECT * FROM exercise WHERE exerciseCode=%d AND courseHistoryCode=%s";
        return @mysql_fetch_assoc(@mysql_query(sprintf($query, $EXN, $CHC)));
    }

    function getTeacherAndCourses() {
        $query = "SELECT course.courseCode, course.courseName, instructor.realFullName FROM (((course INNER JOIN courseHistory USING ( courseCode )) INNER JOIN courseTeacher USING ( courseHistoryCode )) INNER JOIN instructor USING ( usernameLDAP ))";
        return @mysql_query($query);
    }

    function updateExerciseStatus($EX, $CHC, $DSG) {
        $query = "UPDATE exercise SET dataSetGenerated = %d WHERE exerciseCode = %d AND courseHistoryCode = %d";
        return @mysql_query(sprintf($query, $DSG, $EX, $CHC));
    }

    function getFirstPendingDataSetJob() {
        $query = "SELECT * FROM exercise WHERE dataSetGenerated = 0 LIMIT 1";
        return @mysql_fetch_assoc(@mysql_query($query));
    }

    function getFirstPendingSubmissionCheck() {
        $query = "SELECT * FROM submission WHERE isEvaluated IS NULL LIMIT 1";
        return @mysql_fetch_assoc(@mysql_query($query));
    }
