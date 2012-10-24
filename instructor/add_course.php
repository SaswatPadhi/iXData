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
        <script language="javascript" type="text/javascript">
        	function Validate() {
        		var rollnoLL = document.courseregister.rollnoLL.value;
        		var rollnoUL = document.courseregister.rollnoUL.value;
        		var rollno = document.courseregister.rollno.value;
        		var CC = document.courseregister.courseCode.value;
        		var CN = document.courseregister.courseName.value;
        		if(CC == "" || CN == "") {
        			alert("Enter some courseCode and courseNumber");
        			return false;
        		}
        		if(rollno == "" && rollnoLL == "" && rollnoUL == "") {
        			alert("Enter some range of roll numbers or a particular value");
        			return false;
        		}
        		if(rollno != "" && rollnoLL != "" && rollnoUL != "") {
        			alert("Enter either the range or a particular roll no for insertion");
        			return false;
        		}
        		if(rollno != "" && rollnoLL == "" && rollnoUL == "") {
        			alert("Enter either the range or a particular roll no for insertion");
        			return false;
        		}
        		return true;	
        	}
        </script>
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
            <form class="form-horizontal well" name="courseregister" action="added.php" method="post" onSubmit="return Validate()">
                        <fieldset>
                            <legend>Add Courses</legend>
                            <div class="control-group">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-key icon-large"></i>&nbsp;&nbsp;Course Code:</span>
                                    <input type="text" class="input-xlarge" id="courseCode" name="courseCode">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-hand-right icon-large"></i>&nbsp;&nbsp;Course Name:</span>
                                    <input type="text" class="input-xlarge" id="courseName" name="courseName">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-circle-arrow-down icon-large"></i>&nbsp;&nbsp;Roll_no Lower Limit:</span>
                                    <input type="text" class="input-xlarge" id="rollnoLL" name="rollnoLL">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-circle-arrow-up icon-large"></i>&nbsp;&nbsp;Roll_no Upper Limit:</span>
                                    <input type="text" class="input-xlarge" id="rollnoUL" name="rollnoUL">
                                </div>
                            </div>
                            or<br><br>
                            <div class="control-group">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-plus-sign icon-large"></i>&nbsp;&nbsp;Add a particular Roll_no:</span>
                                    <input type="text" class="input-xlarge" id="rollno" name="rollno">
                                </div>
                            </div>
                            <?php
                                require_once("../lib/DB.php");
                                if(isset($_SESSION['courseCode'])) {
                                echo "<div class='row'><div class='span4 offset1'><div class='alert alert-error'><i class='icon-minus-sign icon-large'></i> ";
                                echo $_SESSION['courseCode']." already Exist.";
                                echo "</div></div></div>";
                                unset($_SESSION['courseCode']);
                                }
                            ?>
                            <center><button type="submit" class="btn btn-primary btn-large"><i class="icon-signin"></i> &nbsp; Add</button></center>
                        </fieldset>
                    </form>
        </div>
        <!-- Load JS -->
        <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    </body>
</html>
