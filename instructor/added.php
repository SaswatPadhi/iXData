<?php
	require_once("../lib/DB.php");
    require("../lib/AUTH.php");
    ensureLoggedIn("I");

	$question = $_POST['question'];
	$MM = $_POST['maxmarks']; 
	$createdBy = $_SESSION['iXD_UId'];
	$CHC = $_POST['CHC']; 
	$DA = $_POST['deadlineA'];
	$DB = $_POST['deadlineB'];
	$DC = $_POST['deadlineC'];
	$result = addExerciseCode($CHC,$question,$createdBy,$MM);
	if($result) 
		echo "Done";
	else
		echo mysql_error();

	header("Location: ./");
?>
