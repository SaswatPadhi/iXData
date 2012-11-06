<?php
	require_once("../lib/DB.php");
	@session_start();
	$question = $_POST['question'];
	$MM = $_POST['maxmarks']; 
	$createdBy = $_SESSION['iXD_UId'];
	$CHC = $_POST['CHC']; 
	$DA = $_POST[''];
	$DB = $_POST[''];
	$DC = $_POST[''];
	$result = addExerciseCode($CHC,$question,$createdBy,$MM);
	if($result) 
		echo "Done";
	header("Location: ./");
?>
