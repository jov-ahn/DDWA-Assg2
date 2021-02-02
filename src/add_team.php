<?php
    session_start();
    
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
    else {
        if (isset($_POST['add-team'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm-password'];
            $role = $_POST['role'];

            $res = $connection->query('SELECT * FROM team_account;');
            $usernameExists = false;
            
            if ($res->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($row['username'] === $username) {
                        $usernameExists = true;
                        break;
                    }
                }
            }

            if (!$usernameExists) {
                if ($password === $confirmPassword) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $res = $connection->query("INSERT INTO team_account VALUES (NULL, '$username', '$hashedPassword', '$role')");
                    
                    if ($res) {
                        $_SESSION['team_alert'] = "Team account added successfully";
                        header('Location: team.php');
                    }
                    else {
                        echo "db insert error: $mysqli->error";
                        exit();
                    }
                }
                else {
                    $_SESSION['team_alert'] = "Passwords do not match";
                    header('Location: team.php');
                }
            }
            else {
                $_SESSION['team_alert'] = "A team account with that username already exists";
                header('Location: team.php');
            }
        }
    }
?>