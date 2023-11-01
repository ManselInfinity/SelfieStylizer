<?php

session_start();

require_once './../resources/dbConfig.php';
require('./../vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $email = $_POST['email'];

    $sql = "SELECT * from users where users.email = '$email'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    //! do something here maybe
    if ($result->num_rows == 0)
        echo "Email doesn't exist, register maybe? ";
    
    // generate a random key to prevent access to link from anywhere else
    $key = substr(md5(rand()), 0, 7);

    // sets a cookie to store the key
    $cookie_name = "key";
    $cookie_value = $key;
    setcookie($cookie_name, $cookie_value, time() + (60 * 10), "/"); // expires in 10 min

    setcookie("email", $email, time() + (60 * 10), "/"); // expires in 10 min

    // send email with redirect link
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
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only

    $mail->IsHTML(true);
    $mail->Username = "selfiestyliser@gmail.com";
    $mail->Password = "yysuvfraiqvccedb";
    $mail->SetFrom("selfiestyliser@gmail.com");

    $mail->Subject = "Password Reset Link";


    $mail->Body = "The link provided below is valid for only 10 minutes:<br>><a href='http://localhost/SelfieStylizer/authentication/resetPassword.php?key=$key'>Click to reset Password</a>";

    $mail->AddAddress($email);

    //send the email and check if successful 
    //todo remove echo before deploy
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent";
    }

    header("Location: ./ForgotPasswordEmailSent.html");
    exit();  

}