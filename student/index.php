<?php
    require("../config.php") ;
    require("../UTILS/AUTH.php");
    if(!isset($_SESSION['XD_UId'])) {
        $USER = $_POST["susername"];
        $PASS = $_POST["spassword"];
        activateUser($USER, $USER, 'Student');
    }
    else
        $USER = $_SESSION['XD_UId'];
?>

<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.min.css"/>
        <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
        * {
            font-family: "sans-serif";
        }
        </style>
        <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/index.js"></script>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a href="./" class="brand"><?php echo $PROJECT_NAME; ?></a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li><a href="./">I am student</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <li id="fat-menu" class="dropdown">
                              <a href="#" id="drop" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $USER; ?><b class="caret"></b></a>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="drop">
                            <li><a tabindex="-1" href="#">Enjoy Clicking!</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="../logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
