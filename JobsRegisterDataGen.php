<?php
/**
 * Created by PhpStorm.
 * User: aivaras
 * Date: 16.4.18
 * Time: 11.32
 */
    function randomDate($start_date, $end_date)
    {
        // Convert to timetamps
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('Y-m-d H:i:s', $val);
    }

    $con = mysqli_connect('localhost', 'root', '', 'akademija');

    $data = [
        'contractId' => [],
        'objectId' => [],
        'kkTechnicianId' => [],
        'goal' => [],
        'type' => []
    ];

    $ret = mysqli_query($con, "SELECT contractId FROM JobsRegister GROUP BY contractId");
    if (!$ret) {
        echo "Failed to run query: (" . $con->errno . ") " . $con->error;
        exit;
    }

    while ($row=mysqli_fetch_array($ret)) {
        $data['contractId'][] = $row['contractId'];
    }

    $ret = mysqli_query($con, "SELECT objectId FROM JobsRegister GROUP BY objectId");
    if (!$ret) {
        echo "Failed to run query: (" . $con->errno . ") " . $con->error;
        exit;
    }

    while ($row=mysqli_fetch_array($ret)) {
        $data['objectId'][] = $row['objectId'];
    }

    $ret = mysqli_query($con, "SELECT kkTechnicianId FROM JobsRegister GROUP BY kkTechnicianId");
    if (!$ret) {
        echo "Failed to run query: (" . $con->errno . ") " . $con->error;
        exit;
    }

    while ($row=mysqli_fetch_array($ret)) {
        $data['kkTechnicianId'][] = $row['kkTechnicianId'];
    }

    $ret = mysqli_query($con, "SELECT goal FROM JobsRegister GROUP BY goal");
    if (!$ret) {
        echo "Failed to run query: (" . $con->errno . ") " . $con->error;
        exit;
    }

    while ($row=mysqli_fetch_array($ret)) {
        $data['goal'][] = $row['goal'];
    }

    $ret = mysqli_query($con, "SELECT type FROM JobsRegister GROUP BY type");
    if (!$ret) {
        echo "Failed to run query: (" . $con->errno . ") " . $con->error;
        exit;
    }

    while ($row=mysqli_fetch_array($ret)) {
        $data['type'][] = $row['type'];
    }

    foreach ($data as $k=>$v) {
        $data[$k] = array_unique($v);
    }

    $d = [];
    $ct = [
        'contractId' => count($data['contractId'])-1,
        'objectId' => count($data['objectId'])-1,
        'kkTechnicianId' => count($data['kkTechnicianId'])-1,
        'goal' => count($data['goal'])-1,
        'type' => count($data['type'])-1
    ];
    for ($i=0;$i<1000;$i++) {
        $kkTechnicianArrivalDate = randomDate('2003-01-01', '2016-04-18');
        $kkTechnicianDepatureDate = date('Y-m-d H:i:s', strtotime($kkTechnicianArrivalDate)+5400);
        $arrivalDate = date('Y-m-d', strtotime($kkTechnicianArrivalDate));
        $d[] = [
            'contractId' => $data['contractId'][rand(0, $ct['contractId'])],
            'objectId' => $data['objectId'][rand(0, $ct['objectId'])],
            'kkTechnicianArrivalDate' => $kkTechnicianArrivalDate,
            'kkTechnicianepartureDate' => $kkTechnicianDepatureDate,
            'kkTechnicianId' => $data['kkTechnicianId'][rand(0, $ct['kkTechnicianId'])],
            'arrivalDate' => $arrivalDate,
            'goal' => $data['goal'][rand(0, $ct['goal'])],
            'type' => $data['type'][rand(0, $ct['type'])]
        ];
    }

    file_put_contents('JobsRegister.txt', json_encode($d));
    var_dump($d);