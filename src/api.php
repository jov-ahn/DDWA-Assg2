<?php
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }

    // Team
    $teamCon = $connection->query("SELECT * FROM team_account");
    $teamArr = [];

    while ($row = mysqli_fetch_assoc($teamCon)) {
        array_push($teamArr, $row);
    }

    // Room
    $roomsCon = $connection->query("SELECT * FROM room");
    $roomsArr = [];

    while ($row = mysqli_fetch_assoc($roomsCon)) {
        array_push($roomsArr, $row);
    }

    // https://stackoverflow.com/a/8900730
    $API = new stdClass();
    $API->team = $teamArr;
    $API->rooms = $roomsArr;

    $API = json_encode($API);

    echo $API;
?>