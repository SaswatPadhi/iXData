<?php
    require_once 'config.php';
    require_once 'lib/AUTH.php';

    if(isLoggedIn("S"))         header("Location: student/");
    else if(isLoggedIn("I"))    header("Location: instructor/");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/ixdata.css"/>
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a href="./" class="brand" style="font-size: 2em;"><b><?php echo $PROJECT_NAME; ?></b></a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="./"><i class="icon-home icon-large"></i> Home</a></li>
                            <li class="active"><a href="./course.php"><i class="icon-book icon-large"></i> Courses</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <li><a href="./"><i class="icon-cogs"></i> About XData</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="hero-unit">
                    	<center><h2>Courses Offered<h2></center><hr>
                    	<table width="100%" ba>
						<?php
							require("lib/DB.php");
							$result = getTeacherAndCourses();
							echo "<tr>";
							echo "<td><b>CourseCode</b></td><td><b>CourseName</b></td><td><b>Instructor</b></td>";
							echo "</tr>";
							while($row = mysql_fetch_array($result)) {
								echo "<tr>";
								echo "<td>".$row['courseCode']."</td><td>".$row['courseName']."</td><td>".$row['realFullName']."</td>";
								echo "</tr>";
							}
						?> 
						</table>                       
                    </div>
                </div>
            </div>
            <hr>
            <footer>
                <p>Designed &amp; Created by SSH.<span class="pull-right">&copy; Copyright IIT Bombay, 2012.</span></p>
            </footer>
        </div>

        <!-- Load JS -->
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/ixdata.js"></script>
    </body>
</html>
