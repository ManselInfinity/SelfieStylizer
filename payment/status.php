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
    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
} else {
    // payment failed 
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;