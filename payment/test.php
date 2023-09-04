<?php

require('.\..\vendor\autoload.php');

use Razorpay\Api\Api;

session_start();

$keyId = "rzp_test_QPsfTanV1lzaKY";
$keySecret = "Lsu61dhZHgtrtfSfnVicokJf";

$api = new Api($keyId, $keySecret);

$amount = 1;
$currency = 'INR';

//! get user id from databse
$receipt = uniqid() . "userID";

//todo maybe add number of credits to notes? 
$order = $api->order->create(array('receipt' => $receipt, 'amount' => $amount * 100, 'currency' => 'INR', 'notes' => array('key1' => 'value3', 'key2' => 'value2')));

$orderId = $order['id'];





$_SESSION['razorpay_payment_id'] = $order['id'];
?>

<style>
    .razorpay-payment-button {
        /* add button css here  */
        background-color: lightblue;
        border-radius: 5px;


    }
</style>
<form action="status.php" method="POST">
    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?= $keyId ?>"
        data-amount="<?= $amount * 100 ?>" data-currency="<?= $currency ?>" data-order_id="<?= $orderId ?>"
        data-buttontext="Pay with Razorpay" data-name="Acme Corp" data-description="Lorem ipsum something something"
        data-image=".\..\logo.png" data-prefill.name="John Doe" data-prefill.email="gaurav.kumar@example.com"
        data-theme.color="#689cb4"></script>
    <input type="hidden" custom="Hidden Element" name="hidden" />
</form>