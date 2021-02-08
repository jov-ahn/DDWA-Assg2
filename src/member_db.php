<?php
    session_start();
    
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
    else {
        if (isset($_POST['add-member'])) {
            $membername = $_POST['name'];
            $email = $_POST['email'];
            $number = $_POST['contact_no'];
            $country = $_POST['country'];
            $membership = $_POST['vip_status'];
            $remarks = $_POST['remarks'];


            $res = $connection->query('SELECT * FROM member;');
            $usernameExists = false;
            
            if ($res->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($row['name'] === $membername) {
                        $usernameExists = true;
                        break;
                    }
                }
            }

            if (!$usernameExists) {
                
                    $res = $connection->query("INSERT INTO member VALUES ('$member_id', '$membername', '$email', '$number', '$country', '$membership', '$remarks')");
                    
                    if ($res) {
                        $_SESSION['member_alert'] = "Member added successfully";
                        header('Location: member.php');
                    }
                    else {
                        echo "db insert error: $mysqli->error";
                        exit();
                    }
                }

        }

        if (isset($_POST['edit-member'])) {
            $memberid = $_POST['member_id'];
            $membername = $_POST['membername'];
            $email = $_POST['email'];
            $contact_no = $_POST['contact_no'];
            $country = $_POST['country'];
            $membership = $_POST['vip_status'];
            $remarks = $_POST['remarks'];

            $res = $connection->query("UPDATE member SET member_name = '$membername', email = '$email', contact_no = '$contact_no', country = '$country', vip_status = '$membership', remarks = '$remarks' WHERE member_id = '$memberid'");

            if ($res) {
                $_SESSION['member_alert'] = "Member edited successfully";
                header('Location: member.php');
            }
                else {
                echo("dontwork");
                exit();
            }
                
        }
        

        if (isset($_POST['delete-member'])) {
            $membername = $_POST['member_name'];

            $res = $connection->query("DELETE FROM member WHERE member_name = '$membername';");
            
            if ($res) {
                $_SESSION['member_alert'] = "Successfully deleted Member";
                header('Location: member.php');
            }
            else {
                $_SESSION['member_alert'] = "Failed to delete Member";
                header('Location: member.php');
            }
        }
    }
?>


