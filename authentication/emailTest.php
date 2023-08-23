<?php

//include_once('vendor/autoload.php');

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

require('C:\xampp\htdocs\SelfieStylizer\vendor\autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



//require("/home/site/libs/PHPMailer-master/src/PHPMailer.php");
//require("/home/site/libs/PHPMailer-master/src/SMTP.php");

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

$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only

$mail->IsHTML(true);
$mail->Username = "selfiestyliser@gmail.com";
$mail->Password = "yysuvfraiqvccedb";
$mail->SetFrom("selfiestyliser@gmail.com");
$mail->Subject = "Test";
$otp = rand(1000, 9999);
$mail->Body = "hello, your otp is : $otp";
$mail->AddAddress("manselismyname@gmail.com");

if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message has been sent";
}
?>