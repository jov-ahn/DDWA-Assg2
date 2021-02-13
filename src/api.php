<?php
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }

    // Rooms
    $roomsCon = $connection->query("SELECT * FROM room");
    $roomsArr = [];

    while ($row = mysqli_fetch_assoc($roomsCon)) {
        array_push($roomsArr, $row);
    }

    // Members
    $membersCon = $connection->query("SELECT * FROM member");
    $membersArr = [];

    while ($row = mysqli_fetch_assoc($membersCon)) {
        array_push($membersArr, $row);
    }

    // Staff
    $staffCon = $connection->query("SELECT * FROM staff");
    $staffArr = [];

    while ($row = mysqli_fetch_assoc($staffCon)) {
        array_push($staffArr, $row);
    }

    // Bills
    $billsCon = $connection->query("SELECT * FROM bill");
    $billsArr = [];

    while ($row = mysqli_fetch_assoc($billsCon)) {
        array_push($billsArr, $row);
    }

    // Inventory
    $inventoryCon = $connection->query("SELECT * FROM inventory");
    $inventoryArr = [];

    while ($row = mysqli_fetch_assoc($inventoryCon)) {
        array_push($inventoryArr, $row);
    }

    // Inventory Categories
    $invCatCon = $connection->query("SELECT * FROM inventory_category");
    $invCatArr = [];

    while ($row = mysqli_fetch_assoc($invCatCon)) {
        array_push($invCatArr, $row);
    }

    // Expenses
    $expensesCon = $connection->query("SELECT * FROM expense");
    $expensesArr = [];

    while ($row = mysqli_fetch_assoc($expensesCon)) {
        array_push($expensesArr, $row);
    }

    // Expenses Categories
    $expCatCon = $connection->query("SELECT * FROM expense_category");
    $expCatArr = [];

    while ($row = mysqli_fetch_assoc($expCatCon)) {
        array_push($expCatArr, $row);
    }

    // Team
    $teamCon = $connection->query("SELECT * FROM team_account");
    $teamArr = [];

    while ($row = mysqli_fetch_assoc($teamCon)) {
        array_push($teamArr, $row);
    }

    // https://stackoverflow.com/a/8900730
    $API = new stdClass();
    $API->rooms = $roomsArr;
    $API->members = $membersArr;
    $API->staff = $staffArr;
    $API->bills = $billsArr;
    $API->inventory = $inventoryArr;
    $API->inventoryCategories = $invCatArr;
    $API->expenses = $expensesArr;
    $API->expensesCategories = $expCatArr;
    $API->team = $teamArr;

    $API = json_encode($API);

    echo $API;
?>