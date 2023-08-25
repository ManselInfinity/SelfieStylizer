<?php

require('C:\xampp\htdocs\SelfieStylizer\vendor\autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $mail = new PHPMailer();


    // $enteredPassword = password_hash($password, PASSWORD_DEFAULT);
    // echo $enteredPassword;

    //echo "email = $email, password = $password";

    // connecting to database 

    // hello



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SelfieStylizer";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * from users where users.email = '$email'";
    $result = $conn->query($sql);

    // !
    //  ! IF USER NOT REGISTERED  
    // !

    if ($result->num_rows == 0)
        echo "email not registered, register ";

    $row = $result->fetch_assoc();

    // hashing entered password to compare with whats in the database 

    // $enteredPassword = password_hash($password, PASSWORD_DEFAULT);

    // echo "entered password hash = $enteredPassword";
    // $pass = $row['password'];
    // echo "stored password hash = $pass ";

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

        //send the email and check if successful 
        //todo remove echo before deploy
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message has been sent";
        }

        


    } else {
        // password not valid, enter again
        echo "incorrect password";

    }


}

?>