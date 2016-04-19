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

    foreach ($data as $k=>$v) {
        $ret = mysqli_query($con, "
            INSERT INTO `JobsRegister`
              (contractId,
              objectId,
              kkTechnicianArrivalDate,
              kkTechnicianDepartureDate,
              kkTechnicianId,
              arrivalDate,
              goal,
              type)
            VALUES
              ('".$v['contractId']."',
              '".$v['objectId']."',
              '".$v['kkTechnicianArrivalDate']."',
              '".$v['kkTechnicianepartureDate']."',
              '".$v['kkTechnicianId']."',
              '".$v['arrivalDate']."',
              '".$v['goal']."',
              '".$v['type']."')
        ");
        if (!$ret) {
            echo "Failed to run query: (" . $con->errno . ") " . $con->error;
            exit;
        }
    }

    $finish = microtime(true);
    $time = $finish - $start;
    echo "Testas truko ".$time." sek.";