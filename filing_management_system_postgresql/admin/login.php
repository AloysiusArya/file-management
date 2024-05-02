<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Filing Management System </title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
</head>
<?php

session_start();
include '../functions.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(0);
    // Retrieve data from the login form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Protect against SQL injection
    $username = pg_escape_string($conn, $username);
    $password = pg_escape_string($conn, $password);

    // Search for the user in the database
    $sql = "SELECT * FROM admin WHERE username = '$username' LIMIT 1";
    $result = pg_query($conn, $sql);
    $user = pg_fetch_assoc($result);

    // Verify the password
    if ($user && password_verify($password, $user['password'])) {
        // If the password is correct, redirect to the dashboard page
        $_SESSION["admin"] = true;
        $_SESSION["username"] = $username;
        header("Location: ./index.php");
        exit();
    } else {
        // If the password is incorrect, display an error message
        $error = "Username or password is incorrect";
    }
}
?>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="d-flex flex-column">
                <h4 class="mt-5 text-center">Filing Management System - Login Admin</h4>
                <div class="d-flex justify-content-center">
                    <img src="../img/logo.png" class="img-fluid" width="100" alt="">
                </div>
            </div>
            <div class="col-xl-10 col-lg-12 col-md-9 col-sm-12">

                <div class="card o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-2">
                                    <form class="user" method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Masukkan Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Masukkan Password" required>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php include "footer.php"; ?>
    <?php include "plugin.php"; ?>

</body>

</html>