<?php
if (isset($_POST['register'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Email regex
    $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    // Password regex:
    // Minimum 8 characters, 1 uppercase, 1 lowercase, 1 number
    $passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/";

    if (!preg_match($emailPattern, $email)) {
        echo "Invalid email format";
    }
    elseif (!preg_match($passwordPattern, $password)) {
        echo "Password must be at least 8 characters and include uppercase, lowercase, and number";
    }
    else {
        echo "Registration successful!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>

<h2>User Registration</h2>

<form method="post" action="">
    Email:
    <input type="text" name="email" required>
    <br><br>

    Password:
    <input type="password" name="password" required>
    <br><br>

    <input type="submit" name="register" value="Register">
</form>

</body>
</html>
