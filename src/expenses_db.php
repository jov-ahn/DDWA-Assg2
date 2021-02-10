<?php
    session_start();
    
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
    else {
        if (isset($_POST['add-expense'])) {
            $expenseID = $_POST['expense-id'];
            $date = $_POST['date'];
            $category = $_POST['category'];
            $description = $_POST['description'];
            $amount = $_POST['amount'];

            $categoryExists = $connection->query("SELECT * FROM expense_category WHERE category_id = '$category';");

            if ($categoryExists->num_rows > 0) {
                $res = $connection->query("INSERT INTO expense VALUES (NULL, '$date', '$category', '$description', '$amount')");
                
                if ($res) {
                    $_SESSION['expenses_alert'] = "Expense added successfully";
                    header('Location: expenses.php');
                }
                else {
                    echo "db insert error: $mysqli->error";
                    exit();
                }
            }
            else {
                $_SESSION['expenses_alert'] = "Category no longer exists";
                header('Location: expenses.php');
            }
        }

        if (isset($_POST['edit-expense'])) {
            $expenseID = $_POST['expense-id'];
            $date = $_POST['date'];
            $category = $_POST['category'];
            $description = $_POST['description'];
            $amount = $_POST['amount'];

            $categoryExists = $connection->query("SELECT * FROM expense_category WHERE category_id = '$category';");

            if ($categoryExists->num_rows > 0) {
                $res = $connection->query("UPDATE expense SET date = '$date', category = '$category', description = '$description', amount = '$amount' WHERE expense_id = '$expenseID'");
                
                if ($res) {
                    $_SESSION['expenses_alert'] = "Expense edited successfully";
                    header('Location: expenses.php');
                }
                else {
                    echo "db insert error: $mysqli->error";
                    exit();
                }
            }
            else {
                $_SESSION['expenses_alert'] = "Category no longer exists";
                header('Location: expenses.php');
            }
        }

        if (isset($_POST['delete-expense'])) {
            $expenseID = $_POST['expense-id'];

            $res = $connection->query("DELETE FROM expense WHERE expense_id = '$expenseID';");
            
            if ($res) {
                $_SESSION['expenses_alert'] = "Successfully deleted expense";
                header('Location: expenses.php');
            }
            else {
                $_SESSION['expenses_alert'] = "Failed to delete expense";
                header('Location: expenses.php');
            }
        }
    }
?>