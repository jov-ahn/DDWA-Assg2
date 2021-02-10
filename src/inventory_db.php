<?php
    session_start();
    
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
    else {
        if (isset($_POST['add-item'])) {
            $category = $_POST['category'];
            $item = $_POST['item'];
            $quantity = $_POST['quantity'];
            $remarks = $_POST['remarks'];

            $categoryExists = $connection->query("SELECT * FROM inventory_category WHERE category_id = '$category';");
            $itemExists = $connection->query("SELECT * FROM inventory WHERE item = '$item';");

            if ($categoryExists->num_rows > 0) {
                if ($itemExists->num_rows === 0) {
                    $res = $connection->query("INSERT INTO inventory VALUES (NULL, '$category', '$item', '$quantity', '$remarks')");
                    
                    if ($res) {
                        $_SESSION['inventory_alert'] = "Item added successfully";
                        header('Location: inventory.php');
                    }
                    else {
                        echo "db insert error: $mysqli->error";
                        exit();
                    }
                }
                else {
                    $_SESSION['inventory_alert'] = "An item with that name already exists";
                    header('Location: inventory.php');
                }
            }
            else {
                $_SESSION['inventory_alert'] = "Category no longer exists";
                header('Location: inventory.php');
            }
        }

        if (isset($_POST['edit-item'])) {
            $itemID = $_POST['item-id'];
            $category = $_POST['category'];
            $item = $_POST['item'];
            $quantity = $_POST['quantity'];
            $remarks = $_POST['remarks'];

            $categoryExists = $connection->query("SELECT * FROM inventory_category WHERE category_id = '$category';");
            $itemExists = $connection->query("SELECT * FROM inventory WHERE item = '$item' AND inventory_id != '$itemID';");

            if ($categoryExists->num_rows > 0) {
                if ($itemExists->num_rows === 0) {
                    $res = $connection->query("UPDATE inventory SET category = '$category', item = '$item', quantity = '$quantity', remarks = '$remarks' WHERE inventory_id = '$itemID'");
                    
                    if ($res) {
                        $_SESSION['inventory_alert'] = "Item edited successfully";
                        header('Location: inventory.php');
                    }
                    else {
                        echo "db insert error: $mysqli->error";
                        exit();
                    }
                }
                else {
                    $_SESSION['inventory_alert'] = "An item with that name already exists";
                    header('Location: inventory.php');
                }
            }
            else {
                $_SESSION['inventory_alert'] = "Category no longer exists";
                header('Location: inventory.php');
            }
        }

        if (isset($_POST['delete-item'])) {
            $itemID = $_POST['item-id'];

            $res = $connection->query("DELETE FROM inventory WHERE inventory_id = '$itemID';");
            
            if ($res) {
                $_SESSION['inventory_alert'] = "Successfully deleted item";
                header('Location: inventory.php');
            }
            else {
                $_SESSION['inventory_alert'] = "Failed to delete item";
                header('Location: inventory.php');
            }
        }
    }
?>