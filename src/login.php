<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $con = new mysqli("localhost", "root", '', "test");

    if (mysqli_connect_errno()) {
        die("Failed to connect with MySQL: " . mysqli_connect_error());
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username != "" && $password != "") {
        $sql = "SELECT password FROM team_account WHERE username = '$username'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_object($result);
        $hashedPW = $row->password;
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            if (password_verify($password, $hashedPW)) {
                $_SESSION['logged_in'] = true;
                header("Location: index.php");
            } else {
                echo "<script type='text/javascript'>alert('Wrong Username and Password');</script>";
            }
        } else {

            echo "<script type='text/javascript'>alert('Wrong Username and Password');</script>";
        }
    }
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

    <title>Login - Hintel</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name="user" class="user needs-validation" novalidate>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user" id="validationCustom01" required id="exampleInputEmail" placeholder="Enter Username">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user" id="validationCustom02" required id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" value="Login" id="submit" onclick="validation()" class="btn btn-primary btn-user btn-block" />
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/form-validator.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!--validation for empty field-->
    <script>
        function validation() {
            var id = document.user.username.value;
            var ps = document.user.password.value;
            if (id.length == "" && ps.length == "") {
                alert("Username and Password fields are empty");
                return false;
            } else {
                if (id.length == "") {
                    alert("Username is empty");
                    return false;
                }
                if (ps.length == "") {
                    alert("Password field is empty");
                    return false;
                }
            }
        }
    </script>



</body>

</html>