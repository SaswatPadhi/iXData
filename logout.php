<?php
	require("./UTILS/AUTH.php");
	logoutUser();
	header("Location: ./index.php");
?>
