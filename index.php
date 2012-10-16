<?php require("config.php") ?>
<?php
    include_once "UTILS/AUTH.php";

    $loggedIn = isLoggedIn();

    if($loggedIn) {
    	if($_SESSION['XD_Type'] == 'Student')
    	header("Location: ./student/index.php");
    	else if($_SESSION['XD_Type'] == 'Instructor')
    	header("Location: ./instructor/index.php");
    	}

?>
<!doctype html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css"/>
	    <style type="text/css">
		body {
			padding-top: 60px;
			padding-bottom: 40px;
		}
		
		#login form {
			padding: 16px;
			border-radius: 6px;
			background-color: #EEE;
			box-shadow: 0px 0px 10px #2F4F4F;
			-moz-box-shadow: 0px 0px 10px #2F4F4F;
			-webkit-box-shadow: 0px 0px 10px #2F4F4F;
		}
		
		* {
			font-family: "sans-serif";
		}
	    </style>
		<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a href="./" class="brand"><?php echo $PROJECT_NAME; ?></a>
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
				<div class="span7" id="description">
					<div class="hero-unit" style="height: ">
						<h2><?php echo $PROJECT_NAME; ?><h2>
					</div>
				</div>
				<div class="span5" id="login">
					<form class="form-horizontal" action="./instructor/" method="post">
					  <div class="control-group">
					  	<h4> Instructor's Login <h4><br>
						<label class="control-label" for="iusername">LDAP Username</label>
						<div class="controls">
						  <input type="text" id="iusername" name="iusername" placeholder="LDAP ID">
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="ipassword">LDAP Password</label>
						<div class="controls">
						  <input type="password" id="ipassword" name="ipassword" placeholder="Password">
						</div>
					  </div>
					  <div class="control-group">
						<div class="controls">
						  <label class="checkbox">
							<input type="checkbox"> Remember me
						  </label>
						  <button type="submit" class="btn btn-success">Sign in</button>
						</div>
					  </div>
					</form>
					<br>

					<form class="form-horizontal" action="student/index.php" method="post">
					  <div class="control-group">
					  	<h4> Student's Login <h4><br>
						<label class="control-label" for="susername">LDAP Username</label>
						<div class="controls">
						  <input type="text" id="susername" name="susername" placeholder="LDAP ID">
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label" for="spassword">LDAP Password</label>
						<div class="controls">
						  <input type="password" id="spassword" name="spassword" placeholder="Password">
						</div>
					  </div>
					  <div class="control-group">
						<div class="controls">
						  <label class="checkbox">
							<input type="checkbox"> Remember me
						  </label>
						  <button type="submit" class="btn btn-success">Sign in</button>
						</div>
					  </div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
