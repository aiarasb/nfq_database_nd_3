<?php
/**
 * Created by PhpStorm.
 * User: aivaras
 * Date: 16.4.19
 * Time: 02.19
 */
    $data = json_decode(file_get_contents('JobsRegister.txt'), true);

    $fp = fopen('JobsRegister.csv', 'w');

    foreach ($data as $fields) {
        fputcsv($fp, $fields);
    }

    fclose($fp);