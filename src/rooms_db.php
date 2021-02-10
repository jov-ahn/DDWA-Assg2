<?php
    session_start();
    
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
    else {
        if (isset($_POST['add-room'])) {
            $roomNo = $_POST['room-no'];
            $memberID = $_POST['member-id'];
            $checkIn = $_POST['check-in'];
            $checkOut = $_POST['check-out'];
            // https://stackoverflow.com/a/43723825
            $extraItems = implode(', ', $_POST['extra-items']);
            
            $roomExists = $connection->query("SELECT * FROM room WHERE room_no = '$roomNo';");

            if ($roomExists->num_rows === 0) {
                $res = $connection->query("INSERT INTO room VALUES ('$roomNo', '$memberID', '$checkIn', '$checkOut', '$extraItems')");
                
                if ($res) {
                    $_SESSION['rooms_alert'] = "Room added successfully";
                    header('Location: rooms.php');
                }
                else {
                    echo "db insert error: $mysqli->error";
                    exit();
                }
            }
            else {
                $_SESSION['rooms_alert'] = "A room with that room number already exists";
                header('Location: rooms.php');
            }
        }

        if (isset($_POST['edit-room'])) {
            $roomNo = $_POST['room-no'];
            $memberID = $_POST['member-id'];
            $checkIn = $_POST['check-in'];
            $checkOut = $_POST['check-out'];
            $extraItems = implode(', ', $_POST['extra-items']);

            $res = $connection->query("UPDATE room SET member_id = '$memberID', check_in = '$checkIn', check_out = '$checkOut', extra_items = '$extraItems' WHERE room_no = '$roomNo'");
            
            if ($res) {
                $_SESSION['rooms_alert'] = "Room edited successfully";
                header('Location: rooms.php');
            }
            else {
                $_SESSION['rooms_alert'] = "Failed to edit room";
                header('Location: rooms.php');
            }
        }

        if (isset($_POST['delete-room'])) {
            $roomNo = $_POST['room-no'];

            $res = $connection->query("DELETE FROM room WHERE room_no = '$roomNo';");
            
            if ($res) {
                $_SESSION['rooms_alert'] = "Successfully deleted room";
                header('Location: rooms.php');
            }
            else {
                $_SESSION['rooms_alert'] = "Failed to delete room";
                header('Location: rooms.php');
            }
        }
    }
?>