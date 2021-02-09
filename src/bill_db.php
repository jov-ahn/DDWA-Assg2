<?php
    session_start();
    
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
    else {
        if (isset($_POST['add-bill'])) {
            $date = $_POST['date'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $amount = $_POST['amount'];
            $fees = $_POST['fees'];
            $remarks = $_POST['remarks'];


            $res = $connection->query('SELECT * FROM bill;');
            $usernameExists = false;
            
            if ($res->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($row['member_email'] === $email) {
                        $usernameExists = true;
                        break;
                    }
                }
            }

            
                
            if (!$usernameExists) {
                
                $res = $connection->query("INSERT INTO bill VALUES ('$date', NULL,'$name', '$email', '$amount', '$fees', '$remarks')");
                
                if ($res) {
                    $_SESSION['bill_alert'] = "Bill added successfully";
                    header('Location: bill.php');
                }
                else {
                    echo "db insert error: $mysqli->error";
                    exit();
                }
            }
        }
    

        if (isset($_POST['edit-bill'])) {
            $billid = $_POST['bill_id'];
            $date = $_POST['date'];
            $membername = $_POST['name'];
            $email = $_POST['email'];
            $amount = $_POST['amount'];
            $servicefee = $_POST['servicefee'];
            $remarks = $_POST['remarks'];

            $res = $connection->query("UPDATE bill SET member_name = '$membername', member_email = '$email', date = '$date', amount = '$amount', room_service_fee = '$servicefee', remarks = '$remarks' WHERE bill_id = '$billid'");

            if ($res) {
                $_SESSION['bill_alert'] = "Bill edited successfully";
                header('Location: bill.php');
            }
                else {
                echo("dontwork");
                exit();
            }
                
        }

        

        if (isset($_POST['delete-bill'])) {
            $billid = $_POST['billid'];

            $res = $connection->query("DELETE FROM bill WHERE bill_id = '$billid';");
            
            if ($res) {
                $_SESSION['bill_alert'] = "Successfully deleted bill";
                header('Location: bill.php');
            }
            else {
                $_SESSION['bill_alert'] = "Failed to delete bill";
                header('Location: bill.php');
            }
        }
    }
?>