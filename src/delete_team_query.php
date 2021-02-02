<?php
    session_start();

    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
    else {
        if (isset($_POST['delete-team'])) {
            $id = $_POST['id'];

            $res = $connection->query("DELETE FROM team_account WHERE id = '$id';");
            
            if ($res) {
                $_SESSION['team_alert'] = "Successfully deleted team account";
                header('Location: team.php');
            }
            else {
                $_SESSION['team_alert'] = "Failed to delete team account";
                header('Location: team.php');
            }
        }
    }
?>