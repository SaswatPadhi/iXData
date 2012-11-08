<?php
    $PROJECT_NAME = "iXData";

    $XDATA_LOCATION = "/home/saswat/xdata/";
    $RES_LOCATION = $XDATA_LOCATION . "Current.res";
    $TASK_LOCATION = $XDATA_LOCATION . "Current.tsk";

    if (getenv('iXData_ENVIRONMENT') == 'testing') {
        $PROJECT_HOST = "localhost";
        $PROJECT_PORT = "3306";
        $PROJECT_BASE = "iXData";
        $PROJECT_USER = "root";
        $PROJECT_PASS = "lampp";
    } else {
        $PROJECT_HOST = "10.105.11.85";
        $PROJECT_PORT = "3306";
        $PROJECT_BASE = "iXData";
        $PROJECT_USER = "iXData_Project";
        $PROJECT_PASS = "iXDataPass";
    }

    require_once dirname(__FILE__) .'/lib/XDATA.php';
