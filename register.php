<?php
session_start();
require('./database/db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | e-commerce</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./register.css">
</head>
<body>
    <div class="container">
        <div>
            <h1 class="mt-3">Register</h1>
        </div>
    <?php

        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-register'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $errors = array();

            if (empty($username) || empty($email) || empty($password)) {
                array_push($errors, "All fills are required!");   
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid!");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 characters long!");
            }
            if (count($errors)>0) {
                foreach ($errors as $errors){
                    echo "<div class='alert alert-danger'>$errors</div>";
                }
            } else {

                $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<div class='alert alert-success'>Registration successful!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Database error!</div>";
                }
            }

        }

    ?>
        <form action="register.php" method="POST">
               <div class="form-group">
                   <input class="form-control" type="text" name="username" placeholder="Username">
               </div>

                <div class="form-group">
                    <input class="form-control" type="text" name="email" placeholder="Email">
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>

            <input class="btn btn-primary" name="btn-register" type="submit" />
        </form>
    </div>
    <?php include('./includes/footer.php'); ?>
</body>
</html>