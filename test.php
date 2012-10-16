<?php
	include_once('./UTILS/LDAP.php');
    $USER = $_POST["username"];
    $PASS = $_POST["password"];
    $ldap_search = do_ldap_search($USER);
    $ldap_authenticate = ldap_authenticate($USER);
    
    if(!$ldap_search)
    	echo "Username Wrong";
    else if(!$ldap_athenticate)
		echo "Wrong Password";
	else
		echo "Successful Authentication";
?>
