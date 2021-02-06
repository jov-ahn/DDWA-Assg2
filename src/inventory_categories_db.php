<?php
    session_start();
    
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
    else {
        if (isset($_POST['add-inventory-category'])) {
            $categoryID = $_POST['category-id'];
            $categoryName = $_POST['category-name'];

            $categoryExists = $connection->query("SELECT * FROM inventory_category WHERE category_name = '$categoryName';");

            if ($categoryExists->num_rows === 0) {
                $res = $connection->query("INSERT INTO inventory_category VALUES (NULL, '$categoryName')");
                
                if ($res) {
                    $_SESSION['inventory_categories_alert'] = "Inventory category added successfully";
                    header('Location: inventory_categories.php');
                }
                else {
                    echo "db insert error: $mysqli->error";
                    exit();
                }
            }
            else {
                $_SESSION['inventory_categories_alert'] = "An inventory category with that name already exists";
                header('Location: inventory_categories.php');
            }
        }

        if (isset($_POST['edit-inventory-category'])) {
            $categoryID = $_POST['category-id'];
            $categoryName = $_POST['category-name'];

            $categoryExists = $connection->query("SELECT * FROM inventory_category WHERE category_name = '$categoryName';");

            if ($categoryExists->num_rows === 0) {
                $res = $connection->query("UPDATE inventory_category SET category_name = '$categoryName' WHERE category_id = '$categoryID'");

                if ($res) {
                    $_SESSION['inventory_categories_alert'] = "Inventory category edited successfully";
                    header('Location: inventory_categories.php');
                }
                else {
                    echo "db insert error: $mysqli->error";
                    exit();
                }
            }
            else {
                $_SESSION['inventory_categories_alert'] = "An inventory category with that name already exists";
                header('Location: inventory_categories.php');
            }
        }

        if (isset($_POST['delete-inventory-category'])) {
            $categoryID = $_POST['category-id'];

            $res = $connection->query("DELETE FROM inventory_category WHERE category_id = '$categoryID';");
            
            if ($res) {
                $_SESSION['inventory_categories_alert'] = "Successfully deleted inventory category";
                header('Location: inventory_categories.php');
            }
            else {
                $_SESSION['inventory_categories_alert'] = "Failed to delete inventory category";
                header('Location: inventory_categories.php');
            }
        }
    }
?>