<?php
    session_start();
    
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
    else {
        if (isset($_POST['add-member'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $number = $_POST['contact_no'];
            $country = $_POST['country'];
            $vipstatus = $_POST['vip_status'];
            $remarks = $_POST['remarks'];


            $res = $connection->query('SELECT * FROM member;');
            $usernameExists = false;
            
            if ($res->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($row['member_id'] === $member_id) {
                        $usernameExists = true;
                        break;
                    }
                }
            }

            if (!$usernameExists) {
                
                    $res = $connection->query("INSERT INTO member VALUES ('$member_id', '$name', '$email', '$number', '$country', '$vipstatus', '$remarks')");
                    
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
            $name = $_POST['name'];
            $email = $_POST['email'];
            $contact_no = $_POST['contact_no'];
            $country = $_POST['country'];
            $vipstatus = $_POST['vip_status'];
            $remarks = $_POST['remarks'];

            $res = $connection->query("UPDATE member SET name = '$name', email = '$email', contact_no = '$contact_no', country = '$country', vip_status = '$vipstatus', remarks = '$remarks' WHERE member_id = '$memberid'");

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
            $member_id = $_POST['member_id'];

            $res = $connection->query("DELETE FROM member WHERE member_id = '$member_id';");
            
            if ($res) {
                $_SESSION['member_alert'] = "Successfully deleted member";
                header('Location: member.php');
            }
            else {
                $_SESSION['member_alert'] = "Failed to delete member";
                header('Location: member.php');
            }
        }
    }
?>


