<?php

    /*   MySQLi (MySQL Improved) */
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "db_ecommerce_system";
   

   
    // Create connection
    $conn = mysqli_connect($host, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    //  PDO (PHP Data Objects)
    $dns = "mysql:host=localhost;dbname=db_ecommerce_system";
    $username = "root";
    $password = "";

 /*
    try {

    $conn = new PDO($dns,$username,$password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        echo "Connection Failed: ". $e -> getMessage();
    }
*/
?>
