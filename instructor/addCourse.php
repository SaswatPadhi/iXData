<?php
    require("../config.php") ;
    require("../lib/AUTH.php");
    ensureLoggedIn("I");
    if(isset($_SESSION['member'])) {
        if($_SESSION['member'] == false) {
            header('Location: register.php');
            die();
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
            <h2 style="border-bottom: solid #ddd 1px;">Add New Course</h2>
            <center><div class="alert" id="fieldAlert" style="opacity: 0;">&nbsp;</div></center>
            <form class="form-horizontal" name="courseregister" action="newCourse.php" method="POST" onSubmit="return validateCourseInfo()">
                <fieldset>
                    <h4>Course Details:</h4>
                    <div class="control-group">
                        <label class="control-label" for="courseCode">Course Code</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-tag icon-large"></i></span>
                                <input type="text" class="input-medium" id="courseCode" name="courseCode" maxlength="8" placeholder="CS 123">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="courseName">Course Name</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-book icon-large"></i></span>
                                <input type="text" class="input-xxlarge" id="courseName" name="courseName" placeholder="Intermediate SQL">
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4>Student Enrolment:</h4>
                    <div class="control-group">
                        <label class="control-label" for="rollnoLL">Roll No. Prefix</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-search icon-large"></i></span>
                                <input type="text" class="input-medium" id="rollnoPRE" name="rollnoPRE" placeholder="09D0300">
                            </div>
                            <span style="font-size: 0.9em;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Range &nbsp; &nbsp; &nbsp; </span>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-chevron-right icon-large"></i></span>
                                <input type="text" class="input-small" id="rollnoLL" name="rollnoLL" placeholder="01">
                            </div>
                            &#8210;
                            <div class="input-append">
                                <input type="text" class="input-small" id="rollnoUL" name="rollnoUL" placeholder="88">
                                <span class="add-on"><i class="icon-chevron-left icon-large"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="rollno">Additional Roll No.</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-plus-sign icon-large"></i></span>
                                <input type="text" class="input-xxlarge" id="rollno" name="rollno" placeholder="100050061; 10D020014; 100050020">
                            </div>
                        </div>
                    </div>
                    <?php
                        require_once("../lib/DB.php");
                        if(isset($_SESSION['courseCode'])) {
                            echo "<div class='row'><div class='span4 offset1'><div class='alert alert-error'><i class='icon-minus-sign icon-large'></i> ";
                            echo $_SESSION['courseCode']." already Exist.";
                            echo "</div></div></div>";
                            unset($_SESSION['courseCode']);
                        }
                    ?>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Register Course</button>
                        <button type="button" class="btn" onclick="window.location='./'"><i class="icon-trash"></i> Cancel</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- Load JS -->
        <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/instructor_addcourse.js"></script>
    </body>
</html>
