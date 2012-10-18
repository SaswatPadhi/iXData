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
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>
        <link rel="stylesheet" type="text/css" href="css/ixdata.css"/>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a href="./" class="brand" style="font-size: 2em;"><b><?php echo $PROJECT_NAME; ?></b></a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li><a href="./">123</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="span8">
                    <div class="hero-unit">
                        <h1><?php echo $PROJECT_NAME; ?></h1>
                        <b>An SQL learning tool based on X-Data.</b><br><br>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
Pellentesque tortor ipsum, dapibus at congue a, facilisis vel quam. Aliquam vel sapien lectus, sed hendrerit ligula.
Quisque vel nisl non turpis pharetra facilisis sed vel tortor. Pellentesque tortor ipsum, dapibus at congue a, facilisis vel quam. Aliquam vel sapien lectus, sed hendrerit ligula.
Yahan pe kuch toh fekna hai!
                            <br><br>
                            <a href="" class="btn">Read more about XData...</a>
                        </p>
                    </div>
                </div>
                <div class="span4">
                    <center><div class="alert alert-info" id="loginMsg"><b><i class="icon-info-sign icon-large"></i> Please login with IIT-B LDAP to continue.</b></div></center>
                    <form class="form-horizontal well" name="loginForm">
                        <fieldset>
                            <legend>Instructor/Student Login</legend>
                            <div class="control-group">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-user-md"></i></span>
                                    <input type="text" class="input-xlarge" id="ldapUser" name="ldapUser">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-key"></i></span>
                                    <input type="password" class="input-xlarge" id="ldapPass" name="ldapPass">
                                </div>
                            </div>
                            <br>
                            <center><button type="submit" class="btn btn-primary"><i class="icon-hand-right"></i> Authenticate</button></center>
                        </fieldset>
                    </form>
                </div>
            </div>
            <hr>
            <footer>
                <p>Designed & Created by SSH.<span class="pull-right">&copy; Copyright IIT Bombay, 2012.</span></p>
            </footer>
        </div>

        <!-- Load JS -->
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/ixdata.js"></script>
    </body>
</html>
