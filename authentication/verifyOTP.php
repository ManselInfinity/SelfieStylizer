<?php

require_once './../resources/dbConfig.php';

session_start();
$sessionOTP = $_SESSION['otp'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userOTP = $_POST['otp'];


    if ($userOTP == $sessionOTP) {
        // otp verified, redirect to user home page

        $email = $_SESSION['email'];
        $hashedPassword = $_SESSION['hashedPassword'];
        $username = $_SESSION['username'];

        $sql = "INSERT INTO users VALUES('$email', '$hashedPassword', 100, '$username')";
        $conn->query($sql);


        header("Location:./otpRedirect.html");
    }
    else{
        // otp incorrect
        echo "<script> alert('Incorrect otp !'); </script>";
    }
}
