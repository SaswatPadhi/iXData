<?php
    $f = fopen($file, 'w');
    $data = fwrite($f, $value);
    fclose($f);
