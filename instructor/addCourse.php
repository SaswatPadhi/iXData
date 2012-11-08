<?php
    require_once("../config.php") ;
    require_once("../lib/AUTH.php");
    ensureLoggedIn("I");
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
            <form class="form-horizontal" name="courseregister" action="newCourse.php" method="POST" onSubmit="return validateCourseInfo()">
                <fieldset>
                    <h4>Course Details:</h4>
                    <div class="control-group">
                        <label class="control-label" for="courseCode">Course Code</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-tag icon-large"></i></span>
                                <input type="text" class="input-medium" id="courseCode" name="courseCode" maxlength="8" placeholder="CS 123" data-title="Course Code" data-content="Unique 8 character identifier for the course.">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="courseName">Course Name</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-book icon-large"></i></span>
                                <input type="text" class="input-xxlarge" id="courseName" name="courseName" placeholder="Intermediate SQL" data-title="Course Name" data-content="The title of the course.">
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
                                <input type="text" class="input-medium" id="rollnoPRE" name="rollnoPRE" placeholder="09D0300" data-title="Roll No. Prefix" data-content="A common prefix for all roll numbers in a range.">
                            </div>
                            <span style="font-size: 0.9em;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Range &nbsp; &nbsp; &nbsp; </span>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-chevron-right icon-large"></i></span>
                                <input type="text" class="input-small" id="rollnoLL" name="rollnoLL" maxlength="3" placeholder="01">
                            </div>
                            &#8210;
                            <div class="input-append">
                                <input type="text" class="input-small" id="rollnoUL" name="rollnoUL" maxlength="3" placeholder="88">
                                <span class="add-on"><i class="icon-chevron-left icon-large"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="rollno">Additional Roll No.</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-plus-sign icon-large"></i></span>
                                <input type="text" class="input-xxlarge" id="rollno" name="rollno" placeholder="100050061; 10D020014; 100050020" data-title="Additional Roll No." data-content="Here, you can enter additional roll numbers that do not follow the above prefixed-range pattern.<br>Separate using , or ;">
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Register Course</button>
                        <button type="button" class="btn" onclick="window.location='./'"><i class="icon-trash"></i> Cancel</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <div id="courseDuplicate" class="modal hide fade" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1" aria-labelledBy="courseDuplicateLable" aria-hidden="true">
            <div class="modal-header">
                <h3 id="courseDuplicateLable">Duplicate Course!</h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-error"></div>
            </div>
            <div class="modal-footer">
                <button id="courseDuplicateButton" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">OK</button>
            </div>
        </div>
        <!-- Load JS -->
        <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/instructor_addcourse.js"></script>
    </body>
</html>
