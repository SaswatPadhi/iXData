<?php
    require_once dirname(__FILE__) .'/../config.php';

    $con = mysql_connect("$PROJECT_HOST:$PROJECT_PORT", $PROJECT_USER, $PROJECT_PASS);
    if(!$con)
        return false;
    mysql_select_db($PROJECT_BASE, $con);
