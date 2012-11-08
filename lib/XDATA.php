<?php
    require_once dirname(__FILE__) . '/DB.php';

    function runXDataAsynchMode() {
        global $XDATA_LOCATION, $RES_LOCATION, $TASK_LOCATION;
        exec("cd $XDATA_LOCATION; java -jar XData.jar > /dev/null 2>/dev/null &");
    }

    function updatePendingResults() {
        global $XDATA_LOCATION, $RES_LOCATION, $TASK_LOCATION;
        if(!file_exists($RES_LOCATION))
            return;
        if(file_exists($TASK_LOCATION))
            return;

        $fh = @fopen($RES_LOCATION, 'r');

        $type = trim(@fgets($fh));
        $qid = trim(@fgets($fh));
        $stat = trim(@fgets($fh));

        if($type == "INSTRUCTOR") {
            $exid = explode('@', $qid);
            updateExerciseStatus($exid[0], $exid[1], $stat);
        } else if($type == "STUDENT") {
            $exid = explode('@', $qid);
            updateSubmissionStatus($exid[0], $exid[1], $exid[2], $stat);
        }

        @fclose($fh);
        @unlink($RES_LOCATION);
    }

    function startPendingTasks() {
        global $XDATA_LOCATION, $RES_LOCATION, $TASK_LOCATION;
        if(file_exists($TASK_LOCATION))
            return;
        if(!file_exists($RES_LOCATION))
            updatePendingResults();

        $taskDetails = getFirstPendingDataSetJob();
        if($taskDetails != FALSE) {
            $fh = @fopen($TASK_LOCATION, 'w');
            @fwrite($fh, "INSTRUCTOR\n");
            @fwrite($fh, $taskDetails['exerciseCode'] . "@" . $taskDetails['courseHistoryCode'] . "\n");
            @fwrite($fh, $taskDetails['correctResponse']);
            @fclose($fh);
            updateExerciseStatus($taskDetails['exerciseCode'], $taskDetails['courseHistoryCode'], '-1');
            runXDataAsynchMode();
            return;
        }

        $taskDetails = getFirstPendingSubmissionCheck();
        if($taskDetails != FALSE) {
            $fh = @fopen($TASK_LOCATION, 'w');
            @fwrite($fh, "STUDENT\n");
            @fwrite($fh, $taskDetails['exerciseCode'] . "@" . $taskDetails['courseHistoryCode'] . "@" . $taskDetails['submittedOn'] . "\n");
            @fwrite($fh, $taskDetails['response']);
            @fclose($fh);
            updateExerciseStatus($taskDetails['exerciseCode'], $taskDetails['courseHistoryCode'], $taskDetails['submittedOn'], '-1');
            runXDataAsynchMode();
            return;
        }
    }

    updatePendingResults();
    startPendingTasks();
