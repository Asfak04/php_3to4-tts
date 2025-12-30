<?php
// Include the function
require_once 'email_function.php';

$message = '';
$sanitizedEmail = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputEmail = $_POST['email'] ?? '';

    // Use the function
    $sanitizedEmail = sanitizeAndValidateEmail($inputEmail);

    if ($sanitizedEmail) {
        $message = "Valid Email! Sanitized email: $sanitizedEmail";
    } else {
        $message = "Invalid Email!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email Validation Example</title>
</head>
<body>
    <h2>Enter your email:</h2>
    <form method="POST" action="">
        <input type="text" name="email" placeholder="example@domain.com" required>
        <button type="submit">Check Email</button>
    </form>

    <?php if($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
</body>
</html>
