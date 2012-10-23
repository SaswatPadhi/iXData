<?php
    require_once("../lib/DB.php");
    require_once("../lib/LDAP.php");
    session_start();
    $courseCode = $_POST['courseCode'];
    $courseName = $_POST['courseName'];
    $rollnoLL = $_POST['rollnoLL'];
    $rollnoUL = $_POST['rollnoUL'];
    $rollno = $_POST['rollno'];
    
    
    //Adding the course
    $result1 = addCourses($courseCode, $courseName);
    
    //Adding the entries in coursehistorytable
    $max = maxHistoryCode();
    while($row = mysql_fetch_array($max))
    	$value = $row['maxCHC'];
    $result2 = addCourseHistory($value+1, $courseCode, 0);
    
    //adding the entries in courseTeacher
    $result3 = addInstructorCourse($value+1, $_SESSION['iXD_UId']);
    
    //adding the entries in student table
    $LL = (int)$rollnoLL;
    $UL = (int)$rollnoUL;
    $max = maxStudentNumber();
    while($row = mysql_fetch_array($max))
		$SN = $row['maxSN'];
	for($i = $LL; $i <= $UL; $i++) {
		ldap_values($i);
		$SN += 1; 
		insertStudentInfo($SN, $UID, $fullName, $mail);
		insertStudentCourse($value+1, $UID);
	}
    $_SESSION['courseCode'] = $courseCode;
    
    
	if($result1 && $result2 && $result3)
        header('Location: index.php');
    else 
        header('Location: add_course.php');
            

