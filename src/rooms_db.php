<?php
    session_start();
    
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
    else {
        if (isset($_POST['add-room'])) {
            $roomNo = $_POST['floor-no'] . '-' . $_POST['unit-no'];
            $memberID = $_POST['member-id'];
            // https://stackoverflow.com/a/43723825
            $extraItems = implode(', ', $_POST['extra-items']);
            
            $res = $connection->query('SELECT * FROM room;');
            $roomExists = false;
            
            if ($res->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($row['room_no'] === $roomNo) {
                        $roomExists = true;
                        break;
                    }
                }
            }

            if (!$roomExists) {
                $res = $connection->query("INSERT INTO room VALUES ('$roomNo', '$memberID', '$extraItems')");
                
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
            $extraItems = implode(', ', $_POST['extra-items']);

            $res = $connection->query("UPDATE room SET member_id = '$memberID', extra_items = '$extraItems' WHERE room_no = '$roomNo'");
            
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
                $_SESSION['rooms_alert'] = "Room deleted successfully";
                header('Location: rooms.php');
            }
            else {
                $_SESSION['rooms_alert'] = "Failed to delete room";
                header('Location: rooms.php');
            }
        }
    }
?>