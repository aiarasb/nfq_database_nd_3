<?php
/**
 * Created by PhpStorm.
 * User: aivaras
 * Date: 16.4.19
 * Time: 01.17
 */

    $con = mysqli_connect('localhost', 'root', '', 'akademija');
    $start = microtime(true);

    $ret = mysqli_query($con, "LOAD DATA INFILE '/var/www/html/JobsRegister.csv'
		INTO TABLE JobsRegister
		FIELDS TERMINATED BY ','
		LINES TERMINATED BY '\n'
		(
				contractId,
				objectId,
				kkTechnicianArrivalDate,
				kkTechnicianDepartureDate,
				kkTechnicianId,
				arrivalDate,
				goal,
				type
		)");
    if (!$ret) {
        echo "Failed to run query: (" . $con->errno . ") " . $con->error;
        exit;
    }

    $finish = microtime(true);
    $time = $finish - $start;
    echo "Testas truko ".$time." sek.";