<?php
    require_once("../lib/DB.php");
    require_once("../lib/AUTH.php");
    ensureLoggedIn("I");
    $ADD = "Add New Exercise";

    $result = NULL;
    if(isset($_POST['question'])) {
        $question = $_POST['question'];
        $response = $_POST['response'];
        $MM = $_POST['maxmarks'];
        $createdBy = $_SESSION['iXD_UId'];
        $CHC = $_GET['code'];
        $DA = $_POST['deadlineA'];
        $DB = $_POST['deadlineB'];
        $DC = $_POST['deadlineC'];

        if(!isset($_GET['number']))
            $result = addExerciseCode($CHC, $createdBy, $question, $MM, $DA, $DB, $DC, $response);
        else
            $result = updateExerciseCode($_GET['number'], $CHC, $createdBy, $question, $MM, $DA, $DB, $DC, $response);

        header("Location: ./exercise.php?code=".$CHC);
    } else if(isset($_GET['number'])) {
        $ADD = "Edit Exercise";
        $result = getQuestion($_GET['code'],$_GET['number']);
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.9.1.custom.css"/>
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
            <h2 style="border-bottom: solid #ddd 1px;"><?php echo $ADD;?></h2>
            <form class="form-horizontal"  action="addExercise.php<?php if(isset($_GET['number'])) echo '?code='.$_GET['code'].'&number='.$_GET['number']; else echo '?code='.$_GET['code']; ?>" method="POST" onSubmit="return validateExerciseInfo()">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="question">Question</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-book icon-large"></i></span>
                                <textarea cols="50" rows="5" class="input-xxlarge" id="question" name="question" placeholder="Write an sql query for ...?"><?php if($result != NULL) echo $result['question']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="response">Correct Response</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-book icon-large"></i></span>
                                <textarea cols="50" rows="3" class="input-xxlarge" id="response" name="response" placeholder="One possible valid response"><?php if($result != NULL) echo $result['correctResponse']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="maxmarks">Maximum Marks</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-star icon-large"></i></span>
                                <input type="text" class="input" id="maxmarks" name="maxmarks" value="<?php if($result != NULL) echo $result['maximumMarks']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="deadlineA">DeadlineA</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-time icon-large"></i></span>
                                <input type="text" class="input" id="deadlineA" name="deadlineA" value="<?php if($result != NULL) if($result['deadlineA'] != NULL) echo bkdt($result['deadlineA']); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="deadlineB">DeadlineB</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-time icon-large"></i></span>
                                <input type="text" class="input" id="deadlineB" name="deadlineB" value="<?php if($result != NULL) if($result['deadlineB'] != NULL) echo bkdt($result['deadlineB']); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="deadlineC">DeadlineC</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-time icon-large"></i></span>
                                <input type="text" class="input" id="deadlineC" name="deadlineC" value="<?php if($result != NULL) if($result['deadlineC'] != NULL) echo bkdt($result['deadlineC']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><i class="icon-check"></i><?php echo $ADD;?></button>
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
