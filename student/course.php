<?php
    require("../config.php") ;
    require("../lib/AUTH.php");
    ensureLoggedIn("S");
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
                            <li class="active"><a href="./"><i class="icon-home icon-large"></i> Home</a></li>
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
            <h2 style="border-bottom: solid #ddd 1px;">Exercises for <?php echo $_GET['courseCode'] ?></h2>
            <?php
            	require_once("../lib/DB.php");
            	$CHC = $_GET['code'];
            		
            	$result = displayCourses($CHC);
            	$count = 1;
            	echo "<br><div class='row'><ul class='nav nav-list'>";
            	while($row = mysql_fetch_array($result)) {
					echo "<li><a href='#'>Exercise Code: " . $row['exerciseCode'] . " | BY: " . $row['createdBy'];
					if($row['deadlineA'] != NULL) 
						echo  " | Deadline 1 : " .$row['deadlineA'];
					if($row['deadlineB'] != NULL) 
						echo  " | Deadline 2 : " .$row['deadlineB'];	
					if($row['deadlineC'] != NULL) 
						echo  " | Deadline 3 : " .$row['deadlineC'];
					if($row['maximumMarks'] != NULL) 
						echo  " | MaximumMarks : " .$row['maximumMarks'];
					echo "</a></li><br>";			
            	}
            	echo "</ul></div>";
            ?>
        
        </div>
        <!-- Load JS -->
        <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    </body>
</html>
