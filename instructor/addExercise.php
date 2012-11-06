<?php
    require("../config.php") ;
    require("../lib/AUTH.php");
    ensureLoggedIn("I");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui-timepicker-addon.css"/>
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
            <h2 style="border-bottom: solid #ddd 1px;">Add New Exercise</h2>
            <form class="form-horizontal"  action="added.php" method="POST" onSubmit="return validateExerciseInfo()">
                <fieldset>
                    <h4>Exercise Details:</h4>
                    <div class="control-group">
                        <label class="control-label" for="courseName">Question</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-book icon-large"></i></span>
                                <textarea cols="50" rows="5" class="input-xxlarge" id="question" name="question" placeholder="Write an sql query for ...?"></textarea>;
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="rollno">Maximum Marks</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-star icon-large"></i></span>
                                <input type="text" class="input" id="maxmarks" name="maxmarks">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="rollno">DeadlineA</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-time icon-large"></i></span>
                                <input type="text" class="input" id="deadlineA" name="deadlineA">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="rollno">DeadlineB</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-time icon-large"></i></span>
                                <input type="text" class="input" id="deadlineB" name="deadlineB">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="rollno">DeadlineC</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-time icon-large"></i></span>
                                <input type="text" class="input" id="deadlineC" name="deadlineC">
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" class="input" id="CHC" name="CHC" value="<?php echo $_GET['code'];?>">

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><i class="icon-check"></i>Add Exercise</button>
                        <button type="button" class="btn" onclick="window.location='./'"><i class="icon-trash"></i> Cancel</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- Load JS -->
        <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-1.9.1.custom.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-sliderAccess.js"></script>
        <script type="text/javascript" src="../js/instructor_addexercise.js"></script>
    </body>
</html>
