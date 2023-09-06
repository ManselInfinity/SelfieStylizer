<?php

require('.\..\vendor\autoload.php');

use Razorpay\Api\Api;

session_start();

$keyId = "rzp_test_QPsfTanV1lzaKY";
$keySecret = "Lsu61dhZHgtrtfSfnVicokJf";

$api = new Api($keyId, $keySecret);

$amount = 100;
$currency = 'INR';

//! get user id from databse
$receipt = uniqid() . "userID";

//todo maybe add number of credits to notes? 
$order = $api->order->create(array('receipt' => $receipt, 'amount' => $amount * 100, 'currency' => 'INR', 'notes' => array('key1' => 'value3', 'key2' => 'value2')));

$orderId = $order['id'];





$_SESSION['razorpay_order_id'] = $order['id'];
?>


//! change this obviously


<style>
    .razorpay-payment-button {
        /* add button css here  */
        background-color: lightblue;
        border-radius: 5px;


    }

    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-image: url("./../imp91.png");
        background-color: rgba(128, 128, 128, 0.589);
        background-blend-mode: multiply;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .container {
        background: rgba(128, 128, 180, 0.589);
        padding: 30px;
        /* border-radius: 5px;
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        background: transparent; */
        border: 2px solid rgba(255, 255, 255, .5);
        border-radius: 20px;
        backdrop-filter: blur(10px);
        box-shadow: 0 0 30px rgba(0, 0, 0, .5);
    }
</style>

<body>
    <div class="container">
        <form action="status.php" method="POST">
            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?= $keyId ?>"
                data-amount="<?= $amount * 100 ?>" data-currency="<?= $currency ?>" data-order_id="<?= $orderId ?>"
                data-buttontext="Pay with Razorpay" data-name="Acme Corp"
                data-description="Lorem ipsum something something" data-image=".\..\logo.png"
                data-prefill.name="John Doe" data-prefill.email="Pahendra@Mriolkar.com"
                data-theme.color="#689cb4"></script>
            <input type="hidden" custom="Hidden Element" name="hidden" />
        </form>
    </div>
</body>