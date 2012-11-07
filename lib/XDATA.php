<?php
    require_once dirname(__FILE__) . '/DB.php';

    function runXDataAsynchMode() {
        exec("cd $XDATA_LOCATION; java -jar XData.jar &> /dev/null &");
    }

    function updatePendingResults() {
        if(!file_exists($RES_LOCATION))
            return;

        $fh = @fopen($RES_LOCATION, 'r');

        $type = trim(@fgets($fh));
        $qid = trim(@fgets($fh));
        $stat = trim(@fgets($fh));

        if($type == "INSTRUCTOR") {
            $exid = explode('-', $qid);
            updateExerciseStatus($exid[0], $exid[1], $stat);
        }

        @fclose($fh);
        @unlink($RES_LOCATION);
    }

    function startPendingTasks() {
        if(file_exists($TASK_LOCATION))
            return;
        if(!file_exists($RES_LOCATION))
            updatePendingResults();

        $taskDetails = getFirstPendingDataSetJob();
        if($taskDetails != FALSE) {
            $fh = @fopen($TASK_LOCATION, 'w');
            @fwrite($fh, "INSTRUCTOR\n");
            @fwrite($fh, $taskDetails['exerciseCode'] . "-" . $taskDetails['courseHistoryCode'] . "\n");
            @fwrite($fh, $taskDetails['correctResponse']);
            @fclose($fh);
            runXDataAsynchMode();
            return;
        }

        $taskDetails = getFirstPendingSubmissionCheck();
        if($taskDetails != FALSE) {
            $fh = @fopen($TASK_LOCATION, 'w');
            @fwrite($fh, "STUDENT\n");
            @fwrite($fh, $taskDetails['exerciseCode'] . "-" . $taskDetails['courseHistoryCode'] . "\n");
            @fwrite($fh, $taskDetails['response']);
            @fclose($fh);
            runXDataAsynchMode();
            return;
        }
    }

    updatePendingResults();
    startPendingTasks();
