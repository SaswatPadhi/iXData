<?php
    require_once("../lib/DB.php");
    session_start();
    $courseCode = $_POST['courseCode'];
    $courseName = $_POST['courseName'];
    $result1 = addCourses($courseCode, $courseName);
    
    $file = './HistoryCode';
    require_once("../lib/FILEREAD.php");
    $value = ((int)$data) + 1 ; 
    require_once("../lib/FILEWRITE.php");
    $result2 = addCourseHistory($value, $courseCode, 0);
    
    $result3 = addInstructorCourse($value, $_SESSION['iXD_UId']);
    echo $_SESSION['iXD_UId'];

    $_SESSION['courseCode'] = $courseCode;
    if($result1 && $result2 && $result3)
        header('Location: index.php');
    else 
        header('Location: add_course.php');
            

