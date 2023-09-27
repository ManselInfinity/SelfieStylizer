<?php

require('./../vendor/autoload.php');
require_once './../dbConfig.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $mail = new PHPMailer();


    $sql = "SELECT * from users where users.email = '$email'";
    $result = $conn->query($sql);

    // !
    //  ! IF USER NOT REGISTERED  
    // !

    if ($result->num_rows == 0)
        echo "email not registered, register ";

    $row = $result->fetch_assoc();

    //verifying entered password with whats in the database 
    if (password_verify($password, $row['password'])) {
        // User authentication valid, let user through, 
        //? give user some token maybe 

        echo "password entered is correct";

        //! redirect to otp page 
        //

        //sending otp mail :

        /* Use SMTP. */
        $mail->isSMTP();
        /* Google (Gmail) SMTP server. */
        $mail->Host = 'smtp.gmail.com';
        /* SMTP port. */
        $mail->Port = 587;
        /* Set authentication. */
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        //todo  remove debug before deploying
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only

        $mail->IsHTML(true);
        $mail->Username = "selfiestyliser@gmail.com";
        $mail->Password = "yysuvfraiqvccedb";
        $mail->SetFrom("selfiestyliser@gmail.com");

        $mail->Subject = "OTP";

        // generating the otp code 

        $otp = rand(1000, 9999);

        $mail->Body = "Your OTP is : $otp";

        $mail->AddAddress($email);

        // creating a session for the current user 
        session_start();

        // storing useful information in the session 
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // $_SESSION['username'] = $username ;

        //send the email and check if successful 
        //todo remove echo before deploy
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message has been sent";
        }

        //! redirect to otp verification page:


        header("Location:./../otp1.html");



    } else {
        // password not valid, enter again
        echo "incorrect password";

    }


}

?>