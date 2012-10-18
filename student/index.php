<?php
    require("../config.php") ;
    require("../lib/AUTH.php");
    ensureLoggedIn("S");
?>

<!doctype html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.css"/>
        <link rel="stylesheet" type="text/css" href="../css/ixdata.css"/>
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
                              <a href="#" id="drop" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['iXD_UName']; ?><b class="caret"></b></a>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="drop">
                            <li><a tabindex="-1" href="#">Enjoy Clicking!</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="../logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load JS -->
        <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    </body>
</html>
