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
                            <li class="active"><a href="./"><i class="icon-home icon-large"></i> Home</a></li>
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
            <h2 style="border-bottom: solid #ddd 1px;">Teaching Courses</h2>
            <form action="add_course.php">
            <center><button type="submit" class="btn btn-info btn-large"><i class="icon-plus-sign"></i> &nbsp; Add Courses</button></center>
            </form>
        <?php 
            require_once("../lib/DB.php");
            if(isset($_SESSION['courseCode'])) {
                echo "<div class='row'><div class='span4 offset1'><div class='alert alert-success'>";
                echo $_SESSION['courseCode']." is added to your account ! :)";
                echo "</div></div></div>";
                unset($_SESSION['courseCode']); 
            }                   
            $result = getInstructorCourses();
            $count = 0;
            while($row = mysql_fetch_array($result)) {
                if($count == 0)
                    echo "<div class='row'><div class='span4 offset1'>";
                else
                    echo "<div class='span4 offset2'>";
                echo "<div class='alert alert-info'><h3>" . $row['cCode'] . "</h3>" . $row['cName'] . "</div></div>";
                $count++;
                if($count == 2) {
                    echo "</div>";
                    $count = 0;
                }
            }
            if($count > 0)
                echo "</div>";
        ?>
        </div>
        <!-- Load JS -->
        <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    </body>
</html>
