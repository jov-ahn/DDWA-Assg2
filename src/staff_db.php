<?php
    session_start();
    
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
    else {
        if (isset($_POST['add-staff'])) {
            $staffname = $_POST['name'];
            $position = $_POST['position'];
            $email = $_POST['email'];
            $contactno = $_POST['contactno'];
            $country = $_POST['country'];
            $startdate = $_POST['startdate'];
            $salary = $_POST['salary'];


            $res = $connection->query('SELECT * FROM staff;');
            $usernameExists = false;
            
            if ($res->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($row['name'] === $staffname) {
                        $usernameExists = true;
                        break;
                    }
                }
            }

            
                
            $res = $connection->query("INSERT INTO staff VALUES (NULL, '$staffname', '$position', '$email', '$contactno', '$country', '$startdate', '$salary')");
                    
                if ($res) {
                    $_SESSION['staff_alert'] = "Staff added successfully";
                    header('Location: staff.php');
                }
                else {
                    echo "db insert error: $mysqli->error";
                    exit();
            }
                

        }

        if (isset($_POST['edit-staff'])) {
            $staffid = $_POST['staff_id'];
            $staffname = $_POST['name'];
            $position = $_POST['position'];
            $email = $_POST['email'];
            $contactno = $_POST['contactno'];
            $country = $_POST['country'];
            $startdate = $_POST['startdate'];
            $salary = $_POST['salary'];



            
            
            $res = $connection->query("UPDATE staff SET name = '$staffname', position = '$position', email = '$email', contact_no = '$contactno', country = '$country', start_date = '$startdate', monthly_salary = '$salary' WHERE staff_id = '$staffid'");

            if ($res) {
                $_SESSION['staff_alert'] = "Staff edited successfully";
                header('Location: staff.php');
            }
                else {
                echo("dontwork");
                exit();
            }
                
        }

        

        if (isset($_POST['delete-staff'])) {
            $staff_id = $_POST['staff_id'];

            $res = $connection->query("DELETE FROM staff WHERE staff_id = '$staff_id';");
            
            if ($res) {
                $_SESSION['staff_alert'] = "Successfully deleted staff";
                header('Location: staff.php');
            }
            else {
                $_SESSION['staff_alert'] = "Failed to delete staff";
                header('Location: staff.php');
            }
        }
    }
?>