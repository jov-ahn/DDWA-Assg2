<?php
    session_start();
    
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

    <title> Bill - Hintel</title>

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
                    <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#addModal">Add Bill</button>

                    <?php
                        if (isset($_SESSION['bill_alert'])) {
                            echo "<div class=\"alert alert-info alert-dismissible fade show\" role=\"alert\">
                                    {$_SESSION['bill_alert']}
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                    </button>
                                </div>";
                            unset($_SESSION['bill_alert']);
                        }
                    ?>

                    <!-- Modal -->
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Add Bill</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="bill_db.php" method="POST" class="needs-validation" novalidate>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" name="date" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Guest name</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" name="amount" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Room Service Fee(s)</label>
                                            <input type="text" name="fees" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input type="text" name="remarks" class="form-control" required>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name="add-bill" class="btn btn-primary">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Bill Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Bill ID</th>
                                            <th>Guest Name</th>
                                            <th>Date</th>
                                            <th>Email</th>
                                            <th>Amount</th>
                                            <th>Room Service Fee</th>
                                            <th>Remarks</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Bill ID</th>
                                            <th>Guest Name</th>
                                            <th>Date</th>
                                            <th>Email</th>
                                            <th>Amount</th>
                                            <th>Room Service Fee</th>
                                            <th>Remarks</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $res = $connection->query("SELECT * FROM bill;");
                                            
                                            if ($res->num_rows > 0) {
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                    echo "<tr>
                                                            <td>{$row['bill_id']}</td>
                                                            <td>{$row['member_name']}</td>
                                                            <td>{$row['date']}</td>
                                                            <td>{$row['member_email']}</td>
                                                            <td>{$row['amount']}</td>
                                                            <td>{$row['room_service_fee']}</td>
                                                            <td>{$row['remarks']}</td>
                                                            <td>
                                                                <button type=\"button\" class=\"btn btn-warning btn-circle\" data-toggle=\"modal\" data-target=\"#editModal{$row['bill_id']}\">
                                                                    <i class=\"fas fa-pencil-alt\"></i>
                                                                </button>
                                                                <button type=\"button\" class=\"btn btn-danger btn-circle\" data-toggle=\"modal\" data-target=\"#deleteModal{$row['bill_id']}\">
                                                                    <i class=\"fas fa-trash\"></i>
                                                                </button>
                                                            </td>
                                                        </tr>";

                                                    include 'bill_edit_modal.php';
                                                    include 'bill_delete_modal.php';
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