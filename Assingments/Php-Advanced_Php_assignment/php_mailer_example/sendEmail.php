<?php
require 'emailSender.php';

// Create EmailSender object
$email = new EmailSender(
    'smtp.gmail.com',      // SMTP host
    'submitdata123@gmail.com', // Your email
    'jfpx tfzt qofs rfpu',    // App password
    587,                    // Port
    'tls'                   // Encryption
);

// Set sender
$email->setFrom('enter your email address', 'TopsTech');

// Add recipient
$email->addRecipient('enter recipient email address', 'Recipient Name');

// Set subject and body
$email->setSubject('Test Email using OOP PHPMailer');
$email->setBody('<h1>Hello from OOP PHPMailer!</h1>', 'Hello from OOP PHPMailer!');

// Send email
if($email->send()) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}
?>
