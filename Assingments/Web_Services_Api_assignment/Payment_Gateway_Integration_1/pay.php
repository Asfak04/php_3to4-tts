<?php
require 'config.php';

$name   = $_POST['name'];
$email  = $_POST['email'];
$amount = $_POST['amount'] * 100; // INR to paise

$order = $api->order->create([
    'receipt' => "8604",            // string
    // OR
    // 'receipt' => (string)8604,
    'amount'  => 50000,              // amount is fine as integer (paise)
    'currency'=> 'INR'
]);

$orderId = $order['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pay</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

<script>
var options = {
    "key": "rzp_test_Rr3rxC3krXVmE2",
    "amount": "<?php echo $amount; ?>",
    "currency": "INR",
    "name": "Demo Company",
    "description": "Test Transaction",
    "order_id": "<?php echo $orderId; ?>",
    "handler": function (response){
        window.location.href = "success.php?payment_id=" + response.razorpay_payment_id;
    },
    "prefill": {
        "name": "<?php echo $name; ?>",
        "email": "<?php echo $email; ?>"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp = new Razorpay(options);
rzp.open();
</script>

</body>
</html>
