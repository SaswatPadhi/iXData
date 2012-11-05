<?php
    require_once("../config.php") ;
    require_once("../lib/AUTH.php");
    require_once("../lib/DB.php");
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
            <h2 style="border-bottom: solid #ddd 1px;">Exercises for <?php echo getCourseCodeForHistoryCode($_GET['code']); ?></h2>
            <?php
                $result = getCourseExercises($_GET['code']);
                $count = 1;
                echo "<br><div class='container-fluid'>";
                while($row = mysql_fetch_array($result)) {
                    echo "<div class='row-fluid exerciserow'><a href='#'><div class='span1'>#" . $row['exerciseCode'];
                    echo "</div><div class='span2'>";
                    if($row['maximumMarks'] != NULL)
                        echo  "Maximum Marks : " .$row['maximumMarks'];
                    echo "</div><div class='span3'>";
                    if($row['deadlineA'] != NULL)
                        echo  "Deadline 1 : " .$row['deadlineA'];
                    echo "</div><div class='span3'>";
                    if($row['deadlineB'] != NULL)
                        echo  "Deadline 2 : " .$row['deadlineB'];
                    echo "</div><div class='span3'>";
                    if($row['deadlineC'] != NULL)
                        echo  "Deadline 3 : " .$row['deadlineC'];
                    echo "</div>";
                    echo "</a></div>";
                }
                echo "</div><br>";
            ?>
            <center><a href="addExercise.php?code=<?php echo $_GET['code'];?>" class="btn btn-info btn-large"><i class="icon-plus-sign"></i> &nbsp; Add New Exercise</a></center><br>

        </div>
        <!-- Load JS -->
        <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    </body>
</html>
