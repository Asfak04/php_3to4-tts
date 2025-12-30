<?php
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';
require __DIR__ . '/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ... rest of the EmailSender class ...



// ... rest of the EmailSender class ...


class EmailSender {
    private $mail;

    public function __construct($host, $username, $password, $port = 587, $secure = 'tls') {
        $this->mail = new PHPMailer(true);

        // Server settings
        $this->mail->isSMTP();
        $this->mail->Host       = $host;
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = $username;
        $this->mail->Password   = $password;
        $this->mail->SMTPSecure = $secure;
        $this->mail->Port       = $port;
    }

    public function setFrom($email, $name = '') {
        $this->mail->setFrom($email, $name);
    }

    public function addRecipient($email, $name = '') {
        $this->mail->addAddress($email, $name);
    }

    public function setSubject($subject) {
        $this->mail->Subject = $subject;
    }

    public function setBody($htmlBody, $altBody = '') {
        $this->mail->isHTML(true);
        $this->mail->Body = $htmlBody;
        $this->mail->AltBody = $altBody ?: strip_tags($htmlBody);
    }

    public function send() {
        try {
            echo "Attempting to send email...\n";
            return $this->mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
            return false;
        }
    }
}
?>
