<!DOCTYPE html>
<html>
<head>
    <title>Payment Demo</title>
</head>
<body>

<h2>Razorpay Payment Demo</h2>

<form action="pay.php" method="POST">
    <label>Name:</label>
    <input type="text" name="name" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Amount (INR):</label>
    <input type="number" name="amount" required><br><br>

    <button type="submit">Pay Now</button>
</form>

</body>
</html>