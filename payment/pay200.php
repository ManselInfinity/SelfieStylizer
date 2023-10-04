<?php

require('./../vendor/autoload.php');

use Razorpay\Api\Api;

session_start();

$keyId = "rzp_test_QPsfTanV1lzaKY";
$keySecret = "Lsu61dhZHgtrtfSfnVicokJf";

$api = new Api($keyId, $keySecret);

$amount = 150;
$currency = 'INR';

//! get user id from databse
$receipt = uniqid() . "userID";


$order = $api->order->create(array('receipt' => $receipt, 'amount' => $amount * 100, 'currency' => 'INR', 'notes' => array('credits' => 200)));

$orderId = $order['id'];

$_SESSION['razorpay_order_id'] = $order['id'];
$_SESSION['creditsPurchased'] = 200;
?>


<body>
<link rel="stylesheet" href="pay.css">

<div class="outerDiv">
        <div class="innerDiv">
        <h1> Pay Rs 150 to purchase 200 Credits:</h1>
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
</div>
</body>