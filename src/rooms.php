<?php
    session_start();

    if (empty($_SESSION['logged_in'])) {
        header("Location: 401.php");
    }
    
    require 'inc/config.php';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
        die('db connection failed' . mysqli_connect_error() . ' (' . mysqli_connect_errno() . ')');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rooms - Hintel</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('inc/sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('inc/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#addModal">Add Room</button>

                    <?php
                        if (isset($_SESSION['rooms_alert'])) {
                            echo "<div class=\"alert alert-info alert-dismissible fade show\" role=\"alert\">
                                    {$_SESSION['rooms_alert']}
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                    </button>
                                </div>";
                            unset($_SESSION['rooms_alert']);
                        }
                    ?>

                    <!-- Modal -->
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Add Room</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="rooms_db.php" method="POST" class="needs-validation" novalidate>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Room No.</label>
                                            <input type="text" name="room-no" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Member ID</label>
                                            <input type="number" name="member-id" class="form-control" min="1">
                                        </div>
                                        <div class="form-group">
                                            <label>Check-in</label>
                                            <input type="datetime-local" name="check-in" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Check-out</label>
                                            <input type="datetime-local" name="check-out" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Extra Items</label>
                                            <?php
                                                $res = $connection->query("SELECT * FROM inventory;");
                                                echo $res->num_rows === 0 ? "<div><a href=\"inventory.php\" class=\"text-warning\">No items found. Click here to create one!</a></div>" : "";
                                            ?>
                                            <select class="form-control" name="extra-items[]" multiple <?= $res->num_rows === 0 ? 'disabled' : '' ?>>
                                                <?php
                                                    if ($res->num_rows > 0) {
                                                        while ($row = mysqli_fetch_assoc($res)) {
                                                            echo "<option value=\"{$row['inventory_id']}\">{$row['item']}</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name="add-room" class="btn btn-primary">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Rooms</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Room No.</th>
                                            <th>Member ID</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Extra Items</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Room No.</th>
                                            <th>Member ID</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Extra Items</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $res = $connection->query("SELECT * FROM room;");
                                            
                                            if ($res->num_rows > 0) {
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                    $res2 = $connection->query("SELECT * FROM inventory;");
                                                    $extraItemsArr = [];

                                                    while ($row2 = mysqli_fetch_assoc($res2)) {
                                                        if (stristr($row['extra_items'], $row2['inventory_id'])) {
                                                            array_push($extraItemsArr, $row2['item']);
                                                        }
                                                    }
                                                    
                                                    $extraItemsStr = implode(', ', $extraItemsArr);

                                                    echo "<tr>
                                                            <td>{$row['room_no']}</td>
                                                            <td>{$row['member_id']}</td>
                                                            <td>{$row['check_in']}</td>
                                                            <td>{$row['check_out']}</td>
                                                            <td>{$extraItemsStr}</td>
                                                            <td>
                                                                <button type=\"button\" class=\"btn btn-warning btn-circle\" data-toggle=\"modal\" data-target=\"#editModal{$row['room_no']}\">
                                                                    <i class=\"fas fa-pencil-alt\"></i>
                                                                </button>
                                                                <button type=\"button\" class=\"btn btn-danger btn-circle\" data-toggle=\"modal\" data-target=\"#deleteModal{$row['room_no']}\">
                                                                    <i class=\"fas fa-trash\"></i>
                                                                </button>
                                                            </td>
                                                        </tr>";

                                                    if ($_SESSION['role'] !== 'User') {
                                                        include 'rooms_edit_modal.php';
                                                        include 'rooms_delete_modal.php';
                                                    }
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="js/form-validator.js"></script>

<?php include('inc/footer.php'); ?>