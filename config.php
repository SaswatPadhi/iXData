<?php
    $PROJECT_NAME = "iXData";

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
