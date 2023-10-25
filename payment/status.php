<?php

require('./../vendor/autoload.php');
require('./../dbConfig.php');


use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


$success = true;
$error = "Payment Failed";
$keyId = "rzp_test_QPsfTanV1lzaKY";
$keySecret = "Lsu61dhZHgtrtfSfnVicokJf";

session_start();


if (empty($_POST['razorpay_order_id']) === false) {
    $api = new Api($keyId, $keySecret);

    try {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true) {
    //! insert data to database

    // if(!isset($_COOKIE['email']))
    // {
    //     // no user signed in
    //     echo "you dont belong here <br>";
    //     echo $_SESSION['email'];
    //     echo $_COOKIE['email'];
    //     die();
    // }

    $email = $_SESSION['email'];

    // if(!$email)
    // {
    //     //! do something here maybe
    //     echo "no email, huh?";
    //     die();
    // }

    $query = "select credits from users where email = '$email'";
    $result = $conn->query($query);

    if($result->num_rows != 1) 
    {
        echo "too many users somehow, with the same email";
        die();
    }

    $row = $result->fetch_assoc();
    $newCredits = $row['credits'];

    $newCredits += $_SESSION['creditsPurchased'];

    $query = "update users set credits = $newCredits where email = '$email'";
    $result = $conn->query($query);

    
    // $html = "<p>Your payment was successful</p>
    //          <p>Payment ID: {$_POST['razorpay_payment_id']}</p><br>
    //          credits bought = {$_SESSION['creditsPurchased']}";
} else {
    // payment failed 
    echo "payment failed";
    die();
    // $html = "<p>Your payment failed</p>
    //          <p>{$error}</p>";
}

header("Location:./redirect.html");