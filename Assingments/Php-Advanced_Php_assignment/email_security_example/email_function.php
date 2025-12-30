<?php
// Function to sanitize and validate email
function sanitizeAndValidateEmail($email) {
    // Remove illegal characters
    $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Validate format
    if (filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
        return $sanitizedEmail; // Valid email
    } else {
        return false; // Invalid email
    }
}
?>
