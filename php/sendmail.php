<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // ⚠️ Replace with your club Gmail + App Password
        $mail->Username   = 'impactcirclekl@gmail.com'; // Your club Gmail
        $mail->Password   = 'phrc keik iwpr vtzh';   // App password (not your real Gmail password)
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('impactcirclekl@gmail.com', 'Impact Circle Contact');
        $mail->addAddress('impactcirclekl@gmail.com'); // Receiver (club inbox)
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(false);
        $mail->Subject = "New Contact Form Message from $name";
        $mail->Body    = "You received a new message from the website:\n\n"
                       . "Name: $name\n"
                       . "Email: $email\n\n"
                       . "Message:\n$message";

        $mail->send();
        echo "<script>alert('✅ Message sent successfully!'); window.location.href='Contact.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('❌ Error sending message: {$mail->ErrorInfo}'); window.location.href='Contact.html';</script>";
    }
}
?>