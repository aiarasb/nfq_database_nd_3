<?php
/**
 * Created by PhpStorm.
 * User: aivaras
 * Date: 16.4.19
 * Time: 01.17
 */

    $con = mysqli_connect('localhost', 'root', '', 'akademija');
    $data = json_decode(file_get_contents('JobsRegister.txt'), true);

    $start = microtime(true);
    $que = "INSERT INTO `JobsRegister` (contractId, objectId, kkTechnicianArrivalDate, kkTechnicianDepartureDate, kkTechnicianId, arrivalDate, goal, type) VALUES ";
    foreach ($data as $k=>$v) {
        $que .= "('".$v['contractId']."', '".$v['objectId']."', '".$v['kkTechnicianArrivalDate']."', '".$v['kkTechnicianepartureDate']."', '".$v['kkTechnicianId']."', '".$v['arrivalDate']."', '".$v['goal']."', '".$v['type']."'), ";
    }

    $que = substr($que, 0, -2);

    $ret = mysqli_query($con, $que);
    if (!$ret) {
        echo "Failed to run query: (" . $con->errno . ") " . $con->error;
        exit;
    }

    $finish = microtime(true);
    $time = $finish - $start;
    echo "Testas truko ".$time." sek.";