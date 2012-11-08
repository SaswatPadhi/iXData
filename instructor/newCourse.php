<?php
    require_once("../lib/DB.php");
    require_once("../lib/AUTH.php");
    require_once("../lib/LDAP.php");
    ensureLoggedIn("I");

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

    $rollNumbers = explode(",",$rollno);
    for ($i = 0; $i < sizeof($rollNumbers); $i++) {
        $roll = $rollNumbers[$i];
        if($roll != "") {
            $result = @ldap_find($roll);
            if($result) {
                $studentAddedLog[$roll] = addStudentInfo($result['employeenumber'][0], $result['uid'][0], $result['givenname'][0], $result['mail'][0]);
                $studentCourseLog[$roll] = addStudentCourse($courseHistoryAdded, $result['uid'][0]);
            } else {
                $studentAddedLog[$roll] = false;
                $studentCourseLog[$roll] = false;
            }
        }
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/ixdata.css"/>
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.css"/>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
    </head>
    <body>
         <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a href="./" class="brand" style="font-size: 2em;"><b><?php echo $PROJECT_NAME; ?></b></a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="./"><i class="icon-home icon-large"></i> Home</a></li>
                            <li><a href="./"><i class="icon-table icon-large"></i> Stats</a></li>
                            <li><a href="./"><i class="icon-star icon-large"></i> Grades</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <li><a href="./"><i class="icon-cogs"></i> About XData</a></li>
                            <li class="divider-vertical"></li>
                            <li id="fat-menu" class="dropdown">
                                <a href="" id="drop" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-large"></i><?php echo $_SESSION['iXD_UName']; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="drop">
                                    <li><a tabindex="-1" href="profile.php"><i class="icon-user-md"></i> Profile</a></li>
                                    <li class="divider"></li>
                                    <li><a tabindex="-1" href="../logout.php"><i class="icon-signout"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h2 style="border-bottom: solid #ddd 1px;">Registered new course..</h2>
            <?php
                if(!$courseAdded)
                    echo "<div class='alert alert-error'> Course code could not be registered!</div>";
                if(!$courseHistoryAdded)
                    echo "<div class='alert alert-error'> Course could not be registered for this sem!</div>";
                if(!$courseInstructorAdded)
                    echo "<div class='alert alert-error'> You could not be registered as the course instructor!</div>";
                if($courseAdded && $courseHistoryAdded && $courseInstructorAdded)
                    echo "<div class='alert alert-success'> Students for the course ".$courseCode." are registered Successfully!</div>";
            ?>
            <center><button type="button" class="btn btn-primary" onclick="window.location='./addCourse.php'"><i class="icon-arrow-left"></i> Back</button></center>
        </div>
        <!-- Load JS -->
        <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    </body>
</html>
