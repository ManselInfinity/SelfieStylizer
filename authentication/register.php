<?php

require('./../vendor/autoload.php');
require_once './../resources/dbConfig.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];



    $sql = "SELECT * from users where users.email = '$email'";
    $result = $conn->query($sql);

    // if the user already exists in the database
    if ($result->num_rows != 0)
        echo "<script>alert('email already registered, choose another email'); </script> ";


    // hashing entered password 

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $_SESSION['email'] = $email;
    $_SESSION['hashedPassword'] = $hashedPassword;
    $_SESSION['username'] = $username;

    //sending otp mail :
    $mail = new PHPMailer();

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
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only

    $mail->IsHTML(true);
    $mail->Username = "selfiestyliser@gmail.com";
    $mail->Password = "yysuvfraiqvccedb";
    $mail->SetFrom("selfiestyliser@gmail.com");

    $mail->Subject = "OTP";



    // generating the otp code 

    $otp = rand(1000, 9999);

    $mail->Body = "Your OTP is : $otp";

    $mail->AddAddress($email);


    $_SESSION['otp'] = $otp;
    //$_SESSION['otp'] = 1234 ;

    //send the email and check if successful 
    //todo remove echo before deploy
    if (!$mail->Send()) {
        echo "<script>alert('Server Error, Sorry :(');
                      history.back(); </script>";
        
    } else {
        echo "Message has been sent";
    }

    //header("Location:./otp1.html");
}
