<?php
require_once 'vendor/autoload.php'; // Include PHPMailer autoloader
require_once 'dbhandler.inc.php'; // Your database connection file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["reset-request-submit"])) {
    $email = $_POST['email'];

    // Check if the email exists in your database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Store the token and associated email in the database
        $sql = "INSERT INTO password_reset_tokens (email, token, expire_time) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Set expiration time to 1 hour from now
        $expireTime = time() + 3600;
        $stmt->bind_param("ssi", $email, $token, $expireTime);
        $stmt->execute();

        // Send an email with a link containing the token
        $resetLink = "http://yourwebsite.com/password_reset.php?token=$token";
        
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your@gmail.com'; // Your Gmail email address
            $mail->Password   = 'your_gmail_password'; // Your Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('your@gmail.com', 'Your Name'); // Your Gmail email address and your name
            $mail->addAddress($email); // Recipient's email address

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Click the following link to reset your password: $resetLink";

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // Redirect to a confirmation page
        header("Location: confirmation_page.php");//wala pa tong page na to
        exit();
    } else {
        // Email not found in the database
        header("Location: forgotPassword.php?error=email_not_found");
        exit();
    }
}
?>
