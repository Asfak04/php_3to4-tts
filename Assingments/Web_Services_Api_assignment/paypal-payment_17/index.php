<!DOCTYPE html>
<html>
<head>
    <title>PayPal API Checkout</title>
    <script src="https://www.paypal.com/sdk/js?client-id=Ad8E3UYnoCpVWVYivOpsFhoLh1oek1OruFkWWv-dHfGe2GKyDSYxXFHP2YHPSH9gbK1b3BLtCe4zWCTB&currency=USD"></script>
</head>
<body>

<h2>Product Price: $20</h2>

<div id="paypal-button-container"></div>

<script>
paypal.Buttons({

    createOrder: function () {
        return fetch("create-order.php", {
            method: "POST"
        })
        .then(res => res.json())
        .then(data => data.id);
    },

    onApprove: function (data) {
        return fetch("capture-order.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ orderID: data.orderID })
        })
        .then(res => res.json())
        .then(details => {
            window.location.href = "success.php";
        });
    }

}).render('#paypal-button-container');
</script>

</body>
</html>
