<?php
require 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert user
$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {

    //  SEND EMAIL USING API

    $apiKey = "Enter your send grid api key";

    $data = [
        "personalizations" => [[
            "to" => [[
                "email" => $email,
                "name" => $name
            ]]
        ]],
        "from" => [
            "email" => "your_verified_email@gmail.com",
            "name" => "My App"
        ],
        "subject" => "Registration Successful",
        "content" => [[
            "type" => "text/html",
            "value" => "<h2>Welcome $name!</h2><p>Your account has been created successfully.</p>"
        ]]
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($httpCode == 202) {
        echo "Registration successful. Email sent!";
    } else {
        echo "Registration done but email failed.";
        echo "<br>Response: " . $response;
    }

} else {
    echo "Database Error: " . $stmt->error;
}
?>
