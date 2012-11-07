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
                            <li ><a href="./course.php"><i class="icon-book icon-large"></i> Courses</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <li class="active"><a href="./aboutXData.php"><i class="icon-cogs"></i> About XData</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        	
            	<div class="row">
                	<div class="span12">
                	<div class="hero-unit">
                    	<center><h2><?php echo $PROJECT_NAME; ?><h2></center><hr>
                    	                   
              		
              		<p>Out Interface would use XData which is being independently developed, as a black box. In other words, XData would do the generation of the datasets and the testing of query on them. Our interface would act as a bridge, that would facilitate the integration of custom schemas (provided by instructors) and submission of queries to XData and interpreting the results.</p>
              		<p>
              		The interface have same login for faculty and students. We have integrated the login authentication with IITB LDAP. We have separate accounts for each student on the server and we can keep track of their performance or some other metrics.
After logging in, the faculty members have an option of creating/uploading/linking to the schema over which the students would be writing queries. We have several options for this and we would chose the most one that would be most scalable.
			</p>
			<p>After logging in, the faculty members would have an option of add exercise and add course.In add course he can add a course and students can register for that course.In add exercise he can add exercise and will give correct query for the same and at max three deadlines for the same.
			</p> 
			<p>
			Similarly, the student see several assignments for the courses he has registered after logging in. They would then be able to submit SQL queries for particular assignment.And then the queries will be graded giving then the result.
			</p> 
              		
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
