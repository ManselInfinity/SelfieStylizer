<?php

session_start();
$sessionOTP = $_SESSION['otp'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userOTP = $_POST['otp'];

    echo $userOTP;
    echo "<br>";
    echo $sessionOTP;
    echo "<br>";

    if ($userOTP == $sessionOTP) {
        // otp verified, redirect to user landing page
        echo "otp verified";
        //! redirect here maybe 


        header("Location: otpRedirect.html");
    }
}
