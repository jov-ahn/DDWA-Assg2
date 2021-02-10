<?php
    session_start();
    
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
    else {
        if (isset($_POST['add-expense-category'])) {
            $categoryID = $_POST['category-id'];
            $categoryName = $_POST['category-name'];

            $categoryExists = $connection->query("SELECT * FROM expense_category WHERE category_name = '$categoryName';");

            if ($categoryExists->num_rows === 0) {
                $res = $connection->query("INSERT INTO expense_category VALUES (NULL, '$categoryName')");
                
                if ($res) {
                    $_SESSION['expenses_categories_alert'] = "expense category added successfully";
                    header('Location: expenses_categories.php');
                }
                else {
                    echo "db insert error: $mysqli->error";
                    exit();
                }
            }
            else {
                $_SESSION['expenses_categories_alert'] = "An expense category with that name already exists";
                header('Location: expenses_categories.php');
            }
        }

        if (isset($_POST['edit-expense-category'])) {
            $categoryID = $_POST['category-id'];
            $categoryName = $_POST['category-name'];

            $categoryExists = $connection->query("SELECT * FROM expense_category WHERE category_name = '$categoryName';");

            if ($categoryExists->num_rows === 0) {
                $res = $connection->query("UPDATE expense_category SET category_name = '$categoryName' WHERE category_id = '$categoryID'");

                if ($res) {
                    $_SESSION['expenses_categories_alert'] = "expense category edited successfully";
                    header('Location: expenses_categories.php');
                }
                else {
                    echo "db insert error: $mysqli->error";
                    exit();
                }
            }
            else {
                $_SESSION['expenses_categories_alert'] = "An expense category with that name already exists";
                header('Location: expenses_categories.php');
            }
        }

        if (isset($_POST['delete-expense-category'])) {
            $categoryID = $_POST['category-id'];

            $res = $connection->query("DELETE FROM expense_category WHERE category_id = '$categoryID';");
            
            if ($res) {
                $_SESSION['expenses_categories_alert'] = "Successfully deleted expense category";
                header('Location: expenses_categories.php');
            }
            else {
                $_SESSION['expenses_categories_alert'] = "Failed to delete expense category";
                header('Location: expenses_categories.php');
            }
        }
    }
?>