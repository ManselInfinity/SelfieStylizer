<?php

require('C:\xampp\htdocs\SelfieStylizer\vendor\autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "hello";

    // connecting to database 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SelfieStylizer";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * from users where users.email = '$email'";
    $result = $conn->query($sql);

    // !
    //  ! IF USER already REGISTERED  
    // !

    if ($result->num_rows != 0)
        echo "email already registered, choose another email ";
    // do something 


    // hashing entered password 

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //  $sql = "INSERT INTO users VALUES('$email', '$hashedPassword', 100)";
    //  $conn->query($sql);

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

    echo "hi";

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
    $_SESSION['otp'] = $otp;
    // $_SESSION['username'] = $username ;

    //send the email and check if successful 
    //todo remove echo before deploy
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent";
    }

    //! redirect to otp page now

    // header("Location:.\..\model6.html");

    header("Location:.\..\otp1.html");
}
