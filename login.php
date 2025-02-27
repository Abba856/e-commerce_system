<?php
session_start();
require('./database/db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | e-commerce</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./login.css">
</head>
<body>
<div class="container">
            <h1 class="mt-3">Login</h1>
    <?php

        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-login'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = array();

            if (empty($email) || empty($password)) {
                array_push($errors, "All fields are required!");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid!");
            }
        
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                // Fetch user from database
                $sql = "SELECT * FROM users WHERE email = ?";
                $stmt = mysqli_stmt_init($conn);
        
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $user = mysqli_fetch_assoc($result);
        
                    if ($user && password_verify($password, $user['password'])) {
                        // Store user info in session
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['role'] = $user['role'];
        
                        if ($user['role'] === 'admin') {
                            header("Location: admin/dashboard.php");
                        } else {
                            header("Location: dashboard.php");
                        }
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Invalid email or password!</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Database error!</div>";
                }
            }
        }

    ?>
        <form action="login.php" method="POST">
                <div class="form-group">
                    <input class="form-control" type="text" name="email" placeholder="Email">
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>

            <input class="btn btn-primary" name="btn-login" type="submit" />
        </form>
    </div>
    <?php include('./includes/footer.php'); ?>
</body>
</html>