<?php

session_start();
$sessionOTP = $_SESSION['otp'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userOTP = $_POST['otp'];

    if ($userOTP === $sessionOTP) {
        // otp verified, redirect to user landing page
        //! redirect here maybe 
    }

}

?>