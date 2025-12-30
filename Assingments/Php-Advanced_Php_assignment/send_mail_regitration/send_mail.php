<?php
if (isset($_POST['register'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Regex patterns
    $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/";

    // Validation
    if (!preg_match($emailPattern, $email)) {
        echo "Invalid email format";
    } elseif (!preg_match($passwordPattern, $password)) {
        echo "Password must be at least 8 characters with uppercase, lowercase, and number";
    } else {

        $apiKey = "enter your apikey";

        $emailData = [
            "personalizations" => [[
                "to" => [["email" => $email]],
                "subject" => "confirmation email"
            ]],
            "from" => ["email" => "enter your email address"],
            "content" => [[
                "type" => "text/plain",
                "value" =>
                "Hello $email,\n\n" .
                "Your registration was successful.\n" .
                "Registered Email: $email\n\n" .
                "Your password is $password".
                "Thank you!"
            ]]
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $apiKey",
            "Content-Type: application/json"
        ]);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($emailData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error) {
            echo "Error: $error";
        } else {
            echo "Email Sent Successfully!";
            echo "<pre>$response</pre>";
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
</head>

<body>

    <h2>User Registration</h2>

    <form method="POST">
        Email:
        <input type="text" name="email" required>
        <br><br>

        Password:
        <input type="password" name="password" required>
        <br><br>

        <button type="submit" name="register">Register</button>
    </form>

</body>

</html>